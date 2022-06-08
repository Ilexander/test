<?php

namespace Tests\Unit\Services\Currency;

use App\Http\Requests\Currency\CurrencyAllInterface;
use App\Http\Requests\Currency\CurrencyCreateInterface;
use App\Http\Requests\Currency\CurrencyDeleteInterface;
use App\Http\Requests\Currency\CurrencyInfoInterface;
use App\Http\Requests\Currency\CurrencyUpdateInterface;
use App\Interfaces\Repositories\CurrencyInterface;
use App\Interfaces\Repositories\PaymentCurrencyInterface;
use App\Models\Currency;
use App\Services\Currency\CurrencyService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\CurrencyFactory;
use Tests\TestCase;

class CurrencyServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Currency $currency;

    private CurrencyService $currencyService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->currency = CurrencyFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->currency);

        $repo = $this->createMock(CurrencyInterface::class);
        $repo->method('add')->willReturn(true);
        $repo->method('delete')->willReturn(true);
        $repo->method('update')->willReturn(true);
        $repo->method('info')->willReturn($this->currency);
        $repo->method('all')->willReturn($collection);
        $repo->method('list')->willReturn($collection);

        $paymentCurrencyRepo = $this->createMock(PaymentCurrencyInterface::class);
        $repo->method('add')->willReturn(true);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $this->currencyService = new CurrencyService( $repo, $paymentCurrencyRepo );
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAdd()
    {
        $add = $this->createMock(CurrencyCreateInterface::class);

        $this->assertTrue($this->currencyService->add($add));
    }

    public function testDelete()
    {
        $delete = $this->createMock(CurrencyDeleteInterface::class);

        $this->assertTrue($this->currencyService->delete($delete));
    }

    public function testUpdate()
    {
        $update = $this->createMock(CurrencyUpdateInterface::class);

        $this->assertTrue($this->currencyService->update($update));
    }

    public function testInfo()
    {
        $info = $this->createMock(CurrencyInfoInterface::class);

        /** @var Currency $result */
        $result = $this->currencyService->info($info);

        $this->assertEquals($this->currency->name, $result->name);
        $this->assertEquals($this->currency->description, $result->description);
    }

    public function testAll()
    {
        $all = $this->createMock(CurrencyAllInterface::class);

        $result = $this->currencyService->all($all);
        /** @var Currency $item */
        foreach ($result as $item) {
            $this->assertEquals($this->currency->name, $item->name);
            $this->assertEquals($this->currency->description, $item->description);
        }
    }

    public function testList()
    {
        $result = $this->currencyService->list();
        /** @var Currency $item */
        foreach ($result as $item) {
            $this->assertEquals($this->currency->name, $item->name);
            $this->assertEquals($this->currency->description, $item->description);
        }
    }
}
