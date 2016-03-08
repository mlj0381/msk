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
 class b2c_datasetting_index extends base_setting
 {//$url_preview = app::get('site')->router()->gen_url(array('app'=>'b2c','ctl'=>'site_product','args'=>array('g'.$row['goods_id'])));
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
                         break;
                     }
                     $value['item']['url'] = $this->router->gen_url($v['url']);
                 }
                 return $value;
             }
         }
     }

     public function slider()
     {
         foreach($this->setting['slider'] as $key => $value)
         {
             $this->setting['slider'][$key]['url'] = $this->router->gen_url($v['url']);
         }
         return $this->setting['slider'];
     }
 }
