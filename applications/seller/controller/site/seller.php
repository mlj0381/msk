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

class seller_ctl_site_seller extends seller_frontpage
{
    public $title = '商家中心';

    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->verify();
    }

	// 商家首页
	public function index()
	{
		$this->output();
	}

    public function account()
    {
        $this->pagedata['company'] = $this->app->model('company')->getRow('*', array('seller_id' => $this->seller['seller_id']));
        $this->pagedata['contact'] = $this->app->model('contact')->getRow('*', array('seller_id' => $this->seller['seller_id']));
        if($_POST)
        {
            $post = $_POST;
            $user_passport = vmc::singleton('seller_user_passport');
            $post['seller']['company_id'] = $this->pagedata['company']['company_id'];
            $post['seller']['seller_id'] = $this->seller['seller_id'];
            $user_passport->settled_company($post['seller']);
            $user_passport->signup_contactInfo($post['contact']);
        }
        $this->output();
    }
	public function company()
	{
        $this->title .= "公司信息";
        if($_POST) $this->_company_post($_POST);
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

}
