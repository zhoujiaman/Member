<?php

/**
 * 会员信息查询
 */
namespace Member\Processor;

class MemberInfoProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'MemberInfo';

    /**
     * @param int $type 1:会员号 2:实体卡号 3:手机号 4:OpenID
     * @param string $id
     * @return \Member\Response
     */
    public function query($id)
    {
        $this->setStrJson([
            'CheckMemberType' => $this->getCheckMemberType(),
            'CheckMemberKey' => $id
        ]);
        return $this->request();
    }

    public function isSuccess()
    {
        return parent::isSuccess() && empty(parent::getMessage());
    }
}