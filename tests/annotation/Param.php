<?php
/**
 * @Annotation
 * @Target("METHOD")
 */
class Param
{

    public $type = 'array';

    public $values = [];

    public function __construct(array $values)
    {
        foreach ($values as $key => $value) {
            if (preg_match('/^~/', $value)) {
                $values[$key] = $this->loadData(substr($value, 1));
            }
        }
        $this->values = $values;
    }

    public function __get($name)
    {
        return $this->values[$name];
    }

    public function __isset($name)
    {
        return isset($this->values[$name]);
    }

    public function loadData($str)
    {
        $ds = DIRECTORY_SEPARATOR;
        $array = explode('#', $str);
        list($file, $key) = $array;
        $data = require dirname(__DIR__) . $ds . 'data' . $ds . $file . '.php';
        return $data[$key];
    }
}