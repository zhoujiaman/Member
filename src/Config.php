<?php
namespace Member;

use \Doctrine\Common\Cache\Cache;

class Config
{
    /**
     * @var string $requestUrl
     */
    private $requestUrl;

    /**
     * @var Cache $cache
     */
    private $cache;

    /**
     * @var array $loginConfig
     */
    private $loginConfig = [
        'loginCode' => null,
        'password' => null
    ];

    /**
     * @var string $DESKey
     */
    private $DESKey;

    /**
     * @var string $certPath
     */
    private $certPath;
    private $licenseKey;
    private $publicKey;
    private $wsdlURI;
    private $DESIv;
    private $storeID;

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        foreach ($config as $key => $val) {
            $methodName = 'set' . ucfirst($key);
            if (method_exists($this, $methodName)) {
                $this->$methodName($val);
            }
        }
    }

    /**
     * 设置登录参数
     * @param $val
     * @return $this
     */
    public function setLoginConfig($val)
    {
        $this->loginConfig = array_merge($this->loginConfig, $val);
        return $this;
    }

    /**
     * 获取登录参数
     * @return array
     */
    public function getLoginConfig()
    {
        return $this->loginConfig;
    }

    /**
     * 设置请求地址
     * @param $val
     * @return $this
     */
    public function setRequestUrl($val)
    {
        $this->requestUrl = $val;
        return $this;
    }

    /**
     * 获取请求地址
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    /**
     * 设置缓存
     * @param Cache $cache
     * @return $this
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;
        return $this;
    }

    /**
     * @return Cache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param $val
     * @return $this
     */
    public function setLicenseKey($val)
    {
        $this->licenseKey = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getLicenseKey()
    {
        return $this->licenseKey;
    }

    /**
     * 设置 RSA 加密公钥
     * @param $val
     * @return $this
     */
    public function setPublicKey($val)
    {
        $this->publicKey = $val;
        return $this;
    }

    /**
     * 获取 RSA 加密公钥
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * @param $val
     * @return $this
     */
    public function setCertPath($val)
    {
        $this->certPath = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getCertPath()
    {
        return $this->certPath;
    }

    /**
     * set URI of the WSDL file
     * @param $val
     * @return $this
     */
    public function setWsdlURI($val)
    {
        $this->wsdlURI = $val;
        return $this;
    }

    /**
     * get URI of the WSDL file
     * @return mixed
     */
    public function getWsdlURI()
    {
        return $this->wsdlURI;
    }

    /**
     * 设置 DES 加密密钥
     * @param $val
     * @return $this
     */
    public function setDESKey($val)
    {
        $this->DESKey = $val;
        return $this;
    }

    /**
     * 获取 DES 加密密钥
     * @return string
     */
    public function getDESKey()
    {
        return $this->DESKey;
    }

    /**
     * 设置 DES 加密iv
     * @param $val
     * @return $this
     */
    public function setDESIv($val)
    {
        $this->DESIv = $val;
        return $this;
    }

    /**
     * 获取 DES 加密iv
     * @return string
     */
    public function getDESIv()
    {
        return $this->DESIv;
    }

    /**
     * @param $val
     * @return $this
     */
    public function setStoreID($val)
    {
        $this->storeID = $val;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStoreID()
    {
        return $this->storeID;
    }
}