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


/*PC 端首页入口*/
class site_ctl_index extends site_controller{
    public $title='首页';

    function index(){

        if(vmc::singleton('site_theme_base')->theme_exists()){
            $this->set_tmpl('index');
            $this->page('index.html');
        }else{

            $this->display('no_theme.html');
        }
    }



//网站正在建设中
    public function build(){
    	$this->display('build.html');
    }

}
