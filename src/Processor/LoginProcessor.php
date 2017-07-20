<?php
namespace Member\Processor;

use Member\Config;
use Member\Crypt;
use Member\Http;

class LoginProcessor extends ProcessorAbstract
{
    protected $methodName = 'Login';
    protected $needToken = false;

    public function __construct(Config $config, Http $http, Crypt $crypt)
    {
        parent::__construct($config, $http, $crypt);
        $loginConfig = $config->getLoginConfig();
        $this->setClientInfo(
            $loginConfig['loginCode'],
            $loginConfig['password']
        );
    }

    public function setClientInfo($loginCode, $password)
    {
        $this['LicenseKey'] = $this->config->getLicenseKey();
        $ClientInfo = [
            'ClientIP' => '17.0.7.17',
            'LoginCode' => $loginCode,
            'Password' => $password,
            'LoginTime' => $this->getDate()
        ];
        $string = $this->crypt->DESEncrypt($this->toJson($ClientInfo));
        $this['ClientInfo'] = $string;
        $this->setStrMAC($string);
        return $this;
    }
}