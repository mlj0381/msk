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

class b2c_ctl_admin_pages_position extends desktop_controller
{
    public $use_buildin_import = true;
	public $use_buildin_dialog = true;	

	//public $use_buildin_selectrow = true;

	public function __construct($app)
    {
        parent::__construct($app);
        header('cache-control: no-store, no-cache, must-revalidate');
		$this->mPages = $this->app->model('pages');
		$this->mPosition = $this->app->model('pages_position');
		$this->_request = vmc::singleton('base_component_request');
		$this->_filter = $this->_request->get_get('filter');
    }

    public function index()
    {
		if ($this->has_permission('addposition')) {
            $custom_actions[] = array(
                'label' => ('添加位置') ,
                'icon'=>'fa-plus',
                'href' => $this->_url('position', 'add'),
				'data-target' => '#pages_dialog',
				'data-toggle' => 'modal',				
            );
        }
		$custom_actions[] = $this->_set_pages_action();
		$custom_actions[] = $this->_set_palt_action();
		$actions_base['title'] = ('页面推荐位列表');
        $actions_base['actions'] = $custom_actions;
		//$actions_base['use_buildin_filter'] = true;
		$actions_base['use_buildin_recycle'] = true;
		$actions_base['use_buildin_dialog']['id'] = 'pages_dialog';
		$actions_base['finder_extra_view'] = array(array(
			'app' => 'b2c',
			'view' => '/admin/pages/finder_position.html'
		));
		$this->finder('b2c_mdl_pages_position', $actions_base);
	}
	public function add()
    {
		$pages_id = isset($this->_filter['pages_id']) ? $pages_id = $this->_filter['pages_id'] : 0;
		$this->pagedata['pageObject'] = $this->mPages->dump($pages_id);
		$this->pagedata['plat'] = isset($this->pagedata['pageObject']) ? $this->pagedata['pageObject']['plat'] : 0;
		$this->pagedata['pages'] = $this->mPages->getList('*');		
		$this->pagedata['plats'] = $this->app->getConf('pages_plat_type');
		$this->pagedata['types'] = $this->app->getConf('pages_position_types');	
		$this->pagedata['multi'] = array(1 => '是');
		$this->page('admin/pages/position.form.html');
	}
	public function edit($position_id)
    {
        if (empty($position_id)) $this->splash('error', 'index.php?app=content&ctl=admin_pages_position', '错误请求');
        $this->pagedata['position'] = $this->mPosition->dump($position_id);
        if (empty($this->pagedata['position'])) $this->splash('error', 'index.php?app=content&ctl=admin_pages_position', '错误请求');
		$this->pagedata['pageObject'] = $this->mPages->dump($this->pagedata['position']['pages_id']);
		$this->pagedata['plat'] = $this->pagedata['position']['plat'];
		$this->pagedata['pages'] = $this->mPages->getList('*');
		$this->pagedata['types'] = $this->app->getConf('pages_position_types');	
		$this->pagedata['plats'] = $this->app->getConf('pages_plat_type');		
		$this->page('admin/pages/position.form.html');
	}	
	public function save()
    {
		$this->begin('index.php?app=b2c&ctl=admin_pages_position&act=index');
		$post = $this->_request->get_post('position');
		$position_id = $this->_request->get_post('position_id');
		$post['create_time'] = time();
		if ($position_id > 0) {
            $res = $this->mPosition->update($post, compact('position_id'));            
        }else
		{
			$res = $this->mPosition->insert($post);
		}
		if ($res) {               
			$this->end(true, '保存成功!' . $msg);
		} else {
			$this->end(false, '保存失败!' . $msg);
		}
	}
	
	public function quick_update()
    {
        $this->begin('index.php?app=b2c&ctl=admin_pages_position&act=index');
        $params = $_POST;
        if (!$params['position_id']) {
            $this->end(false);
        }
        $position_id = $params['position_id'];
        unset($params['position_id']);
        foreach ($params as $key => $value) {
            if (!in_array($key, array('position_id', 'ordernum'))) {
                unset($params[$key]);
            }
        }
        $mPostion = app::get('b2c')->model('pages_position');
        $update_sql  = base_db_tools::getupdatesql($this->mPosition->table_name(1), $params," position_id=$position_id");
        $this->end($this->mPosition->db->exec($update_sql,true));
    }
	public function page_position()
	{
		$this->begin('index.php?app=b2c&ctl=admin_pages_position&act=index');
		$pages_id = $this->_request->get_get('pages_id');
		if($pages_id)
		{			
			$positions = $this->mPosition->getList('position_id,pages_id,name', array('pages_id' => $pages_id));		
			$positions || $positions = Array();
			$this->end(true, 'sucess', null, array('result' => $positions));
		}
		$this->end(false, '失败');
	}

	private function _set_pages_action(){
		$label_default = '所有页面';		
		$pagesList = $this->mPages->getList('*');		
		foreach($pagesList as $key => $item)
		{
			$group[$item['pages_id']] = array(
				'label' => $item['name'],
				'href' => $this->_url('position', '', array('pages_id' => $item['pages_id'])),					
			);
		}		
		if ($this->has_permission('addpages')) {
			$group['add'] = array(
				'label' => ('添加页面') ,
				'icon'=>'fa-plus',
				'href' =>  $this->_url('', 'add', $this->_filter),
				'data-target' => '#pages_dialog',
				'data-toggle' => 'modal'
			);
		}			  
		$page = empty($this->_filter['pages_id']) ? 0 : $this->_filter['pages_id'];		
		if($page)
		{
			$pageObj = $this->mPages->dump($page);
			if(!$pageObj) trigger_error('未知页面', E_USER_ERROR);
			$label_default = $pageObj['name'];
			unset($group[$page]);
			array_unshift($group, array(
				'label' => '所有页面',
				'href' => $this->_url('position', '', array('pages_id' => '')),			
			));
		}		
		return array(
			'label' => $label_default,			
			'group' => $group,
			'class' => 'blue-madison'
		);
	}

	private function _set_palt_action()
	{	
		$label_default = '所有平台';
		$plats = array(
			array(
				'label' => ('商城'),					
				'href' => $this->_url('position', '', array('plat' => 0)),					
			),
			array(
				'label' => ('店铺') ,				
				'href' => $this->_url('position', '', array('plat' => 1)),				
			),
		);		
		if(isset($this->_filter['plat']) && isset($plats[$this->_filter['plat']]))
		{
			$label_default = $plats[$this->_filter['plat']]['label'];
			unset($plats[$this->_filter['plat']]);
			array_unshift($plats, array(
				'label' => '所有平台',
				'href' => $this->_url('position', '', array('plat' => '')),			
			));
		}
		return array(
			'label' => $label_default,			
			'group' => $plats,
			'class' => 'blue-madison'
		);
	}
	private function _url($ctl='', $act='index', $filter=Array())
	{
		$app = 'b2c';		
		$ctl = 'admin_pages' . ($ctl ? '_' . $ctl : '');
		if($filter && $this->_filter)
		{
			$filter = array_merge($this->_filter, $filter);
		}else if($this->_filter)
		{
			$filter = $this->_filter;
		}
		$params = compact('app', 'ctl', 'act', 'filter');
		//print_r($params);
		return 'index.php?' . http_build_query($params);
	}
}