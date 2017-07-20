<?php
namespace Member\Processor;


interface ProcessorInterface
{
    public function buildQuery();

    public function getParams();

    public function getMethodName();

    public function setToken($token);
}