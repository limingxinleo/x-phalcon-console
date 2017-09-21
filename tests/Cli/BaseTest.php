<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Cli;

use Tests\TestCase;

class BaseTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testEcho1()
    {
        $this->xconsole->handle(['run']);
        $this->xconsole->handle(['run', 'main@main']);
        $this->xconsole->handle(['run', 'main@test']);
        $this->xconsole->handle(['run', 'test:main']);
        $this->xconsole->handle(['run', 'test:main@main']);
        $this->xconsole->handle(['run', 'test:main@test']);
    }

}