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


class ModifyMemberInfoProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'ModifyMemberInfo';

    /**
     * @param array $params[
            Name//会员姓名
            Gender//性别
            Birthday//生日
            Address联系地址
            CarNo车牌号
            Email邮箱
            LotherID证件号
            CertificateTypeID//证件类型
            "Profession":"公务员",
            "PersonalLove":"玩"
     * ]
     * @return \Member\Response
     */
    public function modify($id, array $params)
    {
        $params['CheckMemberType'] = $this->getCheckMemberType();
        $params['CheckMemberKey'] = $id;
        $this->setStrJson($params);
        return $this->request();
    }
}