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


class vmcadmin_api_applications extends base_api
{
    public function applist($params)
    {
        $mdl_apps = app::get('base')->model('apps');
        $app_list = $mdl_apps->getList();
        $this->success($app_list);
    }

    public function active($params)
    {
        $app_id = $params['appid'];
        if(!$app_id)$this->failure();
        vmc::singleton('base_application_manage')->active($app_id);
        $this->success();
    }

    public function update($params)
    {
        $app_id = $params['appid'];
        if(!$app_id)$this->failure();
        vmc::singleton('base_application_manage')->update_local_app_info($app_id);
        $appinfo = app::get('base')->model('apps')->getRow('*',array('app_id'=>$app_id));
        if (version_compare($appinfo['local_ver'], $appinfo['dbver'], '>')){
            app::get('base')->model('apps')->update(array('dbver' => $appinfo['local_ver']), array('app_id' => $app_id));
            app::get($app_id)->runtask('pre_update', array('dbver' => $appinfo['dbver']));
            vmc::singleton('base_application_manage')->update_app_content_force($app_id);
            app::get($app_id)->runtask('post_update', array('dbver' => $appinfo['dbver']));
        }else{
            vmc::singleton('base_application_manage')->update_app_content($app_id);
        }
        $this->success();
    }

    public function pause($params)
    {
        $app_id = $params['appid'];
        if(!$app_id)$this->failure();
        vmc::singleton('base_application_manage')->pause($app_id);
        $this->success();
    }
    public function status($params)
    {
        $app_id = $params['appid'];
        if(!$app_id)$this->failure();
        $mdl_apps = app::get('base')->model('apps');
        $app = $mdl_apps->getRow('*',array('app_id'=>$app_id));
        $this->success($app);
    }
}
