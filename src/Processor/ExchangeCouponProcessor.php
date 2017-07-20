<?php

/**
 * 会员领券
 */
namespace Member\Processor;

class ExchangeCouponProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'ExchangeCoupon';

    /**
     * @param string $id 会员ID
     * @param string $code 券编号
     * @param int $quantity 兑换数量
     * @return \Member\Response
     */
    public function exchange($id, $code, $quantity)
    {
        $this->setStrJson([
            'CheckMemberType' => $this->getCheckMemberType(),
            'CheckMemberKey' => $id,
            'ClientSystemTime' => $this->getDate(),
            'StoreID' => $this->config->getStoreID(),
            'CouponCode' => $code,
            'ExchangeQty' => $quantity
        ]);
        return $this->request();
    }

    public function isSuccess()
    {
        return parent::isSuccess() && empty(parent::getMessage());
    }
}