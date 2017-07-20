<?php
namespace MemberTest;
/**
 * @Pur ("增减积分")
 */
class CreditAdjust
{
    /**
     * @Pur ("增加积分")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function plusTest($process, $CheckMemberKey)
    {
        $process->adjust($CheckMemberKey, 200, 'T000000001');
    }

    /**
     * @Pur ("减少积分")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function minusTest($process, $CheckMemberKey)
    {
        $process->adjust($CheckMemberKey, -200, 'T000000001');
    }
}