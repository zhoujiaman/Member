<?php
require '../vendor/autoload.php';
use Member\Application;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use ReflectionClass as C;
use ReflectionMethod as M;

$method = $_GET['m'] ?: null;
$ds = DIRECTORY_SEPARATOR;
$reader = new AnnotationReader();
$loader = function ($class) use ($ds) {
    $file =  __DIR__ . $ds . 'annotation' . $ds . $class . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
};
AnnotationRegistry::registerLoader($loader);

if (empty($method)) {
    $handle = opendir('src');
    while ($file = readdir($handle)) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        $className = str_replace('.php', '', $file);
        $reflectionClass = new C('\\MemberTest\\' . $className);
        $classAnnotation = $reader->getClassAnnotation($reflectionClass, 'Pur');
        $pur = isset($classAnnotation->value) ? $classAnnotation->value : 'null';
        echo '<div><a href="?m=' . str_replace('.php', '', $file) . '">'
            . '(' . $pur . ') ' . $file . '</a></div>';
    }
} else {
    $config = require 'config.php';
    $application = new Application($config);
    $process = $application->$method;
    $className = '\\MemberTest\\' . $method;
    $reflectionClass = new C($className);
    $class = $reflectionClass->newInstance();
    $classMethods = $reflectionClass->getMethods();
    foreach ($classMethods as $classMethod) {
        if (preg_match('/Test$/', $classMethod->name)) {
            $reflectionMethod = new M($class, $classMethod->name);
            $methodAnnotation = $reader->getMethodAnnotation($reflectionMethod, 'Pur');
            $pur = isset($methodAnnotation->value) ? $methodAnnotation->value : 'null';
            $params = $reader->getMethodAnnotation($reflectionMethod, 'Param');
            $methodParameters = $reflectionMethod->getParameters();
            $args = [];
            foreach ($methodParameters as $p) {
                if ($p->name == 'process') {
                    $args[$p->name] = $process;
                } elseif (isset($params->{$p->name})) {
                    $args[$p->name] = $params->{$p->name};
                } else {
                    $args[$p->name] = null;
                }
            }
            $t = microtime(true);
            $reflectionMethod->invokeArgs($class, $args);
            $t = microtime(true) - $t;
            $m = memory_get_usage();
            $msg = $process->__toString();
            echo <<<EOF
<div style="padding-left: 20px;">
    <div><span style="color: green">$pur</span>($classMethod->name)</div>
    <div style="color: brown">$t</div>
    <div style="color: brown">$m</div>
    <pre style="font-family: 'Microsoft YaHei UI'; color: orangered;">$msg</pre>
</div>
EOF;
        }
    }
}