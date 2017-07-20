<?php

/**
 * 券定义查询
 */
namespace Member\Processor;

class GetCouponListProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'GetCouponList';

    const T_ALL = 1; // 查询所有
    const T_SINGLE = 2; // 单张券

    /**
     * @param string $id 如果为空，则查询所有券
     * @return \Member\Response
     */
    public function query($id = '')
    {
        $this->setStrJson([
            'CheckCouponType' => empty($id) ? self::T_ALL : self::T_SINGLE,
            'CheckCouponKey' => $id,
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