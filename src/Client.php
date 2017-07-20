<?php
namespace Member;

class Client
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var \Doctrine\Common\Cache\Cache
     */
    private $cache;

    /**
     * @var string
     */
    private $token;

    /**
     * @var Process
     */
    private $process;

    const CACHE_TOKEN = 'member_token';
    const CACHE_DEFAULT_LIFETIME = 1200;

    /**
     * Handle constructor.
     * @param Config $config
     */
    public function __construct(Config $config, Process $process)
    {
        $this->config = $config;
        $this->cache = $config->getCache();
        $this->process = $process;
    }

    /**
     * 获取 token
     * @return string
     */
    public function getToken()
    {
        if (empty($this->token)) {
            $this->token = $this->cache->fetch(self::CACHE_TOKEN);
            if (!$this->token) {
                $this->flushToken();
            }
        }
        return $this->token;
    }

    /**
     * 刷新 token
     * @return string
     */
    public function flushToken()
    {
        $this->token = $this->login();
        return $this->token;
    }

    /**
     * @return string
     */
    protected function login()
    {
        $process = $this->process->login;
        $result = $process->request();
        $token = $result->token;

        // token 第二天0点失效
        $datetime = new \DateTime();
        $interval = new \DateInterval('P1D');
        $now = $datetime->getTimestamp();
        $datetime->add($interval);
        $datetime->setTime(0, 0, 0, 0);
        $lifetime = $datetime->getTimestamp() - $now;

        $this->cache->save(self::CACHE_TOKEN, $token, $lifetime);
        return $token;
    }
}