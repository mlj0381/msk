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


final class ectools_payment_applications_cod extends ectools_payment_parent implements ectools_payment_interface {
    public $name = '货到付款';
    public $version = '1.0';
    public $intro = "货到付款";
    public $platform_allow = array(
        'pc',
        'mobile',
        'app'
    );
    /**
     * 显示支付接口表单选项设置
     * @params null
     * @return array - 字段参数
     */
    public function setting() {
        return array(
            'display_name' => array(
                'title' => '支付方式名称' ,
                'type' => 'text',
                'default' => '货到付款'
            ) ,
            'order_num' => array(
                'title' => '排序' ,
                'type' => 'number',
                'default' => 0
            ) ,
            'pay_fee' => array(
                'title' => '交易费率 (%)' ,
                'type' => 'text',
                'default' => 0
            ) ,
            'description' => array(
                'title' => '支付方式描述' ,
                'type' => 'html',
                'default' => '货到付款支付方式描述'
            ) ,
            'status' => array(
                'title' => '是否开启此支付方式' ,
                'type' => 'radio',
                'options' => array(
                    'true' => '是' ,
                    'false' => '否' ,
                ) ,
                'default' => 'true',
            ) ,
        );
    }
    public function dopay($payment,&$msg) {
        return true;
    }
    public function callback(&$recv) {
    }
    public function notify(&$recv) {
    }
}
