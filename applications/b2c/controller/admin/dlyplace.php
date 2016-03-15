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

class b2c_ctl_admin_dlyplace extends desktop_controller {
    public function __construct($app) {
        parent::__construct($app);
        $this->app = $app;
        $this->mDlyplace = $this->app->model('dlyplace');
        $this->mWarehouse = $this->app->model('warehouse');
    }
    public function index() {
        $action = array(
            'label' => ('添加仓库') ,
            'href' => 'index.php?app=b2c&ctl=admin_dlyplace&act=edit',
            'icon' => 'fa fa-plus',
        );
        $this->finder('b2c_mdl_dlyplace', array(
            'title' => ('仓库列表') ,
            'actions' => array(
                $action
            ) ,
            'use_buildin_set_tag' => false,
            'use_buildin_recycle' => true,
            'use_buildin_export' => false
        ));
    }
    public function edit($dlyplace_id) {
        if ($dlyplace_id) {
            $dlyplace = $this->mDlyplace->dump($dlyplace_id);
            $dlyplace['warehouse'] = $this->mWarehouse->getList('*', array('dlyplace_id' => $dlyplace['dp_id']));
            $this->pagedata['dlyplace'] = $dlyplace;
        }
        $this->page('admin/delivery/dlyplace.html');
    }
    public function save() {
        $this->begin('index?app=b2c&ctl=admin_dlyplace&act=index');
        $warehouse = $_POST['warehouse'];
        unset($_POST['warehouse']);
        $db = vmc::database();
        $db->beginTransaction();
        $result = $this->mDlyplace->save($_POST);
        if (!$result){
            $db->rollback();
            $this->end(false, '保存失败!');
        }
        $warehouse['dlyplace_id'] = $_POST['dp_id'] ?: $db->lastinsertid();
        foreach($warehouse['addr_id'] as $key => $value)
        {
            $disabled = $warehouse['addr_id'][$key] == $warehouse['disabled'][$key] ? 'true' : 'false';
            $data = array(
                'addr_id' => $warehouse['addr_id'][$key],
                'addr' => $warehouse['addr'][$key],
                'dlyplace_id' => $warehouse['dlyplace_id'],
                'id' => $warehouse['id'][$key],
                'disabled' => $disabled,
                'title' => $warehouse['title'][$key]
            );
            if(!$result = $this->mWarehouse->save($data))
            {
                $db->rollback();
                $this->end(false, '保存失败!');
            }
        }
        $db->commit();
        $this->end(true, '保存成功!');
    }

    public function delWarehouse()
    {
        $this->begin('index.php?app=b2c&ctl=admin_dlyplace&act=index');
        if(empty($_POST)) $this->end('false', '非法请求');
        if($this->app->model('warehouse')->delete(array('id' => $_POST['id'])))
        {
            $this->end('true', '操作成功');
        }
        $this->end('true', '操作失败');
    }
}
