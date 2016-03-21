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

class seller_ctl_site_seller extends seller_frontpage {

    public $title = '商家中心';

    public function __construct(&$app) {
        parent::__construct($app);
        $this->verify();
        $this->mPam_seller = app::get('pam')->model('sellers');
        $this->mSeller = $this->app->model('sellers');
    }

    // 商家首页
    public function index() {
        $this->pagedata['sellers'] = $this->mPam_seller->getRow('*', array(
            'seller_id' => $this->seller['seller_id']
        ));
        $this->pagedata['order_count'] = app::get('b2c')->model('orders')->type_count(array('store_id' => $this->store['store_id']));
        $this->output();
    }

    //账户信息
    public function account()
    {
        $this->menuSetting = 'account';
        if (!empty($_POST['seller'])) {
            $this->_account($_POST['seller']);
        }
        $this->pagedata['seller'] = $this->seller;
        $this->output();
    }

    private function _account($post){
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_seller', 'act' => 'account'));
        $post['seller_id'] = $this->seller['seller_id'];
        $result = $this->app->model('sellers')->save($post);
        if(!$result){
            $this->splash('error', $redirect, '操作失败');
        }
        $this->splash('success', $redirect, '操作成功');
    }

    //商户信息
    public function businessInfo($step = 1, $storeType = 1, $index = 1)
    {
        !is_numeric($step) && $step = 1;
        $companyInfo = $this->app->getConf('seller_entry');
        $step == 1 && $licence_type = $this->_request->get_get('card') ?:
            $this->passport_obj->new_or_old($this->seller['seller_id'], $storeType, $index);

        $columns = $this->passport_obj->page_setting($step, $licence_type, $storeType);
        if(!$this->seller['ident'] & 1) unset($companyInfo[1]);
        if(!$this->seller['ident'] & 2) unset($companyInfo[2]);
        if(!$this->seller['ident'] & 4) unset($companyInfo[4]);
        unset($companyInfo['comm']);
        //1为工厂店铺  只有一个
        $mdl_company_seller = app::get('base')->model('company_seller');
        $identity = array(2, 4);
        foreach($identity as $value)
        {
            $company_sellers[$value] = $mdl_company_seller->getList('company_id',
                array('uid' => $this->seller['seller_id'], 'identity' => $value, 'from' => 1));
        }
        //1 为工厂店铺 删除多余的营业执照字段 old or new
        if($step == 1) $this->passport_obj->unsetColumns($licence_type, $companyInfo[$storeType]['pageSet'][1]);
        foreach($companyInfo as $key => $value)
        {
            $companyInfo[$key] = array($value);
        }
        foreach($company_sellers as $key => $company_seller)
        {
            foreach($company_seller as $k => $v)
            {
                $company_columns[$key][$k] = $companyInfo[$key][0];
            }
            $companyInfo[$key] = $company_columns[$key] ?: $companyInfo[$key];
        }
        $this->pagedata['company'] = $companyInfo;
        $this->passport_obj->entryType = 'centre';
        $this->pagedata['info'] = $this->passport_obj->edit_info($columns, $this->seller['seller_id'], $storeType, $index);
        $this->pagedata['info']['company_extra']['type'] = 'center';
        $this->pagedata['info']['company_extra']['page_setting'] = $this->passport_obj->columns();
        $this->pagedata['activePage'] = $step;
        $this->pagedata['company_index'] = $index - 1;
        $this->pagedata['storeType'] = $storeType;
        $this->menuSetting = 'account';
        $this->output();
    }

    public function save_businessInfo(){
        $redirect = $this->gen_url(array(
            'app' => 'seller',
            'ctl' => 'site_seller',
            'act' => 'businessInfo'
        ));
        if(empty($_POST)) $this->splash('error', $redirect, '非法请求');
        $params = utils::_filter_input($_POST);
        unset($_POST);
        $result = $this->passport_obj->entry($params);
        if(!$result) $this->splash('error', $redirect, '操作失败');
        $this->splash('success', $redirect, '修改成功');
    }
    //安全设置
    public function securitycenter() {
        $this->menuSetting = 'account';
        $this->pagedata['seller'] = $this->seller;
        $this->output();
    }
    //手机绑定
    public function set_pam_mobile() {
        $this->page('site/seller/set_mobile.html');
    }
    //邮箱绑定
    public function set_pam_email() {
        $this->page('site/seller/set_email.html');
    }

    //消息中心
    public function message() {
        $this->menuSetting = 'message';
        $this->output();
    }

    //结算管理
    public function clearing() {
        $this->output();
    }


    

    

}
