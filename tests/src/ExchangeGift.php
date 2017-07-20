<?php
namespace MemberTest;

/**
 * @Pur ("会员换礼")
 */
class ExchangeGift
{
    /**
     * @Pur ("换礼")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function exchangeTest($process, $CheckMemberKey)
    {
        $process->exchange($CheckMemberKey, 'aaa', 1);
    }
}