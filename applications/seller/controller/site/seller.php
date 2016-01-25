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
        if ($_POST) {
            $post = $_POST;
            $user_passport = vmc::singleton('seller_user_passport');
            $post['seller']['company_id'] = $this->pagedata['company']['company_id'];
            $post['seller']['seller_id'] = $this->seller['seller_id'];
            $user_passport->settled_company($post['seller']);
            $user_passport->signup_contactInfo($post['contact']);
        }
        $this->output();
    }

    //商户信息
    public function businessInfo() {
        $schedule = $this->app->model('sellers')->getRow('schedule', array('seller_id' => $this->seller['seller_id']));

        $this->menuSetting = 'account';
        $this->output();
    }

    //安全设置
    public function securitycenter() {
        $this->menuSetting = 'account';
        //$user_obj = vmc::singleton('seller_user_object');
        //$this->pagedata['pam_data'] = $user_obj->get_pam_data('*', $this->seller['seller_id']);
        $this->output();
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

    public function company() {
        $this->title .= "公司信息";
        if ($_POST)
            $this->_company_post($_POST);
        $seller = $this->app->model('sellers')->getRow('*', array(
            'seller_id' => $this->seller['seller_id']
        ));
        $this->pagedata['seller'] = $seller;
        $company = $this->app->model('company')->getRow('*', array(
            'company_id' => $seller['company_id']
        ));
        $this->pagedata['company'] = $company;
        $this->output();
    }

    // 公司信息提交
    private function _company_post() {
        extract($post);
        $this->begin($this->gen_url(array(
                    'app' => 'seller',
                    'ctl' => 'site_seller',
                    'act' => 'company'
        )));
        try {
            // 更新seller_company
            $mdl_company = $this->app->model('company');
            $update_company_data = compact('company_name', 'company_area', 'company_addr');
            if (!$mdl_company->update($update_company_data, array('company_id' => $company_id, 'seller_id' => $this->seller['seller_id']))) {
                throw new Exception('公司信息更新失败');
            }
            // 更新seller
            $update_seller_data = compact('area', 'addr', 'avatar');
            if (!$this->mSeller->update($update_seller_data, array('seller_id' => $this->seller['seller_id']))) {
                throw new Exception('商家信息更新失败');
            }
            // 更新contact
            $update_seller_data = compact('name', 'tel');
            $mdl_contact = $this->app->model('contact');
            if (!$mdl_contact->update($update_seller_data, array('company_id' => $contact_id, 'seller_id' => $this->seller['seller_id']))) {
                throw new Exception('联系人信息更新失败');
            }
        } catch (Exception $e) {
            $this->end(false, $e->getMessage());
        }
        $this->end(true, '成功');
    }

    

    

}
