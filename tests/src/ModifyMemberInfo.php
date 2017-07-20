<?php
namespace MemberTest;
/**
 * @Pur ("会员信息线上修改")
 */
class ModifyMemberInfo
{
    /**
     * @Pur ("修改名字")
     * @Param (
     *     CheckMemberKey="~p1#CheckMemberKey",
     * )
     */
    public function modifyTest($process, $CheckMemberKey)
    {
        $process->modify($CheckMemberKey, ['Name' => 'zjm']);
    }
}