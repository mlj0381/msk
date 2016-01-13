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
	public $title = "店铺设置";

    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
		$this->verify_store(); // 开店审核
        $this->mStore = app::get('store')->model('store');	
		$this->mPages = app::get('b2c')->model('pages');
		$this->mPosition = app::get('b2c')->model('pages_position');
	}
	
	public function index()
	{
		$pagesRes = $this->mPages->getList('*', array('plat' => 1));
		foreach($pagesRes as $key => $val)
		{
			$this->pagedata['pages'][$val['pages_id']] = $val;
		}		
		$this->pagedata['position_types'] = app::get('b2c')->getConf('pages_position_types');
		$this->pagedata['positions'] = $this->mPosition->getList('*', array('plat' => 1));		
		$this->output();
    }

	public function content($position_id)
	{
		$mContent = app::get('b2c')->model('pages_content');
		$this->pagedata['position'] = $position = $this->mPosition->dump($position_id);
		$this->pagedata['pages'] = $this->mPosition->dump($position['pages_id']);
		$this->pagedata['contents'] = $mContent->getList('*', array(
			'store_id' => $this->store['store_id'],
			'position_id' => $position_id,
		));
		$this->title.= $this->pagedata['pages']['name'] . "-";
		$this->title.= $this->pagedata['position']['name'];
		$this->output();
    }

	public function content_add($position_id)
	{
		if($_POST) $this->content_save($_POST);
		if(!$position_id) $this->splash('error', $redirect, '添加失败');
		$this->pagedata['content_types'] = app::get('b2c')->getConf('pages_content_types');		
		$this->pagedata['position'] = $this->mPosition->dump($position_id);
		$this->pagedata['pages'] = $this->mPages->dump($this->pagedata['position']['pages_id']);
		$this->display('site/tpl/content.form.html');
		
	}
	public function content_edit($content_id)
	{	
		if($_POST) $this->content_save($_POST);
		if(!$content_id) $this->splash('error', $redirect, '错误的参数');
		$mContent = app::get('b2c')->model('pages_content');
		$this->pagedata['content'] = $content = $mContent->dump($content_id);
		$this->pagedata['content_types'] = app::get('b2c')->getConf('pages_content_types');
		$this->pagedata['position'] = $this->mPosition->dump($content['position_id']);
		$this->pagedata['pages'] = $this->mPages->dump($content['pages_id']);
		$this->display('site/content.form.html');
	}
	public function content_save($post)
	{	
		extract($post);
		$urlParams = array('app' => 'seller', 'ctl' => 'site_tpl', 'act' => 'index');		
		empty($content['position_id']) || $urlParams['args'][] = $content['position_id'];
        $redirect = $this->gen_url($urlParams);
		$this->begin($redirect);
		$mContent = app::get('b2c')->model('pages_content');
        if($content['content_id']){            
            if(!$mContent->save($content)){
                $this->end('error', $redirect, '添加失败');
            }
        }else{
            $content['create_time'] = time();
            $content['store_id'] = $this->store['store_id'];
            if(!$mContent->save($content)){
                $this->end('error', $redirect, '添加失败');
            }
        }
        $this->end('success', $redirect, '添加成功');
	}
	public function content_remove()
	{
	
	}
	public function content_refresh()
	{
	
	}
}