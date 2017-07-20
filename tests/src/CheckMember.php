<?php
namespace MemberTest;
/**
 * @Pur ("会员身份验证")
 */
class CheckMember
{
    /**
     * @Pur ("验证正确")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function checkTest($process, $CheckMemberKey)
    {
        $process->check([
            'CheckMemberKey' => $CheckMemberKey
        ]);
    }

    /**
     * @Pur ("验证失败")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKeyError",
     * )
     */
    public function checkFailTest($process, $CheckMemberKey)
    {
        $process->check([
            'CheckMemberKey' => $CheckMemberKey
        ]);
    }
}