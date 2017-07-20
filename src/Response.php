<?php
namespace Member;

use function PHPSTORM_META\type;

class Response
{
    private $crypt;

    private $code = 0;

    private $message = null;

    private $params = [];

    const RESULT_SUCCESS = 1;

    public function __construct(Crypt $crypt)
    {
        $this->crypt = $crypt;
    }

    /**
     * 解析接口返回的结果
     * @param $string
     * @return $this
     */
    public function parse($string)
    {
        $this->reset();
        $data = $this->parseJson($string);
        $this->code = $data['Result'];
        if (self::RESULT_SUCCESS == $this->code) {
            $json = $this->crypt->DESDecrypt($data['StrJson']);
            if (!empty($json)) {
                $json = $this->iconv($json);
                $params = $this->parseJson($json);
                $flag = $params['Flag'] || $params['Status'];
                if (self::RESULT_SUCCESS != $flag) {
                    $this->code = $flag;
                }
                $this->params = $params;
                $this->message = $params['Message'];
            }
        } else {
            $this->message = $data['ResultText'];
        }
        return $this;
    }

    /**
     * 判断请求是否成功
     * @return bool
     */
    public function isSuccess()
    {
        return self::RESULT_SUCCESS == $this->code;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * 重置变量
     */
    private function reset()
    {
        $this->code = 0;
        $this->message = null;
        $this->params = [];
    }

    /**
     * 获取解析后的变量
     * @param $name
     */
    public function __get($name)
    {
        $name = ucfirst($name);
        return isset($this->params[$name]) ? $this->params[$name] : null;
    }

    /**
     * @param $string
     * @return mixed
     */
    private function parseJson($string)
    {
        return json_decode($string, true);
    }

    /**
     * @param $string
     * @return string
     */
    private function iconv($string)
    {
        return iconv('GB2312', 'UTF-8', $string);
    }
}