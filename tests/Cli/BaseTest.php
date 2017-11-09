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
    public function testOptions()
    {
        $obj = $this->xconsole->handle(['run', 'main@options', '--t1=1', 't2=2', '--t3=3', 't4=4']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertEquals(['t1' => 1, 't3' => 3], $value);
    }

    public function testArguments()
    {
        $obj = $this->xconsole->handle(['run', 'main@arguments', '--t1=1', 't2=2', '--t3=3', 't4=4']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertEquals(['t2' => 2, 't4' => 4], $value);
    }

    public function testArgument()
    {
        $obj = $this->xconsole->handle(['run', 'main@argument', '--t1=1', 'test=2', '--t3=3', 't4=4']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertEquals(2, $value);
    }

    public function testOption()
    {
        $obj = $this->xconsole->handle(['run', 'main@option', '--t1=1', '--test=2', '--t3=3', 't4=4']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertEquals(2, $value);
    }

    public function testHasOption()
    {
        $obj = $this->xconsole->handle(['run', 'main@hasOption', '--t1=1', '--test=2', '--t3=3', 't4=4']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertTrue($value);
    }

    public function testHasArgument()
    {
        $obj = $this->xconsole->handle(['run', 'main@hasArgument', '--t1=1', 'test=2', '--t3=3', 't4=4']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertTrue($value);
    }

    public function testSubTask()
    {
        $obj = $this->xconsole->handle(['run', 'test:main', '--t1=1', 'test=2', '--t3=3', 't4=4']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertTrue($value);

        $obj = $this->xconsole->handle(['run', 'test:main', '--t1=1', 'test=2', '--t3=3', 't4=4']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertTrue($value);
    }

    public function testDefault()
    {
        $obj = $this->xconsole->handle(['run', 'main@optionDefault']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertEquals(1, $value);

        $obj = $this->xconsole->handle(['run', 'main@argumentDefault']);
        $value = $obj->dispatcher->getReturnedValue();
        $this->assertEquals(1, $value);
    }
}