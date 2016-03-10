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

class b2c_ctl_admin_pages extends desktop_controller
{
    public $use_buildin_import = true;

	public function __construct($app)
    {
        parent::__construct($app);
        header('cache-control: no-store, no-cache, must-revalidate');
		$this->mPages = $this->app->model('pages');		
		$this->_request = vmc::singleton('base_component_request');
    }
    public function index()
    {
		
	}
	public function add()
    {
		$this->pagedata['plats'] = $this->app->getConf('pages_plat_type');
		$this->page('admin/pages/pages.form.html');
	}
	public function edit()
    {
		$this->pagedata['plats'] = $this->app->getConf('pages_plat_type');
		$this->page('admin/pages/pages.form.html');
	}	
	public function save()
    {
		$this->begin('index.php?app=b2c&ctl=admin_pages_position&act=index');
		$post = $this->_request->get_post('pages');
		$pages_id = $this->_request->get_post('pages_id');
		$post['create_time'] = time();
		if ($pages_id > 0) {
            $res = $this->mPages->update($post, compact('pages_id'));            
        }else
		{
			$res = $this->mPages->insert($post);
		}
		if ($res) {               
			$this->end(true, '保存成功!' . $msg);
		} else {
			$this->end(false, '保存失败!' . $msg);	
		}
	}
}