<?php
namespace Member;

use phpseclib\Crypt\DES;
use phpseclib\Crypt\RSA;

class Crypt
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * DES 加密
     * @param $text
     * @return string
     */
    public function DESEncrypt($text)
    {
        $key = $this->config->getDESKey();
        $iv = $this->config->getDESIv();
        $des = new DES();
        $des->setKey($key);
        $des->setIV($iv);
        $encrypt = $des->encrypt($text);
        return base64_encode($encrypt);
    }


    /**
     * DES 解密
     * @param $text
     * @return string
     */
    public function DESDecrypt($text)
    {
        $key = $this->config->getDESKey();
        $iv = $this->config->getDESIv();
        $des = new DES();
        $des->setKey($key);
        $des->setIV($iv);
        return $des->decrypt(base64_decode($text));
    }

    /**
     * RSA 加密
     * @param null $string
     * @return string
     */
    public function RSAEncrypt($string = null)
    {
        $rsa = new RSA();
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
        $rsa->loadKey($this->config->getPublicKey());
        $string = empty($string) ? $this->config->getDESKey() : $string;
        $encrypt = $rsa->encrypt($string);
        return base64_encode($encrypt);
    }
}