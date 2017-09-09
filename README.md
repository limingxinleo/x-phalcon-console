# x-phalcon-console

## 安装
~~~
composer require limingxinleo/x-phalcon-console
~~~

## 使用
~~~php
<?php
use Xin\Phalcon\Cli\XConsole;

// Your Method To Get DI;
$di = (new DI($config))->getDI();

$xconsole = new XConsole($di);

$xconsole->handle($argv);
~~~