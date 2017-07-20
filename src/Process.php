<?php
namespace Member;

use Member\Exception\ProcessException;
use Pimple\Container;

/**
 * Class Process
 * @package Member
 * @property \Member\Processor\LoginProcessor $login
 */
class Process
{
    private $pimple;

    public function __construct(Container $pimple)
    {
        $this->pimple = $pimple;
    }

    public function __get($name)
    {
        $classname = $this->buildClassName($name);
        if (!class_exists($classname)) {
            throw new ProcessException(sprintf('processor %s is\'t found', $name));
        }
        /**
         * @var \Member\Processor\ProcessorAbstract $class
         */
        $class = new $classname(
            $this->pimple['config'],
            $this->pimple['http'],
            $this->pimple['crypt']
        );
        if ($class->needToken()) {
            // 比如 LoginProcessor 不需要设置 token
            $class->setToken($this->pimple['client']->getToken());
        }
        return $class;
    }

    public function __isset($name)
    {
        $classname = $this->buildClassName($name);
        return class_exists($classname);
    }

    private function buildClassName($name)
    {
        return '\\Member\\Processor\\' . ucfirst($name) . 'Processor';
    }
}