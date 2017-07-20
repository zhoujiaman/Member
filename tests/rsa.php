<?php
$privateKey = <<<EOF
-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBALtzbwPKQBpEJ8Gy
q/1n2v/EGlHtX/Q5ftWdP03splHM1Q/MzvQ7ctNw6pIIeu/x3NhzzF8C/kgR+8Ui
P1btYLpWknCgMHijs2yfazQNaclC0NydWV1DjBj1vB8mQLgKCZLIzNNUnAlXS6jM
EaavOgRPZ6mpljU3WN0A0wyshZuzAgMBAAECgYAK1aU5BtulqQLTQ0yFnRcfaWpM
Cfhd2WTnW+toyaDjYX9/Jktf+n+skP496peQft5Q9IB/jWC9MaznvA8FKztH8JzC
RKqPoubinEU8QPywor41bTziqrAlJLKMmB/H5TnAlBnRwv/dITYGnaQ+DQNsfEnU
Bo5NcKGzhaWDtqF8YQJBAN/KhmUMoR8B4jP1N6wQ0sUybXF/S8kn6uZZoa/XUEuT
j16VYPOOpbPgdGxCRBQsI5UNlp8dvgS12FReWcrlJY8CQQDWbfi7fUy91R8oKOg5
0ODnH+jbI1Vb7LTlgThZMOfPpozi5A9iS0kS2ce5os1M1HeXDYzuvWY9PNL6PXXH
Db2dAkEAimRj1/mHafVwPVFXrEB7FxeoNpfR9gOJcAndwzATp6kI8CTQX83HCwWy
+X/BOfhRyMsuaheqep85uHLgdGhgYQJBAK6e2+IDRg2Jk1fnCEac/an6aGyct5Sm
jSIhOzwXAZAut6jFxGltmdKKG4XnOH0KwWD3nf+Fqc7Qy5cRmepCHFkCQC1eh4Ly
BkW7SxrMnKyBAk5uXoDUWOeY9SqFe7puos5Ryt64eJzhe/tRDpZ7BSGsVmQ70Svb
pEM9mnYo86r825g=
-----END PRIVATE KEY-----
EOF;

$publicKey = <<<EOF
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC7c28DykAaRCfBsqv9Z9r/xBpR
7V/0OX7VnT9N7KZRzNUPzM70O3LTcOqSCHrv8dzYc8xfAv5IEfvFIj9W7WC6VpJw
oDB4o7Nsn2s0DWnJQtDcnVldQ4wY9bwfJkC4CgmSyMzTVJwJV0uozBGmrzoET2ep
qZY1N1jdANMMrIWbswIDAQAB
-----END PUBLIC KEY-----
EOF;

require '../vendor/autoload.php';
use phpseclib\Crypt\RSA;
$rsa = new RSA();
$rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
$rsa->loadKey($publicKey);
$a = '12345678';
$encrypt = $rsa->encrypt(($a));
var_dump(base64_encode($encrypt));


$rsa = new RSA();
$rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
$rsa->loadKey($privateKey);
//$rsa->setPrivateKey($privateKey);

$a1 = 'kSG+TqTC/yqAIr82Lr/Pe4kITFDZh8Ng0LO6eQnTy7OSl2R8lonFEbwb9GCuty3BGkiTliSU96l6P+HfJV9e2ZXw0Qw2wWaVYAK8j8rzoB47lMgAOBqB5gaYMqDzUSs0OZ1y4XGLr333Nhka9wStku6FEm+O4WlZ7pOgvsD+fdA=';
$a1 = base64_decode($a1);
$decrypt = $rsa->decrypt($encrypt);
var_dump($decrypt);

/*

require '../vendor/autoload.php';

use phpseclib\Crypt\RSA;
$rsa = new RSA();
$rsa->loadKey($publicKey);
$encrypt = $rsa->encrypt('hello');
var_dump($encrypt);

$rsa = new RSA();
$rsa->loadKey($privateKey);
$decrypt = $rsa->decrypt($encrypt);
var_dump($decrypt);

//$this->loadKey($privateKey);

//echo $rsa->getPublicKey();
/**
$key = $rsa->createKey(1024);
//var_dump($key);
echo $key['privatekey'];
echo '<br>';
echo $key['publickey'];
*/

