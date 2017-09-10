<?php
// +----------------------------------------------------------------------
// | ListTask.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Phalcon\Cli\Tasks;

use Phalcon\Cli\Task;
use Phalcon\Cli\Console\Exception;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class ListTask extends Task
{
    protected $namespace;

    protected $tasksDir;

    protected $taskName;

    protected $actionName;

    public function mainAction(array $params = [])
    {
        $validator = $this->validateInputParams($params);
        if ($validator->valid()) {
            // 参数不合法
            throw new Exception($validator[0]->getMessage());
        }

        $this->tasksDir = $params['tasksDir'];
        $this->namespace = $params['namespace'];
        $this->taskName = $params['taskName'];
        $this->actionName = $params['actionName'];

        $this->handle();
    }

    /**
     * @desc   检查输入参数是否合法
     * @author limx
     */
    protected function validateInputParams($params)
    {
        $validator = new Validation();
        $validator->add(
            [
                'tasksDir',
                'namespace',
                'taskName',
                'actionName',
            ],
            new PresenceOf([
                'message' => [
                    'tasksDir' => 'The tasksDir is required',
                    'namespace' => 'The namespace is required',
                    'taskName' => 'The taskName is required',
                    'actionName' => 'The actionName is required',
                ]
            ])
        );
        return $validator->validate($params);
    }

    protected function handle()
    {
        echo 111;
    }
}