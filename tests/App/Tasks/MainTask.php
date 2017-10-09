<?php
// +----------------------------------------------------------------------
// | 默认脚本 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\App\Tasks;

use Phalcon\Cli\Task;
use Xin\Phalcon\Cli\Traits\Input;

class MainTask extends Task
{
    use Input;

    public function mainAction()
    {

    }

    public function testAction()
    {

    }

    public function paramsAction($params)
    {
        // print_r($this->arguments());
        // print_r($this->options());
        // print_r($this->hasOption('d'));
        // print_r($this->hasArgument('ff'));
        // print_r($this->option('f'));
        // print_r($this->argument('ff'));
    }
}