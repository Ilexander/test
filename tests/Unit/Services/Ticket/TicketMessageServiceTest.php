<?php

namespace Tests\Unit\Services\Ticket;

use App\Http\Requests\TicketMessage\TicketMessageAllInterface;
use App\Http\Requests\TicketMessage\TicketMessageCreateInterface;
use App\Http\Requests\TicketMessage\TicketMessageDeleteInterface;
use App\Http\Requests\TicketMessage\TicketMessageInfoInterface;
use App\Http\Requests\TicketMessage\TicketMessageTicketInterface;
use App\Http\Requests\TicketMessage\TicketMessageUpdateInterface;
use App\Http\Requests\TicketMessage\TicketMessageUserInterface;
use App\Interfaces\Repositories\TicketInterface;
use App\Interfaces\Repositories\TicketMessageInterface;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Services\Ticket\TicketMessage\TicketMessageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\Factories\TicketFactory;
use Tests\Factories\TicketMessageFactory;
use Tests\Factories\UserFactory;
use Tests\TestCase;

class TicketMessageServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Ticket $ticket;
    private TicketMessage $ticketMessage;
    private TicketMessageService $ticketMessageService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketMessage = TicketMessageFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->ticketMessage);

        $messageRepo = $this->createMock(TicketMessageInterface::class);
        $messageRepo->method('saveTickerMessage')->willReturn(true);
        $messageRepo->method('getTicketMessage')->willReturn($this->ticketMessage);
        $messageRepo->method('getTicketMessageList')->willReturn($collection);
        $messageRepo->method('updateTicketMessage')->willReturn(true);
        $messageRepo->method('deleteTicketMessage')->willReturn(true);
        $messageRepo->method('userTicketMessage')->willReturn($collection);
        $messageRepo->method('getMessagesForTicket')->willReturn($collection);

        $this->ticket = TicketFactory::new()->create();
        $ticketCollection = new Collection();
        $ticketCollection->add($this->ticket);

        $repo = $this->createMock(TicketInterface::class);
        $repo->method('saveTicker')->willReturn(true);
        $repo->method('getTicker')->willReturn($this->ticket);
        $repo->method('getTickerList')->willReturn($ticketCollection);
        $repo->method('updateTicket')->willReturn(true);
        $repo->method('deleteTicket')->willReturn(true);
        $repo->method('userTicket')->willReturn($ticketCollection);
        $repo->method('updateTicketStatus')->willReturn(true);


        $this->ticketMessageService = new TicketMessageService($messageRepo, $repo);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAdd()
    {
        /** @var User $user */
        $user = UserFactory::new()->create();
        $user->assignRole(User::ROLE_ADMIN);
        Auth::shouldReceive('user')->once()->andreturn($user);

        $create = $this->createMock(TicketMessageCreateInterface::class);
        $create->method('getTicketId')->willReturn($this->ticket->id);

        $this->assertTrue($this->ticketMessageService->add($create));
    }

    public function testRead()
    {
        $info = $this->createMock(TicketMessageInfoInterface::class);

        /** @var TicketMessage $result */
        $result = $this->ticketMessageService->read($info);

        $this->assertEquals($this->ticketMessage->user_id, $result->user_id);
        $this->assertEquals($this->ticketMessage->ticket_id, $result->ticket_id);
        $this->assertEquals($this->ticketMessage->message, $result->message);
        $this->assertEquals($this->ticketMessage->is_read, $result->is_read);
    }

    public function testUpdate()
    {
        $update = $this->createMock(TicketMessageUpdateInterface::class);

        $this->assertTrue($this->ticketMessageService->update($update));
    }

    public function testDelete()
    {
        $delete = $this->createMock(TicketMessageDeleteInterface::class);

        $this->assertTrue($this->ticketMessageService->delete($delete));
    }

    public function testList()
    {
        $all = $this->createMock(TicketMessageAllInterface::class);

        /** @var TicketMessage $item */
        foreach ($this->ticketMessageService->list($all) as $item) {
            $this->assertEquals($this->ticketMessage->user_id, $item->user_id);
            $this->assertEquals($this->ticketMessage->ticket_id, $item->ticket_id);
            $this->assertEquals($this->ticketMessage->message, $item->message);
            $this->assertEquals($this->ticketMessage->is_read, $item->is_read);
        }
    }

    public function testUser()
    {
        $user = $this->createMock(TicketMessageUserInterface::class);

        /** @var TicketMessage $item */
        foreach ($this->ticketMessageService->user($user) as $item) {
            $this->assertEquals($this->ticketMessage->user_id, $item->user_id);
            $this->assertEquals($this->ticketMessage->ticket_id, $item->ticket_id);
            $this->assertEquals($this->ticketMessage->message, $item->message);
            $this->assertEquals($this->ticketMessage->is_read, $item->is_read);
        }
    }

    public function testTicket()
    {
        $ticket = $this->createMock(TicketMessageTicketInterface::class);

        /** @var TicketMessage $item */
        foreach ($this->ticketMessageService->ticket($ticket) as $item) {
            $this->assertEquals($this->ticketMessage->user_id, $item->user_id);
            $this->assertEquals($this->ticketMessage->ticket_id, $item->ticket_id);
            $this->assertEquals($this->ticketMessage->message, $item->message);
            $this->assertEquals($this->ticketMessage->is_read, $item->is_read);
        }
    }
}
