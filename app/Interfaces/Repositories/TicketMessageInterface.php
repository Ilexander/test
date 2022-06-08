<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\TicketMessage\TicketMessageAllInterface;
use App\Http\Requests\TicketMessage\TicketMessageCreateInterface;
use App\Http\Requests\TicketMessage\TicketMessageDeleteInterface;
use App\Http\Requests\TicketMessage\TicketMessageInfoInterface;
use App\Http\Requests\TicketMessage\TicketMessageTicketInterface;
use App\Http\Requests\TicketMessage\TicketMessageUpdateInterface;
use App\Http\Requests\TicketMessage\TicketMessageUserInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface TicketMessageInterface
 * @package App\Interfaces\Repositories
 */
interface TicketMessageInterface
{
    /**
     * @param TicketMessageCreateInterface $create
     * @return bool
     */
    public function saveTickerMessage(TicketMessageCreateInterface $create): bool;

    /**
     * @param TicketMessageInfoInterface $info
     * @return Model|null
     */
    public function getTicketMessage(TicketMessageInfoInterface $info): ?Model;

    /**
     * @param TicketMessageAllInterface $all
     * @return Collection|null
     */
    public function getTicketMessageList(TicketMessageAllInterface $all): ?Collection;

    /**
     * @param TicketMessageUpdateInterface $update
     * @return bool
     */
    public function updateTicketMessage(TicketMessageUpdateInterface $update): bool;

    /**
     * @param TicketMessageDeleteInterface $delete
     * @return bool
     */
    public function deleteTicketMessage(TicketMessageDeleteInterface $delete): bool;

    /**
     * @param TicketMessageUserInterface $user
     * @return Collection|null
     */
    public function userTicketMessage(TicketMessageUserInterface $user): ?Collection;

    /**
     * @param TicketMessageTicketInterface $ticket
     * @return Collection|null
     */
    public function getMessagesForTicket(TicketMessageTicketInterface $ticket): ?Collection;
}