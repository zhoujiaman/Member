<?php
/**
 * @Annotation
 * @Target("ALL")
 */
class Pur
{
    public $type = 'string';

    public $value;

    public function __construct($values)
    {
        $this->value = current($values);
    }
}