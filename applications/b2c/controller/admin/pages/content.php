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

class b2c_ctl_admin_pages_content extends desktop_controller
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
		$this->mContent = $this->app->model('pages_content');
		$this->_request = vmc::singleton('base_component_request');
		$this->_filter = $this->_request->get_get('filter');
    }

    public function index()
    {
		if ($this->has_permission('addcontent')) {
            $custom_actions[] = array(               
				'label' => ('添加内容') ,
				'icon' => 'fa-plus',
				'href' => $this->_url('content', 'add'),
            );

        }
		$custom_actions[] = $this->_set_pages_action();
		if(!empty($this->_filter['pages_id']))
		{
			$custom_actions[] = $this->_set_position_action($this->_filter['pages_id']);
		}
		// $custom_actions[] = $this->_set_palt_action();		
		$actions_base['title'] = ('广告管理');
        $actions_base['actions'] = $custom_actions;
		//$actions_base['use_buildin_filter'] = true;
		$actions_base['use_buildin_recycle'] = true;
		$actions_base['use_buildin_dialog']['id'] = 'pages_dialog';
		$actions_base['finder_extra_view'] = array(array(
			'app' => 'b2c',
			'view' => '/admin/pages/finder_content.html'
		));
		$this->finder('b2c_mdl_pages_content', $actions_base);
	}

	public function refresh()
    {
        $this->begin('index.php?app=b2c&ctl=admin_pages_content&act=index');
        $this->end(vmc::singleton('b2c_pages_content')->refresh($msg), $msg);
    }

	public function add()
    {
		$pages_id = isset($this->_filter['pages_id']) ? $pages_id = $this->_filter['pages_id'] : 0;
		$position_id = isset($this->_filter['position_id']) ? $this->_filter['position_id'] : 0;
		$this->pagedata['postion_psize']= $this->mPosition->getRow('width,height',$this->_filter['position_id']);
		$this->_set_filter_options($pages_id, $position_id);
		$this->page('admin/pages/content.form.html');
	}
	public function edit($content_id)
    {	
        if (empty($content_id)) $this->splash('error', 'index.php?app=content&ctl=admin_pages_content', '错误请求');
        $this->pagedata['content'] = $this->mContent->dump($content_id);
        if (empty($this->pagedata['content'])) $this->splash('error', 'index.php?app=content&ctl=admin_pages_content', '错误请求');
		$this->_set_filter_options($this->pagedata['content']['pages_id'], $this->pagedata['content']['position_id']);
		$this->pagedata['postion_psize']= $this->mPosition->getRow('width,height',$this->pagedata['content']['position_id']);
		print_r($postion_psize);
		$this->page('admin/pages/content.form.html');
	}

	public function save()
    {	
		$post = $this->_request->get_post('content');
		$this->begin($this->_url('content', 'index', array('pages_id' => $post['pages_id'], 'position_id' => $post['position_id'])));
		$content_id = $this->_request->get_post('content_id');
		$post['create_time'] = time();
		if ($content_id > 0) {
            $res = $this->mContent->update($post, compact('content_id'));            
        }else
		{
			$res = $this->mContent->insert($post);
		}
		if ($res) {               
			$this->end(true, '保存成功!' . $msg);
		} else {
			$this->end(false, '保存失败!' . $msg);
		}		
	}
	
	public function quick_update()
    {
        $this->begin('index.php?app=b2c&ctl=admin_pages_content&act=index');
        $params = $_POST;
        if (!$params['content_id']) {
            $this->end(false);
        }
        $content_id = $params['content_id'];
        unset($params['content_id']);
        foreach ($params as $key => $value) {
            if (!in_array($key, array('content_id', 'ordernum', 'status'))) {
                unset($params[$key]);
            }
        }        
        $update_sql  = base_db_tools::getupdatesql($this->mContent->table_name(1), $params," content_id=$content_id");
        $this->end($this->mContent->db->exec($update_sql,true));
    }

	private function _set_pages_action(){
		$label_default = '所有页面';		
		$pagesList = $this->mPages->getList('*');		
		foreach($pagesList as $key => $item)
		{
			$group[$item['pages_id']] = array(
				'label' => $item['name'],
				'href' => $this->_url('content', 'index', array('pages_id' => $item['pages_id'])),					
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
		if( isset($this->_filter['pages_id']) && ($pages_id = $this->_filter['pages_id']) && 
			isset($group[$pages_id]) && $page = $group[$pages_id])
		{	
			$label_default = $page['label'];
			unset($group[$pages_id]);
			array_unshift($group, array(
				'label' => '所有页面',
				'href' => $this->_url('content', 'index', array('pages_id' => '')),			
			));
		}
		return array(
			'label' => $label_default,
			'group' => $group,
			'class' => 'blue-madison'
		);
	}
	
	private function _set_position_action($pages_id){
		if(!$pages_id) return ;
		$label_default = '广告位置';		
		$positionsList = $this->mPosition->getList('*', array('pages_id' => $pages_id));
		foreach($positionsList as $key => $item)
		{
			$group[$item['position_id']] = array(
				'label' => $item['name'],				
				'href' => $this->_url('content', 'index', array(
					'position_id' => $item['position_id'],
					'pages_id' => $pages_id
				)),					
			);
		}		
		if ($this->has_permission('addposition')) {
			$group['add'] = array(
				'label' => ('添加位置') ,
				'icon'=>'fa-plus',
				'href' =>  $this->_url('position', 'add', $this->_filter),
				'data-target' => '#pages_dialog',
				'data-toggle' => 'modal'
			);
		}
		
		if(isset($this->_filter['position_id']) && $position_id = $this->_filter['position_id'])
		{
			if(isset($group[$position_id]) && $position = $group[$position_id])
			{		
				$label_default = $position['label'];
				unset($group[$position_id]);
				array_unshift($group, array(
					'label' => '所有位置',
					'href' => $this->_url('content', 'index', array('pages_id' => $pages_id)),			
				));
			}
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
				'href' => $this->_url('content', '', array('plat' => 0)),					
			),
			array(
				'label' => ('店铺') ,				
				'href' => $this->_url('content', '', array('plat' => 1)),				
			),
		);		
		if(isset($this->_filter['plat']) && isset($plats[$this->_filter['plat']]))
		{
			$label_default = $plats[$this->_filter['plat']]['label'];
			unset($plats[$this->_filter['plat']]);
			array_unshift($plats, array(
				'label' => '所有平台',
				'href' => $this->_url('content', '', array('plat' => '')),			
			));
		}
		return array(
			'label' => $label_default,			
			'group' => $plats,
			'class' => 'blue-madison'
		);
	}

	private function _set_filter_options($pages_id= 0, $position_id =0)
	{
		$positions = array(array(
			'position_id' => 0,
			'name' => '选择广告位',					
		));
		if($pages_id)
		{
			$this->pagedata['pageObject'] = $this->mPages->dump($pages_id);		
			if($position_id)
			{
				$this->pagedata['position'] = $this->mPosition->dump($position_id);
				if($pages_id != $this->pagedata['position']['pages_id'])
				{
					$this->splash('error', 'index.php?app=content&ctl=admin_pages_content', '错误请求');					
				}
			}		
			$_positions = $this->mPosition->getList("*", array('pages_id' => $pages_id, 'plat' => 0));			
			$_positions && $positions = array_merge($positions, $_positions);
		}		
		$this->pagedata['positions'] = $positions;		
		$this->pagedata['pages'] = $this->mPages->getList('*');		
		//$this->pagedata['plats'] = $this->app->getConf('pages_plat_type');
		$this->pagedata['types'] = $this->app->getConf('pages_content_types');
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