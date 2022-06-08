<?php

namespace Tests\Unit\DTO\Currency;

use App\DTO\Currency\CurrencyItemDTO;
use PHPUnit\Framework\TestCase;

class CurrencyItemDTOTest extends TestCase
{
    /**
     * @dataProvider itemDataProvider
     *
     * @return void
     */
    public function testItem($id)
    {
        $currency = new CurrencyItemDTO($id);

        $this->assertEquals($id, $currency->getId());
    }

    public function itemDataProvider()
    {
        return [
            [1],
            [2],
            [3],
        ];
    }
}
