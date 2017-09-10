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
use Symfony\Component\Finder\Finder;

class NotFindTask extends Task
{
    /** @var  命名空间 */
    protected $namespace;
    /** @var  脚本目录 */
    protected $tasksDir;
    /** @var  脚本名称 */
    protected $taskName;
    /** @var  方法名称 */
    protected $actionName;
    /** @var  脚本命令名 */
    protected $tasksName = [];

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
        $finder = new Finder();
        $res = $finder->files()->in($this->tasksDir)->name("*.php");
        if ($res->count() === 0) {
            echo "Command {$this->taskName} is not defined" . PHP_EOL;
            return true;
        }

        foreach ($res as $file) {
            $name = $this->fileToTaskName($file->getRelativePath(), $file->getBasename(), '.php');
            if ($this->similiar($this->taskName, $name)) {
                $this->tasksName[] = $name;
            }
        }

        if (count($this->tasksName) === 0) {
            echo "Command {$this->taskName} is not defined" . PHP_EOL;
            return true;
        }

        echo "Command {$this->taskName} is not defined" . PHP_EOL;
        echo "Did you mean one of these?" . PHP_EOL;

        foreach ($this->tasksName as $name) {
            echo "    " . $name . PHP_EOL;
        }

    }

    /**
     * @desc   把相应文件转化为相应脚本名
     * @author limx
     */
    protected function fileToTaskName($relativePath, $baseName, $ext = '.php')
    {
        if (!empty($relativePath)) {
            $name = $relativePath . '\\' . rtrim($baseName, $ext);
        } else {
            $name = rtrim($baseName, $ext);
        }

        return $name;
    }

    /**
     * @desc   判断两者是否相似
     * @author limx
     * @param $expect
     * @param $actual
     */
    protected function similiar($expect, $actual)
    {
        if (stristr($actual, $expect) !== false) {
            return true;
        }

        $actual = explode('\\', $actual);
        $expect = explode('\\', $expect);
        foreach ($expect as $i => $v) {
            $is_true = isset($actual[$i])
                && isset($expect[$i])
                && stristr($actual[$i], $expect[$i]) !== false;
            if ($is_true) {
                return true;
            }
        }

        return false;
    }
}