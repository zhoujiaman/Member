<?php

/**
 * 会员注册
 *
    'MembCard' => string '200000010' (length=9)
    'MemberID' => string '200000010' (length=9)
    'Message' => string '手机号已被注册' (length=21)
    'Status' => int 1
 */

namespace Member\Processor;


class RegMemberProcessor extends ProcessorAbstract
{
    protected $methodName = 'RegMember';

    const DEFAULT_SOURCETYPE = 0;

    /**
     * @param array $params[
            Name //姓名 y
            Gender//性别 y 1:男 2:女
            Birthday//生日 y
            Mobile//手机号 y
            CarNo//车牌号 n
            Address//地址 n
            Email//邮箱 n
            CardTP//卡属性 n
            StoreID//项目ID 自动填充
            OpenID//注册源OPENID n
            SourceType//会员来源 n  0:无 1:微信 默认 0
            RefereeMobile//推荐人手机号 n
     * ]
     * @return \Member\Response
     */
    public function create(array $params)
    {
        if (!isset($params['SourceType'])) {
            $params['SourceType'] = self::DEFAULT_SOURCETYPE;
        }
        $params['StoreID'] = $this->config->getStoreID();
        $this->setStrJson($params);
        return $this->request();
    }

    public function isSuccess()
    {
        $bool = parent::isSuccess();
        return $bool && empty(parent::getMessage());
    }

    public function getMembCard()
    {
        return $this->response->MembCard;
    }

    public function getMemberID()
    {
        return $this->response->MemberID;
    }
}