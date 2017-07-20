<?php
namespace MemberTest;

/**
 * @Pur ("会员积分历史查询")
 */
class BonusHistory
{
    /**
     * @Pur ("查询正确")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function queryTest($process, $CheckMemberKey)
    {
        $process->query($CheckMemberKey);
    }

    /**
     * @Pur ("查询正确分页")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function queryPageTest($process, $CheckMemberKey)
    {
        $process->setPageIndex(8);
        $process->query($CheckMemberKey);
    }

    /**
     * @Pur ("查询失败")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKeyError",
     * )
     */
    public function queryFailTest($process, $CheckMemberKey)
    {
        $process->query($CheckMemberKey);
    }
}