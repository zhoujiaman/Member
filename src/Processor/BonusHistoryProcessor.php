<?php

/**
 * 会员积分历史查询
 */
namespace Member\Processor;

class BonusHistoryProcessor extends ProcessorAbstract
{
    use ProcessorTrait;

    protected $methodName = 'getBonusHistory';

    /**
     * @param $id
     * @return \Member\Response
     */
    public function query($id)
    {
        $this->setStrJson([
            'CheckMemberType' => $this->getCheckMemberType(),
            'CheckMemberKey' => $id,
            'PerPage' => $this->getPerPage(),
            'PageIndex' => $this->getPageIndex(),
        ]);
        return $this->request();
    }

    public function isSuccess()
    {
        return parent::isSuccess() && empty(parent::getMessage());
    }
}