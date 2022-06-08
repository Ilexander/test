<?php

namespace App\Repositories\Ticket;

use App\Http\Requests\TicketMessage\TicketMessageAllInterface;
use App\Http\Requests\TicketMessage\TicketMessageCreateInterface;
use App\Http\Requests\TicketMessage\TicketMessageDeleteInterface;
use App\Http\Requests\TicketMessage\TicketMessageInfoInterface;
use App\Http\Requests\TicketMessage\TicketMessageTicketInterface;
use App\Http\Requests\TicketMessage\TicketMessageUpdateInterface;
use App\Http\Requests\TicketMessage\TicketMessageUserInterface;
use App\Interfaces\Repositories\TicketMessageInterface;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class TicketMessageRepository
 * @package App\Repositories\Ticket
 */
class TicketMessageRepository implements TicketMessageInterface
{
    private TicketMessage $ticketMessage;

    /**
     * TicketMessageRepository constructor.
     * @param TicketMessage $ticketMessage
     */
    public function __construct(TicketMessage $ticketMessage)
    {
        $this->ticketMessage = $ticketMessage;
    }

    /**
     * @param TicketMessageCreateInterface $create
     * @return bool
     */
    public function saveTickerMessage(TicketMessageCreateInterface $create): bool
    {
        try {
            $this
                ->ticketMessage
                ->newQuery()
                ->create([
                    'user_id'       => Auth::user()->id,
                    'ticket_id'     => $create->getTicketId(),
                    'message'       => $create->getMessage(),
                    'is_read'       => false
            ]);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param TicketMessageInfoInterface $info
     * @return Model|null
     */
    public function getTicketMessage(TicketMessageInfoInterface $info): ?Model
    {
        return $this
            ->ticketMessage
            ->newQuery()
            ->with('user')
            ->when((!Auth::user()->isAdmin()), function ($query, $user){
                return $query->where('user_id', Auth::user()->id);
            })
            ->where('id', $info->getId())
            ->first();
    }

    /**
     * @param TicketMessageAllInterface $all
     * @return Collection|null
     */
    public function getTicketMessageList(TicketMessageAllInterface $all): ?Collection
    {
        return $this->ticketMessage->newQuery()->with('user')->get();
    }

    /**
     * @param TicketMessageUpdateInterface $update
     * @return bool
     */
    public function updateTicketMessage(TicketMessageUpdateInterface $update): bool
    {
        return $this
            ->ticketMessage
            ->newQuery()
            ->where('user_id', Auth::user()->id)
            ->where('id', $update->getId())
            ->update([
                'message' => $update->getMessage()
            ]);
    }

    /**
     * @param TicketMessageDeleteInterface $delete
     * @return bool
     */
    public function deleteTicketMessage(TicketMessageDeleteInterface $delete): bool
    {
        return $this
            ->ticketMessage
            ->newQuery()
            ->where('user_id', Auth::user()->id)
            ->where('id', $delete->getId())
            ->delete();
    }

    /**
     * @param TicketMessageUserInterface $user
     * @return Collection|null
     */
    public function userTicketMessage(TicketMessageUserInterface $user): ?Collection
    {
        return $this
            ->ticketMessage
            ->newQuery()
            ->with('user')
            ->where('user_id', $user->getUserId())
            ->get();
    }

    /**
     * @param TicketMessageTicketInterface $ticket
     * @return Collection|null
     */
    public function getMessagesForTicket(TicketMessageTicketInterface $ticket): ?Collection
    {
        return $this
            ->ticketMessage
            ->newQuery()
            ->select('ticket_messages.*')
            ->with('user')
            ->leftJoin(
                (new Ticket())->getTable().' as t',
                'ticket_messages.ticket_id', '=', 't.id'
            )
            ->where('t.id', $ticket->getTicketId())
            ->when((!Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('t.user_id', Auth::user()->id);
            })
            ->get();
    }
}
