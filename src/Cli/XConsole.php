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

    protected $run;

    protected $task;

    protected $action;

    protected $params;

    protected $argv;

    public function handle(array $argv = null)
    {
        $this->init($argv);

        return parent::handle([
            'task' => $this->task,
            'action' => $this->action,
            'params' => $this->params,
        ]);
    }

    /**
     * @desc   参数初始化
     * @author limx
     * @param array|null $argv
     * @return array
     */
    public function init(array $argv = null)
    {
        $this->argv = $argv;
        $arguments = [];

        if (empty($argv[1])) {
            return $arguments;
        }

        if ($this->getArgvType() === self::ARGUMENTS_TYPE_STRING) {
            // String 入参方式
            $result = explode('@', $argv[1]);

            // 设置Task
            if (empty($result[0])) {
                $this->task = 'Main';
            } else {
                $this->task = implode('\\', array_map(
                    function ($v) {
                        return Text::camelize($v);
                    },
                    explode(':', $result[0])
                ));
            }

            // 设置Action
            if (empty($result[1])) {
                $this->action = 'main';
            } else {
                $this->action = $result[1];
            }

            // 设置参数
            if (isset($argv[2])) {
                $this->params = array_slice($argv, 2, count($argv) - 2);
            }

        } else {
            // 数组入参方式
            foreach ($argv as $k => $arg) {
                if ($k == 1) {
                    $this->task = $arg;
                } elseif ($k == 2) {
                    $this->action = $arg;
                } elseif ($k >= 3) {
                    $this->params[] = $arg;
                }
            }
        }
    }

    /**
     * @desc   获取argv类型 str or array
     * @author limx
     */
    private function getArgvType()
    {
        $argv = $this->argv;
        if (strpos($argv[1], ':') !== false || strpos($argv[1], '@') !== false) {
            // 存在:或者@即为 新的入参方式（String方式）
            return self::ARGUMENTS_TYPE_STRING;
        }
        // 传统的Array入参方式
        return self::ARGUMENTS_TYPE_ARRAY;
    }


}