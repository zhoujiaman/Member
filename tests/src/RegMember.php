<?php
namespace MemberTest;
/**
 * @Pur ("会员注册")
 */
class RegMember
{
    /**
     * @Pur ("注册成功")
     * @Param (
     *     data="~p1#RegData",
     * )
     */
    public function queryTest($process, $data)
    {
        $data['Mobile'] = '138847' . rand(10000, 99999);
        $process->create($data);
    }

    /**
     * @Pur ("注册失败")
     * @Param (
     *     data="~p1#RegData",
     * )
     */
    public function queryFailTest($process, $data)
    {
        $process->create($data);
    }
}