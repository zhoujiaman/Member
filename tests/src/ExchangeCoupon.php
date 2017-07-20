<?php
namespace MemberTest;

/**
 * @Pur ("会员领券")
 */
class ExchangeCoupon
{
    /**
     * @Pur ("领券")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function exchangeTest($process, $CheckMemberKey)
    {
        $process->exchange($CheckMemberKey, 102, 1);
    }
}