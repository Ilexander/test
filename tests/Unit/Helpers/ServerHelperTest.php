<?php

namespace Tests\Unit\Helpers;

use App\Helpers\ServerHelper;
use Tests\TestCase;

class ServerHelperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetIp()
    {
        $this->assertEquals("127.0.0.1", ServerHelper::getIp());
    }
}
