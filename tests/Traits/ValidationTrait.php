<?php

declare(strict_types=1);

namespace Tests\Traits;

trait ValidationTrait
{
    protected function checkEquals($expected, $actual, array $checkedFields)
    {
        foreach ($checkedFields as $checkedField) {
            $this->assertEquals($expected->{$checkedField}, $actual->{$checkedField});
        }
    }
}
