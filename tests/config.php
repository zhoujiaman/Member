<?php
use Doctrine\Common\Cache\FilesystemCache;
$fileCache = new FilesystemCache('cache');

$publicKey = <<<EOF
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC/XJXgscp8dk53hKxZpTo5dSCN
9cE6QWy8EAeHBGFa/Pwb3cmIvOFesLqqxsTVwEeBn2KIOTrGqrygqOb1ioCMNEbZ
lZgRkjWz9xWUzXQ5qTMiSGzvaj9fvIXodDALZz1ckL9P09VUL4HaEDfMT7zyX2PE
SfuGq04se/vUij6ivQIDAQAB
-----END PUBLIC KEY-----
EOF;

return [
    'loginConfig' => [
        'loginCode' => '1003', // 客户端登录名
        'password' => '170717', // 登录密码
    ],
    //'publicKey' => 'RAS公钥', //RAS公钥
    'licenseKey' => 'hfULX2i6Ejrcj/p6qkToCMGl4Yc/3/VyqN96I9F1fYqa/gIzbHBNz/fI1pn/W0Ne5YLGcL/V9+srhHjKvIDcm+hKzyzkOydU0xeqWJEEjURQZanWL+rGfO7xjyZNsYu+ylQVyE6tHrptJrm9hjyImlvPT51zQkqn/XlXrK3FOC8=',

    'certPath' => null, // 证书

    'publicKey' => $publicKey,

    'cache' => $fileCache,

    'requestUrl' => 'http://demo.ess.com.cn:8085/MemberInterface.asmx?wsdl',

    'wsdlURI' => 'http://demo.ess.com.cn:8085/MemberInterface.asmx?wsdl',

    'DESKey' => '10031003',

    'DESIv' => '        ',

    'StoreID' => '108',
];