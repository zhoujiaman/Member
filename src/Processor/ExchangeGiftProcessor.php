<?php

/**
 * 会员换礼
 */
namespace Member\Processor;

class ExchangeGiftProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'ExchangeGift';

    /**
     * @param string $id 会员ID
     * @param string $code 编号
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
            'GiftID' => $code,
            'ExchangeQty' => $quantity
        ]);
        return $this->request();
    }

    public function isSuccess()
    {
        return parent::isSuccess() && empty(parent::getMessage());
    }
}