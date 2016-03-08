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

class seller_mdl_sellers extends dbeav_model
{
    public $has_tag = true;
    public $defaultOrder = array('regtime DESC');
    public $has_many = array(
        'pam_account' => 'sellers@pam:contrast:seller_id^seller_id',
        'store' => 'store@store:contrast:seller_id^seller_id',
        'aptitudes' => 'aptitudes:contrast:seller_id^seller_id',
        'brand' => 'brand:contrast:seller_id^seller_id',
        'company' => 'company:contrast:seller_id^seller_id',
    );
    public $subSdf = array(
        'default' => array(
            'pam_account' => array('*'),
         ),
         'checkin' => array(
             'store' => array('status'),
             'aptitudes' => array('status'),
             'brand' => array('status'),
             'company' => array('status'),
         ),
    );
}
