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

/**
 *  外来数据处理
 */
 class b2c_view_datasetting extends base_setting
 {
     public function __construct($app)
     {
        parent::__construct($app);
        include($this->app->app_dir.'/datasetting.php');
        $this->setting = $setting;
        $this->goods_list = $goods_list;
        $this->order_list = $order_list;
        $this->order_list_items = $order_list_items;
        $this->store = $store;
        $this->router = app::get('site')->router();
     }
     public function city()
     {
         return $this->setting['city'];
     }

     public function goods_list_cat(){
         return $this->setting['cat'];
     }
     public function good_cat($params)
     {
         $return = array();
         foreach ($this->setting['cat'] as $key => $value) {
             if($value['parent_id'] == 0)
             {
                 $return[$key] = $value;
                 unset($this->setting['cat'][$key]);
                 foreach ($this->setting['cat'] as $k1 => $v1) {
                    if($v1['parent_id'] == $return[$key]['id'])
                    {
                        $return[$key]['items'][$k1] = $v1;
                        unset($this->setting['cat'][$k1]);
                        foreach ($this->setting['cat'] as $k2 => $v2) {
                            if($v2['parent_id'] == $return[$key]['items'][$k1]['id'])
                            {
                                $return[$key]['items'][$k1]['items'][$k2] = $v2;
                                unset($this->setting['cat'][$k2]);
                            }
                        }
                    }
                }
             }
        }
        return $return;
    }

     public function floor_left($params)
     {
         foreach ($this->setting['floor'] as $key => $value) {
             if($value['type'] == $params['type'])
             {
                 foreach ($value['item'] as $k => $v) {
                     if($v['default'] == '1')
                     {
                         $v['url'] = $this->router->gen_url($v['url']);
                         return $v;
                     }
                 }
             }
         }
     }
     public function floor($params)
     {
         $mdl_goods = app::get('b2c')->model('goods');
         $mdl_goods->response_goods($params);
         
         foreach ($this->setting['floor'] as $key => $value) {
             if($value['type'] == $params['type'])
             {
                 foreach ($value['item'] as $k => $v) {
                     if($v['default'] == '1')
                     {
                         unset($value['item'][$k]);
                         continue;
                     }
                     $value['item'][$k]['url'] = $this->router->gen_url($v['url']);
                 }

                 return $value;
             }
         }
     }

     public function slider($params)
     {
         $image = $this->app->getConf($params['target']);
         return $image;
     }

     public function show_store($params)
     {
         foreach ($this->setting['store'] as $key => $value) {
             $this->setting['store'][$key]['url'] = $this->router->gen_url($value['url']);
         }
         return $this->setting['store'];
     }

     public function web_nav($params)
     {
         foreach ($this->setting['webnav'] as $key => $value) {
             $this->setting['webnav'][$key]['url'] = $this->router->gen_url($value['url']);
         }
         return $this->setting['webnav'];
     }
     /**
      * 获取商品属性
      * @param $params 属性类型
      */
     public function goods_list_filter($params, $type = true)
     {
         foreach($this->setting['filter'] as $key => $value)
         {
             if($key == $params['target']){
                 if($type){
                     $value['filter'] = $params['filter'];
                     $value['active'] = $params['active'];
                     return $value;
                 }else{
                     foreach ($value['item'] as $k => $v) {
                         if($v['id'] == $params['id']){
                             return $v['name'];
                         }
                     }
                 }
             }
         }
     }

     public function order_list($filter, $page, $orderby){
         foreach ($this->order_list as $key => $value) {
             if($value['member_id'] != $filter['member_id']){
                 unset($this->order_list[$key]);
             }
             foreach ($this->store as $k => $v) {
                 if($v['store_id'] == $value['store_id']){
                     $this->order_list[$key]['store_name'] = $v['store_name'];
                 }
             }
         }
         return $this->order_list;
     }
     public function order_list_item($filter){
         $return = array();
         foreach ($filter as $key => $value) {
             foreach ($this->order_list_items as $k => $v) {
                 if($value == $v['order_id']){
                     $return[$key] = $v;
                 }
             }
         }
         return $return;
     }

     //商品列表页按属性搜索获取单个属性值
     public function list_search(&$search_info, $params)
     {
        foreach ($params as $key => $id) {
            $query = $params;
            unset($query[$key]);
            $target = array_shift(explode('_', $key));
            $label = $this->goods_list_filter(compact('target', 'id'), false);
            $url = http_build_query($query);
            $search_info['prop'][$target] = compact('id', 'label' ,'url');
        }
        unset($search_info['prop']['cat']);
     }
     
     //网页底部内容管理
     public function index_footer(){
        $mdl_content = app::get('content')->model('article_nodes');
        $data = $mdl_content->fetch_all();
        $return = array();
        $items = array();
        foreach($data as $value){
            $items[$value['node_id']] = $value;
        }
        unset($data);
        foreach($items as  $item){
            if(isset($items[$item['parent_id']])){
                $items[$item['parent_id']]['son'][] = &$items[$item['node_id']];
            }else{
                $return[] = &$items[$item['node_id']];
            }
        }
        return $return;
     }
     
     /*
      * 获取基础数据
      */
     public function basic($params){
         $params['member_id'] = vmc::singleton('b2c_user_object')->get_member_id();
         $return = array();
         foreach(vmc::servicelist('index_basic_api') as $k => $object){
             $return[end(explode('_', $k))] = $object->basic($params);
         }
         return $return;
     }
     
     /*
      * 获取广告数据
      */
     public function advertising($params){
         $advertising_api = vmc::singleton('b2c_source_advertising');
         return $advertising_api->read_advertising($params);
     }
     
 }
