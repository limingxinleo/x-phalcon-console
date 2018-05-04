# x-phalcon-console

[![Build Status](https://travis-ci.org/limingxinleo/x-phalcon-console.svg?branch=master)](https://travis-ci.org/limingxinleo/x-phalcon-console)

## 安装
~~~
composer require limingxinleo/x-phalcon-console
~~~

## 使用
~~~php
<?php

use Xin\Phalcon\Cli\XConsole;
use Phalcon\DI\FactoryDefault\Cli;

// Your Method To Get DI;
$di = new Cli();
$di->setShared('dispatcher', function () {
    $dispatcher = new \Phalcon\Cli\Dispatcher();
    // Your Default Namespace
    $dispatcher->setDefaultNamespace('App\\Tasks');
    return $dispatcher;
});

$xconsole = new XConsole($di);

$xconsole->handle($argv);
~~~