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


class desktop_ctl_appcenter extends desktop_controller
{
    public $require_super_op = true;
    public function __construct(&$app)
    {
        parent::__construct($app);
        if (!$this->user->is_super()) {
            header('Content-Type:text/html; charset=utf-8');
            echo '您无权操作';
            exit;
        }
    } //End Function
    public function index()
    {
        $mdl_appscenter = app::get('base')->model('apps');
        $this->pagedata['apps'] = $mdl_appscenter->getList('*');
        $this->pagedata['core_apps'] = $mdl_appscenter->getList('*', array('app_id' => $locked_app_ids));
        $this->page('appcenter/index.html');
    }
    
}
