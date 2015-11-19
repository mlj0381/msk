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
        $this->router = app::get('site')->router();
     }
     public function city()
     {
         return $this->setting['city'];
     }

     public function good_cat($params)
     {
         $return = array();
         foreach ($this->setting['cat'] as $key => $value) {
             if($value['parent_id'] == 0)
             {
                 $return[$key] = $value;
             }
             else
             {
                 foreach ($return as $k => $v) {
                     foreach ($this->setting['cat'] as $key => $value) {
                        if($value['parent_id'] == $v['id'])
                        {
                            $return[$k]['items'][$key] = $value;
                        }
                        else
                        {
                            foreach ($return[$k]['items'] as $k1 => $v2) {
                                if($v2['id'] == $value['parent_id'])
                                {
                                    $return[$k]['items'][$k1]['items'] = $value;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $return;
        //print_r($return);
        //return $this->setting['cat'];
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

     public function goods_list_filter($params)
     {
         foreach($this->setting['filter'] as $key => $value)
         {
             if($key == $params['target'])
             {
                 $value['filter'] = $params['filter'];
                 return $value;
             }
         }
     }

     public function goods_list_cat($params)
     {
         $parent_id = $params['parent_id'] ? $params['parent_id'] : 0;
         foreach ($this->setting['cat'] as $key => $value) {
             if($parent_id == $value['parent_id'])
             {
                 $cat_list[$key] = $value;

             }
         }
         return $cat_list;
     }
 }
