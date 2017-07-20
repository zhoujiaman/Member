<?php

/**
 * 会员身份验证
 */

namespace Member\Processor;


class CheckMemberProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'CheckMember';
    const DEFAULT_OPENIDTYPE = 0;

    /**
     * @param array $params
            CheckMemberType //查询方式 y 1:会员号 2:实体卡号 3:手机号 4:OpenID 默认 1
            CheckMemberKey //查询关键字，会员号或实体卡号或手机号或OpenID或车牌号 y
            ClientSystemTime //客户端系统时间 y 自动填充
            StoreID //项目ID y 自动填充
            OpenID  //访问源OPENID n
            OpenIDType // 访问源OPENID类型 y 0:无 1:微信 默认 0
     * @return \Member\Response
     */
    public function check(array $params)
    {
        $params = array_merge($params, [
            'CheckMemberType' => $this->getCheckMemberType(),
            'StoreID' => $this->config->getStoreID(),
            'ClientSystemTime' => $this->getDate(),
            'OpenIDType' => isset($params['OpenIDType'])
                ? $params['OpenIDType'] : self::DEFAULT_OPENIDTYPE
        ]);
        $this->setStrJson($params);
        return $this->request();
    }
}