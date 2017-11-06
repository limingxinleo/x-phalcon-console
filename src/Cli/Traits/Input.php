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
    public function argument($name = null)
    {
        if (!isset($this->argument)) {
            $input = $this->dispatcher->getParams();
            $result = [];
            foreach ($input as $i => $item) {
                $res = explode('=', $item);
                if (strpos($res[0], '--') === 0) {
                    continue;
                }
                if (isset($res[1])) {
                    $result[$res[0]] = $res[1];
                } else {
                    $result[$res[0]] = true;
                }
            }
            $this->argument = $result;
        }

        if (is_null($name)) {
            return $this->argument;
        }

        if (isset($this->argument[$name])) {
            return $this->argument[$name];
        }

        return null;
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
    public function option($name = null)
    {
        if (!isset($this->option)) {
            $input = $this->dispatcher->getParams();
            $result = [];
            foreach ($input as $i => $item) {
                $res = explode('=', $item);

                if (strpos($res[0], '--') !== 0) {
                    continue;
                }

                $key = ltrim($res[0], '--');

                if (isset($res[1])) {
                    $result[$key] = $res[1];
                } else {
                    $result[$key] = true;
                }
            }

            $this->option = $result;
        }

        if (is_null($name)) {
            return $this->option;
        }

        if (isset($this->option[$name])) {
            return $this->option[$name];
        }

        return null;
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
}
