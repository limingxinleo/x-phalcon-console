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

    public function optionsAction()
    {
        return $this->options();
    }

    public function argumentsAction()
    {
        return $this->arguments();
    }

    public function optionAction()
    {
        return $this->option('test');
    }

    public function argumentAction()
    {
        return $this->argument('test');
    }

    public function hasOptionAction()
    {
        return $this->hasOption('test');
    }

    public function hasArgumentAction()
    {
        return $this->hasArgument('test');
    }
}