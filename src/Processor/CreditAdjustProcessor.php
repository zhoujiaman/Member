<?php

/**
 * 增减积分
 */

namespace Member\Processor;

class CreditAdjustProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'CreditAdjust';

    /**
     * @param string $key 查询关键字，会员号或实体卡号或手机号或OpenID或车牌号
     * @param int $bonus 增减积分数额 200 | -200
     * @param string $transId 交易识别号
     * @param string $desc 增减积分原因
     * @return \Member\Response
     */
    public function adjust($key, $bonus, $transId, $desc = '')
    {
        $params = [
            'CheckMemberType' => $this->getCheckMemberType(),
            'CheckMemberKey' => $key,
            'StoreID' => $this->config->getStoreID(),
            'Bonus' => $bonus,
            'ClientTransID' => $transId,
            'AdjustDesc' => $desc
        ];
        $this->setStrJson($params);
        return $this->request();
    }
}