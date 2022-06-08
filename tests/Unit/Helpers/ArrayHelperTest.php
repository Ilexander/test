<?php

namespace Tests\Unit\Helpers;

use App\Helpers\ArrayHelper;
use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
    /**
     * @dataProvider itemFilterEmptyData
     *
     * @return void
     */
    public function testFilterEmpty(array $expected, array $value)
    {
        $this->assertEquals($expected, ArrayHelper::filterEmpty($value));
    }

    public function itemFilterEmptyData()
    {
        return [
            [
                [
                    'test' => 12,
                ],
                [
                    'test' => 12,
                    'test1'   => null
                ]
            ],
            [
                [

                ],
                [
                    'test' => null,
                ],
            ],
            [
                [],
                []
            ]
        ];
    }
}
