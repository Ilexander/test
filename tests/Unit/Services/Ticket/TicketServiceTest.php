<?php

namespace Tests\Unit\Services\Ticket;

use App\Http\Requests\Ticket\TicketAllInterface;
use App\Http\Requests\Ticket\TicketCreateInterface;
use App\Http\Requests\Ticket\TicketDeleteInterface;
use App\Http\Requests\Ticket\TicketInfoInterface;
use App\Http\Requests\Ticket\TicketUpdateInterface;
use App\Http\Requests\Ticket\TicketUserInterface;
use App\Interfaces\Repositories\TicketInterface;
use App\Models\Ticket;
use App\Services\Ticket\TicketService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\TicketFactory;
use Tests\TestCase;

class TicketServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Ticket $ticket;
    private TicketService $ticketService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticket = TicketFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->ticket);

        $repo = $this->createMock(TicketInterface::class);
        $repo->method('saveTicker')->willReturn(true);
        $repo->method('getTicker')->willReturn($this->ticket);
        $repo->method('getTickerList')->willReturn($collection);
        $repo->method('updateTicket')->willReturn(true);
        $repo->method('deleteTicket')->willReturn(true);
        $repo->method('userTicket')->willReturn($collection);
        $repo->method('updateTicketStatus')->willReturn(true);

        $this->ticketService = new TicketService($repo);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAddTicket()
    {
        $create = $this->createMock(TicketCreateInterface::class);

        $this->assertTrue($this->ticketService->addTicket($create));
    }

    public function testUpdateTicket()
    {
        $update = $this->createMock(TicketUpdateInterface::class);

        $this->assertTrue($this->ticketService->updateTicket($update));
    }

    public function testDeleteTicket()
    {
        $delete = $this->createMock(TicketDeleteInterface::class);

        $this->assertTrue($this->ticketService->deleteTicket($delete));
    }

    public function testGetTicket()
    {
        $info = $this->createMock(TicketInfoInterface::class);

        /** @var Ticket $result */
        $result = $this->ticketService->getTicket($info);

        $this->assertEquals($this->ticket->user_id, $result->user_id);
        $this->assertEquals($this->ticket->subject, $result->subject);
        $this->assertEquals($this->ticket->description, $result->description);
        $this->assertEquals($this->ticket->status, $result->status);
    }

    public function testGetAllTickets()
    {
        $all = $this->createMock(TicketAllInterface::class);

        /** @var Ticket $ticket */
        foreach ($this->ticketService->getAllTickets($all) as $ticket)
        {
            $this->assertEquals($this->ticket->user_id, $ticket->user_id);
            $this->assertEquals($this->ticket->subject, $ticket->subject);
            $this->assertEquals($this->ticket->description, $ticket->description);
            $this->assertEquals($this->ticket->status, $ticket->status);
        }
    }

    public function testUserTicket()
    {
        $user = $this->createMock(TicketUserInterface::class);

        /** @var Ticket $ticket */
        foreach ($this->ticketService->userTicket($user) as $ticket)
        {
            $this->assertEquals($this->ticket->user_id, $ticket->user_id);
            $this->assertEquals($this->ticket->subject, $ticket->subject);
            $this->assertEquals($this->ticket->description, $ticket->description);
            $this->assertEquals($this->ticket->status, $ticket->status);
        }
    }
}
