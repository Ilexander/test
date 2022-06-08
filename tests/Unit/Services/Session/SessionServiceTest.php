<?php

namespace Tests\Unit\Services\Session;

use App\Http\Requests\Session\SessionAllInterface;
use App\Interfaces\Repositories\SessionInterface;
use App\Models\Service;
use App\Models\Session;
use App\Services\Session\SessionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\SessionFactory;
use Tests\Factories\UserFactory;
use Tests\TestCase;

class SessionServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Session $session;

    private SessionService $sessionService;

    public function setUp(): void
    {
        parent::setUp();

        $this->session = SessionFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->session);

        $repo = $this->createMock(SessionInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('create')->willReturn($this->session);

        $this->sessionService = new SessionService($repo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $all = $this->createMock(SessionAllInterface::class);

        /** @var Session $item */
        foreach ($this->sessionService->all($all) as $item){
            $this->assertEquals($this->session->user_id, $item->user_id);
            $this->assertEquals($this->session->ip, $item->ip);
        }
    }

    public function testCreate()
    {
        /** @var Service $result */
        $result = $this->sessionService->create(UserFactory::new()->create()->id, "182.54.244.98");

        $this->assertEquals($this->session->user_id, $result->user_id);
        $this->assertEquals($this->session->ip, $result->ip);
    }
}
