<?php
// +----------------------------------------------------------------------
// | TestCase.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests;

use PHPUnit\Framework\TestCase as UnitTestCase;
use Xin\Phalcon\Cli\XConsole;
use Phalcon\DI\FactoryDefault\Cli;

class TestCase extends UnitTestCase
{
    public $xconsole;

    public function setUp()
    {
        // Your Method To Get DI;
        $di = new Cli();
        $di->setShared('dispatcher', function () {
            $dispatcher = new \Phalcon\Cli\Dispatcher();
            // Your Default Namespace
            $dispatcher->setDefaultNamespace('Tests\\App\\Tasks');
            return $dispatcher;
        });

        $this->xconsole = new XConsole($di);
    }
}