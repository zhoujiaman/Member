<?php
require '../vendor/autoload.php';

use phpseclib\Crypt\DES;

$des = new DES();
$des->setKey('a23456c8');

// echo $des->getKeyLength();

$encrypt = $des->encrypt('你好');
var_dump($encrypt);

$des = new DES();
$aa = 'vRBlsVxPlhID4boMlxe7vgxltCi6KhgPjw4HEN5wTp+6WIZWztcgf3IBGgMG4tVEaxHHrmLbnUQ4tkkMQ5Hyqyh8ggNoadqBLIWrOQL+jv\/Te0vWIa7CZG\/p8Bp2VKfAI\/2+9tUtIrrQfpjKMpW7nIYT6ItDWYNDJtlUyOW4X1+HK6wfL3RZBfgQQQiGKFhX';
$des->setKey('10031003');
$des->setIV('        ');
$r = $des->decrypt(base64_decode($aa));
var_dump(iconv('GB2312', 'UTF-8', $r));