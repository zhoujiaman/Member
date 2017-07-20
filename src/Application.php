<?php
namespace Member;

use Pimple\Container;

/**
 * Class Application
 *
 * @property \Member\Client $client
 * @property \Member\Config $config
 * @property \Member\Crypt $crypt
 * @property \Member\Http $http
 * @property \Member\Response $response
 * @property \Member\Process $process
 * @property \Member\Processor\LoginProcessor $login
 * @property \Member\Processor\RegMemberProcessor $regMember
 * @property \Member\Processor\MemberInfoProcessor $memberInfo
 */

class Application extends Container
{

    private $providers = [
        \Member\ServiceProvider\ProcessServiceProvider::class,
        \Member\ServiceProvider\ClientServiceProvider::class,
    ];

    public function __construct($config = [])
    {
        $providers = [
            'config' => function ($c) use ($config) {
                return new Config($config);
            },
            'crypt' => function ($c) {
                return new Crypt($c['config']);
            },
            'response' => function ($c) {
                return new Response($c['crypt']);
            },
            'http' => function ($c) {
                return new Http($c);
            },
        ];

        parent::__construct($providers);

        $this->registerServiceProvider();
    }

    private function registerServiceProvider()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider);
        }
    }

    public function __get($name)
    {
        if ($this->offsetExists($name)) {
            return $this->offsetGet($name);
        }
        if (isset($this->process->$name)) {
            return $this->process->$name;
        }
        return null;
    }

    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }
}