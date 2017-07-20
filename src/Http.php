<?php
namespace Member;

use Member\Processor\ProcessorInterface;
use BeSimple\SoapClient\SoapClient;
use Pimple\Container;

class Http
{
    private $config;
    private $response;

    public function __construct(Container $pimple)
    {
        $this->config = $pimple['config'];
        $this->response = $pimple['response'];
    }

    /**
     * @param ProcessorInterface $processor
     * @return Response
     */
    public function request(ProcessorInterface $processor)
    {
        $client = new SoapClient($this->config->getWsdlURI());
        $params = $processor->getParams();
        $functionName = $processor->getMethodName();
        $response = $client->__soapCall($functionName, [$params]);
        return $this->response->parse(current($response));
    }
}