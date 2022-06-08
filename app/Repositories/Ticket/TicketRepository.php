<?php

namespace App\Repositories\Ticket;

use App\Http\Requests\Ticket\TicketAllInterface;
use App\Http\Requests\Ticket\TicketCreateInterface;
use App\Http\Requests\Ticket\TicketDeleteInterface;
use App\Http\Requests\Ticket\TicketInfoInterface;
use App\Http\Requests\Ticket\TicketUpdateInterface;
use App\Http\Requests\Ticket\TicketUserInterface;
use App\Interfaces\Repositories\TicketInterface;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class TicketRepository
 * @package App\Repositories\Ticket
 */
class TicketRepository implements TicketInterface
{
    protected Ticket $ticket;

    /**
     * TicketRepository constructor.
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * @param TicketCreateInterface $create
     * @return Model
     * @throws \Throwable
     */
    public function saveTicker(TicketCreateInterface $create): Model
    {
        /** @var Ticket $ticket */
        $ticket = new $this->ticket();
        $ticket->fill([
            'user_id'       => Auth::user()->id,
            'subject'       => $create->getSubject(),
            'description'   => $create->getDescription(),
            'status'        => Ticket::OPEN_STATUS,
            'entity_type'   => $create->getRequest() ?? $create->getPayment(),
            'entity_id'     => $create->getOrderId() ?? $create->getTransactionId(),
        ]);
        $ticket->saveOrFail();

        return $ticket;
    }

    /**
     * @param TicketInfoInterface $info
     * @return Model
     */
    public function getTicker(TicketInfoInterface $info): Model
    {
        return $this
            ->ticket
            ->newQuery()
            ->when((!Auth::user()->isAdmin() && $info->getUserId()), function ($query, $user) use ($info){
                return $query->where('user_id', $info->getUserId());
            })
            ->find($info->getId());
    }

    /**
     * @param TicketAllInterface $all
     * @return Collection
     */
    public function getTickerList(TicketAllInterface $all): Collection
    {
        return $this
            ->ticket
            ->newQuery()
            ->select(
                'tickets.*',
                DB::raw('CONCAT_WS(" ", `subject`, `entity_type`, `entity_id`) as `title`')
            )
            ->when($all->getUserId(), function ($query, $user_id) {
                return $query->where('user_id', $user_id);
            })
            ->when($all->getStartDate(), function ($query, $startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($all->getEndDate(), function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->when($all->getFilterStatus(), function ($query, $status) {
                return $query->where('status', '=', $status);
            })
            ->when(( !is_null($all->getFilterImportant()) ), function ($query, $important) use ($all) {
                return $query->where('is_important', '=', $all->getFilterImportant());
            })
            ->when($all->getSearch(), function ($query, $search) {
                return $query->having('title', 'LIKE', '%' . $search . '%');
            })
            ->with('user')
            ->orderBy('status','desc')
            ->get();
    }

    /**
     * @param TicketUpdateInterface $update
     * @return bool
     */
    public function updateTicket(TicketUpdateInterface $update): bool
    {
        return $this->ticket
            ->newQuery()
            ->where('id', $update->getId())
            ->where('user_id', $update->getUserId())
            ->update([
                'subject'       => $update->getSubject(),
                'description'   => $update->getDescription(),
            ]);
    }

    /**
     * @param TicketDeleteInterface $delete
     * @return bool
     */
    public function deleteTicket(TicketDeleteInterface $delete): bool
    {
        return $this->ticket
            ->newQuery()
            ->where('id', $delete->getId())
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) use ($delete) {
                return $query->where('user_id', $delete->getUserId());
            })
            ->delete();
    }

    /**
     * @param TicketUserInterface $user
     * @return Collection
     */
    public function userTicket(TicketUserInterface $user): Collection
    {
        return $this->ticket
            ->newQuery()
            ->where('user_id', Auth::user()->id)
            ->get();
    }

    /**
     * @param int $ticketId
     * @param int $statusId
     * @return bool
     */
    public function updateTicketStatus(int $ticketId, int $statusId): bool
    {
        return $this->ticket
            ->newQuery()
            ->where('id', $ticketId)
            ->update([
                'status' => $statusId
            ]);
    }

    /**
     * @param int|null $user_id
     * @return object
     */
    public function statusesStatistic(?int $user_id): object
    {
        return DB::table((new Ticket())->getTable())
            ->select(
                DB::raw('SUM( IF( status = "'.Ticket::OPEN_STATUS.'", 1, 0 ) ) as open_tickets'),
                DB::raw('SUM( IF( status = "'.Ticket::CLOSE_STATUS.'", 1, 0 ) ) as close_tickets'),
                DB::raw('SUM(
                    IF(
                        (
                            status = "'.Ticket::PROCESS_STATUS.'"
                            OR status = "'.Ticket::WAIT_FOR_ADMIN_ANSWER.'"
                            OR status = "'.Ticket::WAIT_FOR_USER_ANSWER.'"
                        ), 1, 0
                    )
                ) as pending_tickets'),
            )
            ->first();
    }

    /**
     * @param TicketInfoInterface $importantChange
     * @return bool
     */
    public function importantChangeTicket(TicketInfoInterface $importantChange): bool
    {
        $ticket = $this->ticket
            ->newQuery()
            ->find($importantChange->getId());

        return $this->ticket
            ->newQuery()
            ->where('id', $importantChange->getId())
            ->update([
                'is_important' => !$ticket->is_important
            ]);
    }
}
