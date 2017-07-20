<?php

/**
 * 会员券包查询
 */
namespace Member\Processor;

class GetMemberCouponListProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'GetMemberCouponList';

    const S_ALL = 0; // 所有券
    const S_NORMAL = 1; // 有效/未使用
    const S_USED = 2; // 已使用
    const S_EXPRIED = 3; // 过期
    const S_INVALID = 4; // 作废

    const T_ALL = 0; // 所有券
    const T_PUR = 1; // 抵用券
    const T_CASH = 2; //代金券

    /**
     * @param string $id 如果为空，则查询所有券
     * @return \Member\Response
     */
    public function query($id, $status = self::S_ALL, $type = self::T_ALL)
    {
        $this->setStrJson([
            'CheckMemberType' => $this->getCheckMemberType(),
            'CheckMemberKey' => $id,
            'ClientSystemTime' => $this->getDate(),
            'StoreID' => $this->config->getStoreID(),
            'CouponStatus' => $status,
            'CouponType' => $type,
        ]);
        return $this->request();
    }

    public function isSuccess()
    {
        return parent::isSuccess() && empty(parent::getMessage());
    }
}