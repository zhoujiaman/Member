<?php

/**
 * 会员券包查询
 */
namespace Member\Processor;

class GetExchangeGiftHistProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'GetExchangeGiftHist';

    /**
     * @param string $id 如果为空，则查询所有券
     * @return \Member\Response
     */
    public function query($id)
    {
        $this->setStrJson([
            'CheckMemberType' => $this->getCheckMemberType(),
            'CheckMemberKey' => $id,
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