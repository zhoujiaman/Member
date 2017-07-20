<?php
require '../vendor/autoload.php';

use Member\Application;

$config = require 'config.php';
//var_dump($config);

$t = microtime(true);
$application = new Application($config);
$a = $application->client;
var_dump($a->getToken());

//var_dump($a);
echo microtime(true) - $t;