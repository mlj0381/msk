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

class site_ctl_admin_setting extends desktop_controller
{
    public function __construct($app) {
        parent::__construct($app);
        $this->mMap = $this->app->model('map');
    }
    public function index(){
        if($_POST){
            $this->begin();
            $this->update_order($_POST['ordernum']);
            foreach ($_POST as $key => $value) {
                app::get('site')->setConf($key,$value);
            }
            $this->end(true,'保存成功');
        }
        include($this->app->app_dir.'/setting.php');
        foreach ($setting as $key => $value) {
            if($value['desc']){
                $this->pagedata['setting'][$key] = $value;
                $this->pagedata['setting'][$key]['value'] = $this->app->getConf($key);
            }
        }
        
        //vmc::dump($this->app->app_dir,$this->pagedata['setting']);
        $this->page('admin/setting.html');
    }
    
    public function website(){
        $this->pagedata['setting']['site_map'] = $this->app->model('map')->get_list('*');
        $this->page('admin/website.html');
    }
    
    public function site_map($map_id){
        $this->pagedata['cat'] = $this->mMap->getList('*', array('pid' => 0));
        $this->pagedata['map'] = $this->mMap->getRow('*', array('id' => $map_id));
        $this->display('admin/add_map.html');
    }
    
    public function add_map(){
        $post = $_POST;
        $act = $post['id'] ? 'website' : 'index';
        $this->begin('index.php?app=site&ctl=admin_setting&act='.$act);
        $post['createtime'] = time();
        if(!$post) $this->end(false, '非法请求');
        if(!$this->mMap->save($post)) $this->end(false, '操作失败');
        $this->end(true, '操作成功');
    }
    
    public function cat_map($cat_id){
        $cat_item = $this->mMap->getRow('*', array('id' => $cat_id));
        $this->pagedata['map'] = $cat_item;
        $this->display('admin/cat_map.html');
    }
    
    public function remove($map_id, $type = false){
        $this->begin('index.php?app=site&ctl=admin_setting&act=index');
        if($type){
            $check_son = $this->mMap->getList('*', array('pid' => $map_id));
        }
        if(!empty($check_son)){
            $this->end(false, '该分类下还是站点，不允许删除');
        }
        if(!$this->mMap->delete(array('id' => $map_id))){
            $this->end(false, '删除失败');
        }
        $this->end(true, '删除成功');
    }

    public function update_order($order){
        foreach ($order as $key => $value){
            $filter = array(
                'id' => $key,
                'ordernum' => $value,
            );
            $this->mMap->save($filter); 
        }
    }
}//End Class
