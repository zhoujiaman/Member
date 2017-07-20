<?php
namespace Member\Processor;

use Member\Exception\ProcessException;

trait ProcessorTrait
{
    private static $defaultCheckMemberType = 1;
    private $checkMemberType = 1;
    private $perPage = 15; // 每页记录数
    private $pageIndex = 1; // 当前页

    private $allowTypes = [
        1 => '会员号',
        2 => '实体卡号',
        3 => '手机号',
        4 => 'OpenID'
    ];

    /**
     * 设置查询方式
     * @param $type
     * @throws ProcessException
     */
    public function setCheckMemberType($type)
    {
        if (!array_key_exists($type, $this->allowTypes)) {
            throw new ProcessException(var_export($this->allowTypes, true));
        }
        $this->checkMemberType = $type;
    }

    public function getCheckMemberType()
    {
        return $this->checkMemberType;
    }

    /**
     * 设置每页记录数
     * @param $val
     */
    public function setPerPage($val)
    {
        $this->perPage = $val;
    }

    /**
     * 获取每页记录数
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * 设置当前页
     * @param $val
     */
    public function setPageIndex($val)
    {
        $this->pageIndex = $val;
    }

    /**
     * 获取当前页
     * @return int
     */
    public function getPageIndex()
    {
        return $this->pageIndex;
    }
}