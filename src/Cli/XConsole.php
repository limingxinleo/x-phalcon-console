<?php
// +----------------------------------------------------------------------
// | XConsole.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Phalcon\Cli;

use Phalcon\Cli\Console;
use Phalcon\Text;

class XConsole extends Console
{
    const ARGUMENTS_TYPE_ARRAY = 0;
    const ARGUMENTS_TYPE_STRING = 1;

    protected $argvType;

    public function handle(array $argv = null)
    {
        $arguments = $this->getArgumentsFromArgv($argv);
        return parent::handle($arguments);
    }

    public function getArgumentsFromArgv(array $argv = null)
    {
        $arguments = [];

        if (empty($argv[1])) {
            return $arguments;
        }

        $task = $argv[1];

        if (strpos($task, ':') !== false || strpos($task, '@') !== false) {
            // 新Cli入参方式

            $result = explode('@', $argv[1]);
            // dd($action);
            if (empty($result[1])) {
                $action = 'main';
            } else {
                $action = $result[1];
            }

            if (empty($result[0])) {
                $task = 'Main';
            } else {
                $task = implode('\\', array_map(
                    function ($v) {
                        return Text::camelize($v);
                    },
                    explode(':', $result[0])
                ));
            }
            $arguments['task'] = $task;
            $arguments['action'] = $action;
            if (isset($argv[2])) {
                $arguments['params'] = array_slice($argv, 2, count($argv) - 2);
            }
        } else {
            foreach ($argv as $k => $arg) {
                if ($k == 1) {
                    $arguments['task'] = $arg;
                } elseif ($k == 2) {
                    $arguments['action'] = $arg;
                } elseif ($k >= 3) {
                    $arguments['params'][] = $arg;
                }
            }
        }
        return $arguments;
    }


}