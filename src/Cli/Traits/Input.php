<?php
// +----------------------------------------------------------------------
// | Input.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Phalcon\Cli\Traits;

trait Input
{
    public $option;

    public $argument;

    /**
     * Get the value of a command argument.
     *
     * @param  string $key
     * @return string|array
     */
    public function argument($name = null, $default = null)
    {
        if (!isset($this->argument)) {
            $input = $this->dispatcher->getParams();
            $result = [];
            foreach ($input as $i => $item) {
                $res = explode('=', $item);
                if (strpos($res[0], '--') === 0) {
                    continue;
                }

                $result[$res[0]] = $this->getValue($res, $result);
            }
            $this->argument = $result;
        }

        if (is_null($name)) {
            return $this->argument;
        }

        if (isset($this->argument[$name])) {
            return $this->argument[$name];
        }

        return $default;
    }

    /**
     * Determine if the given argument is present.
     *
     * @param  string|int $name
     * @return bool
     */
    public function hasArgument($name)
    {
        $input = $this->argument();
        return isset($input[$name]);
    }


    /**
     * Get all of the arguments passed to the command.
     *
     * @return array
     */
    public function arguments()
    {
        return $this->argument();
    }

    /**
     * Determine if the given option is present.
     *
     * @param  string $name
     * @return bool
     */
    public function hasOption($name)
    {
        $options = $this->option();
        return isset($options[$name]);
    }

    /**
     * Get the value of a command option.
     *
     * @param  string $key
     * @return string|array
     */
    public function option($name = null, $default = null)
    {
        if (!isset($this->option)) {
            $input = $this->dispatcher->getParams();
            $result = [];
            foreach ($input as $i => $item) {
                $res = explode('=', $item);

                if (strpos($res[0], '--') !== 0) {
                    continue;
                }

                $res[0] = ltrim($res[0], '--');

                $result[$res[0]] = $this->getValue($res, $result);
            }

            $this->option = $result;
        }

        if (is_null($name)) {
            return $this->option;
        }

        if (isset($this->option[$name])) {
            return $this->option[$name];
        }

        return $default;
    }

    /**
     * Get all of the options passed to the command.
     *
     * @return array
     */
    public function options()
    {
        return $this->option();
    }

    /**
     * @desc
     * @author limx
     * @param $item [key,val]
     * @param $arr  当前入参数组
     */
    private function getValue($item, $arr)
    {
        $result = null;
        if (isset($arr[$item[0]]) && !is_bool($arr[$item[0]])) {
            $result = $arr[$item[0]];
            // 已经存在相同KEY的入参
            if (!is_array($result)) {
                $result = [$result];
            }
            $result = array_merge($result, [$item[1]]);
            return $result;
        }

        if (isset($item[1])) {
            return $item[1];
        }

        return true;
    }
}
