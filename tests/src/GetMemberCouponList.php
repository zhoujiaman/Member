<?php
namespace MemberTest;

/**
 * @Pur ("会员券包查询")
 */
class GetMemberCouponList
{

    /**
     * @Pur ("查询所有")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function queryTest($process, $CheckMemberKey)
    {
        $process->query($CheckMemberKey);
    }
}