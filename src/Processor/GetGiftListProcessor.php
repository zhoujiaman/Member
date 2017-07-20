<?php

/**
 * 礼品定义查询
 */
namespace Member\Processor;

class GetGiftListProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'GetGiftList';

    const T_ALL = 1; // 查询所有
    const T_SINGLE = 2; // 查询单张

    /**
     * @param string $id 如果为空，则查询所有券
     * @return \Member\Response
     */
    public function query($id = '')
    {
        $this->setStrJson([
            'CheckGiftType' => empty($id) ? self::T_ALL : self::T_SINGLE,
            'CheckGiftKey' => $id,
            'ClientSystemTime' => $this->getDate(),
            'StoreID' => $this->config->getStoreID(),
        ]);
        return $this->request();
    }

    public function isSuccess()
    {
        return parent::isSuccess() && empty(parent::getMessage());
    }
}