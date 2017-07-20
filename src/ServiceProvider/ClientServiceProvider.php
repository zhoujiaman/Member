<?php
namespace Member\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Member\Client;

class ClientServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['client'] = function($c) {
            return new Client($c['config'], $c['process']);
        };
    }
}