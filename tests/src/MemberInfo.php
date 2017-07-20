<?php

namespace MemberTest;
/**
 * @Pur ("会员信息查询")
 */
class MemberInfo
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