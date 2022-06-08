<?php

namespace Tests\Unit\Services\User;

use App\DTO\User\UserCanceledPaymentCollectionDTO;
use App\DTO\User\UserCanceledPaymentDTO;
use App\Interfaces\Repositories\UserCanceledPaymentInterface;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserCanceledPayment;
use App\Services\User\UserCanceledPaymentService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\PaymentFactory;
use Tests\Factories\UserCanceledPaymentFactory;
use Tests\Factories\UserFactory;
use Tests\TestCase;

class UserCanceledPaymentServiceTest extends TestCase
{
    use DatabaseMigrations;

    private UserCanceledPayment $userCanceledPayment;
    private UserCanceledPaymentService $userCanceledPaymentService;
    private User $user;
    private Payment $payment;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        $this->payment = PaymentFactory::new()->create();

        $this->userCanceledPayment = UserCanceledPaymentFactory::new()->create([
            'user_id' => $this->user->id,
            'payment_id' => $this->payment->id,
        ]);

        $collection = new Collection();
        $collection->add($this->userCanceledPayment);

        $repo = $this->createMock(UserCanceledPaymentInterface::class);
        $repo->method('getForUser')->willReturn($collection);
        $repo->method('getForPayment')->willReturn($collection);
        $repo->method('delete')->willReturn(true);
        $repo->method('deleteForUser')->willReturn(true);
        $repo->method('deleteForPayment')->willReturn(true);

        $this->userCanceledPaymentService = new UserCanceledPaymentService($repo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $canceledPaymentCollectionDTO = new UserCanceledPaymentCollectionDTO();
        $canceledPaymentCollectionDTO->setItem(
            new UserCanceledPaymentDTO(
                $this->user,
                $this->payment
            )
        );

        $this->userCanceledPaymentService->create($canceledPaymentCollectionDTO);
    }

    public function testDelete()
    {
        $this->assertTrue($this->userCanceledPaymentService->delete($this->user->id, $this->payment->id));
    }

    public function testGetForUser()
    {
        /** @var UserCanceledPayment $item */
        foreach ($this->userCanceledPaymentService->getForUser($this->user->id) as $item) {
            $this->assertEquals($this->userCanceledPayment->user_id, $item->user_id);
            $this->assertEquals($this->userCanceledPayment->payment_id, $item->payment_id);
        }
    }

    public function testGetForPayment()
    {
        /** @var UserCanceledPayment $item */
        foreach ($this->userCanceledPaymentService->getForPayment($this->payment->id) as $item) {
            $this->assertEquals($this->userCanceledPayment->user_id, $item->user_id);
            $this->assertEquals($this->userCanceledPayment->payment_id, $item->payment_id);
        }
    }

    public function testDeleteForUser()
    {
        $this->assertTrue($this->userCanceledPaymentService->deleteForUser($this->user->id));
    }

    public function testDeleteForPayment()
    {
        $this->assertTrue($this->userCanceledPaymentService->deleteForPayment($this->payment->id));
    }
}
