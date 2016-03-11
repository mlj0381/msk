<?php

// +----------------------------------------------------------------------
// | VMCSHOP [V M-Commerce Shop]
// +----------------------------------------------------------------------
// | Copyright (c) vmcshop.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.vmcshop.com/licensed)
// +----------------------------------------------------------------------
// | Author: Shanghai ChenShang Software Technology Co., Ltd.
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// | Description:商品档案卡字段匹配
// +----------------------------------------------------------------------
class seller_goods_columns
{

    public $type = '';  //档案卡类型
    public $convertType = ''; //转换类型
    public $params = Array(); //参数

    /*
     * 取得相对应档案卡的方法名
     * */
    private function _fun_name()
    {
        if(empty($this->type))
            return null;
        return 'fun_name';
    }
    /*
     * 原种种源标准指标档案卡
     * */
    private function _seed_source()
    {
        return Array();
    }

    /*
     * 原种饲养标准指标档案卡
     * */
    private function _feed_source()
    {
        return Array();
    }

    /*
     * 产品加工技术标准指标档案卡
     * */
    private function _process()
    {
        return Array();
    }

    /*
     * 产品加工质量标准指标档案卡
     * */
    private function _process_quality()
    {
        return Array();
    }

    /*
     * 产品通用质量标准指标档案卡
     * */
    private function _so_quality()
    {
        return Array();
    }

    /*
     * 产品安全标准指标档案卡
     * */
    private function _secure()
    {
        return Array();
    }

    /*
     * 储存运输标准指标档案卡
     * */
    private function _transport()
    {
        return Array();
    }

    /*
     * 包装标准指标档案卡
     * */
    private function _packing()
    {
        return Array();
    }

    /*
     * 字段转换
     * @return $params 转换好的数组
     * */
    public function &init()
    {
        $fun_name = $this->_fun_name();
        if(!method_exists($this, $fun_name))
            return Array();
        $columns = $this->$fun_name();
        return $columns;
    }
}