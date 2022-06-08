<?php

namespace Tests\Unit\Repositories\Currency;

use App\DTO\Currency\CurrencyItemDTO;
use App\Http\Requests\Currency\CurrencyAllRequest;
use App\Http\Requests\Currency\CurrencyCreateRequest;
use App\Http\Requests\Currency\CurrencyUpdateRequest;
use App\Models\Currency;
use App\Repositories\Currency\CurrencyRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\Factories\CurrencyFactory;
use Tests\TestCase;
use Tests\Traits\ValidationTrait;

class CurrencyRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use ValidationTrait;

    private CurrencyRepository $currencyRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->currencyRepository = new CurrencyRepository(new Currency());
    }

    public function testAll()
    {
        $currency = CurrencyFactory::new()->create();

        $all = new CurrencyAllRequest();

        /** @var Currency $item */
        foreach ($this->currencyRepository->all($all) as $item) {
            $this->checkEquals(
                $currency,
                $item,
                [
                    'name',
                    'description',
                ]
            );
        }
    }

    public function testList()
    {
        $currency = CurrencyFactory::new()->create();

        /** @var Currency $item */
        foreach ($this->currencyRepository->list() as $item) {
            $this->checkEquals(
                $currency,
                $item,
                [
                    'name',
                    'description',
                ]
            );
        }
    }

    public function testInfo()
    {
        $currency = CurrencyFactory::new()->create();

        $this->checkIsset($currency);
    }

    public function testUpdate()
    {
        $currency = CurrencyFactory::new()->create();

        $this->checkIsset($currency);

        $updateArray = [
            "id"    => $currency->id,
            'name'  => Str::random(32),
            'description'   => Str::random(32),
        ];

        $update = new CurrencyUpdateRequest();
        $update->merge($updateArray);

        $this->assertTrue($this->currencyRepository->update($update));

        $info = new CurrencyItemDTO($currency->id);

        /** @var Currency $result */
        $result = $this->currencyRepository->info($info);

        $this->assertEquals($updateArray['id'], $result->id);
        $this->assertEquals($updateArray['name'], $result->name);
        $this->assertEquals($updateArray['description'], $result->description);
    }

    public function testDelete()
    {
        $currency = CurrencyFactory::new()->create();
        $this->checkIsset($currency);

        $delete = new CurrencyItemDTO($currency->id);
        $this->assertTrue($this->currencyRepository->delete($delete));

        $this->assertNull($this->currencyRepository->info($delete));
    }

    public function testAdd()
    {
        $create = new CurrencyCreateRequest();
        $create->merge([
            'name'  => Str::random(32),
            'description'   => Str::random(32),
        ]);

        $this->assertTrue($this->currencyRepository->add($create));
    }

    private function checkIsset(Currency $currency)
    {
        $info = new CurrencyItemDTO($currency->id);
        $result = $this->currencyRepository->info($info);

        $this->checkEquals(
            $currency,
            $result,
            [
                'name',
                'description',
            ]
        );
    }
}
