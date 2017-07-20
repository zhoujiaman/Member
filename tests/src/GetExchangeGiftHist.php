<?php
namespace MemberTest;

/**
 * @Pur ("会员换礼查询")
 */
class GetExchangeGiftHist
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