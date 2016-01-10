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
// | Description 商家店铺
// +----------------------------------------------------------------------

class seller_ctl_site_tpl extends seller_frontpage
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
        $this->mStore = app::get('store')->model('store');		
		$this->mPages = app::get('b2c')->model('pages');
		$this->mPosition = app::get('b2c')->model('pages_position');
		$this->mPageContent = app::get('b2c')->model('pages_content');

    }
	
	public function index()
	{
		$this->pageData['pages'] = $this->mPages->getList('*', array('plat' => 1));
        $this->output();
    }
}