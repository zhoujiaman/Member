<?php
namespace Member\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Member\Process;

class ProcessServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['process'] = function($c) {
            return new Process($c);
        };
    }
}