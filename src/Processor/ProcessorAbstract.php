<?php
namespace Member\Processor;

use Member\Config;
use Member\Http;
use Member\Crypt;

abstract class ProcessorAbstract implements \ArrayAccess, ProcessorInterface
{
    protected $config;
    protected $http;
    protected $crypt;
    protected $params = [];
    protected $query = [];
    protected $methodName = null;
    protected $needToken = true;

    /** @var  \Member\Response */
    protected $response;

    public function __construct(Config $config, Http $http, Crypt $crypt)
    {
        $this->config = $config;
        $this->http = $http;
        $this->crypt = $crypt;
    }

    /**
     * 获取业务参数
     * @return array
     */
    public function getParams()
    {
        $params = $this->params;
        if (isset($params['StrJson'])) {
            $params['CallTime'] = $this->getDate();
            $params['StrJson'] = $this->crypt->DESEncrypt($this->toJson($this['StrJson']));
            $params['StrMAC'] = $this->buildStrMAC($params['StrJson']);
        }
        return $params;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * @param $value
     */
    public function setStrJson($value)
    {
        $this['StrJson'] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function buildQuery()
    {
        return http_build_query($this->query);
    }

    /**
     * 获取 soap function_name
     * @return null
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * 设置业务请求 token
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->params['Token'] = $token;
        return $this;
    }

    /**
     * 判断是否需要token
     * @return bool
     */
    public function needToken()
    {
        return $this->needToken;
    }

    /**
     * @param $str
     * @return $this
     */
    public function setStrMAC($str)
    {
        $this['StrMAC'] = $this->buildStrMAC($str);
        return $this;
    }

    /**
     * @param $str
     * @return string
     */
    private function buildStrMAC($str)
    {
        return strtoupper(md5($str));
    }

    /**
     * @param null|array $val
     * @return string
     */
    public function toJson($val)
    {
        return json_encode($val);
    }

    /**
     * @return \Member\Response
     */
    public function request()
    {
        $response = $this->http->request($this);
        $this->setResponse($response);
        return $response;
    }

    /**
     * @param \Member\Response $response
     */
    protected function setResponse(\Member\Response $response)
    {
        $this->response = clone $response;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->response->isSuccess();
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->response->getMessage();
    }

    /**
     * @return array
     */
    public function getResponseParams()
    {
        return $this->response->getParams();
    }

    /**
     * @return \Member\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->params[$offset]) ? $this->params[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->params[$offset] = $value;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->params[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->params[$offset]);
    }

    /**
     * 打印参数
     * @return string
     */
    public function __toString()
    {
        return var_export([
            'STATUS' => $this->isSuccess(),
            'MESSAGE' => $this->getMessage(),
            'RESULT' => $this->getResponseParams(),
            'REQUEST' => $this->params
        ], true);
    }
}