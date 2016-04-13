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


class b2c_ctl_admin_goods_cat extends desktop_controller
{
    public function __construct($app)
    {
        parent::__construct($app);
        header('cache-control: no-store, no-cache, must-revalidate');
    }

    public function index($parent_id = 0)
    {
        $mdl_goods_cat = $this->app->model('goods_cat');
        $tree = $mdl_goods_cat->get_tree($parent_id);
        $this->pagedata['tree'] = $tree;
        $this->pagedata['path'] = $mdl_goods_cat->getPath($parent_id);
        $this->page('admin/goods/category/map.html');
    }

    public function addnew($nCatId = 0)
    {
        $this->_info($nCatId);
    }

    public function _info($id = 0, $type = 'add')
    {
        $objCat = $this->app->model('goods_cat');
        $res = $objCat->dump($id, 'seo_info,gallery_setting');
        $seoCat = $res['seo_info'];
        $gallery_setting = $res['gallery_setting'];

        $aCat = $objCat->dump($id);
        $this->pagedata['cat']['parent_id'] = $aCat['cat_id'];
        $this->pagedata['cat']['type_id'] = $aCat['type_id'];
        if ($type == 'edit') {
            $this->pagedata['cat']['cat_id'] = $aCat['cat_id'];
            $this->pagedata['cat']['cat_name'] = $aCat['cat_name'];
            $this->pagedata['cat']['parent_id'] = $aCat['parent_id'];
            $this->pagedata['cat']['p_order'] = $aCat['p_order'];
        }
        $this->pagedata['seo_info'] = $seoCat;
        $this->pagedata['gallery_setting'] = $gallery_setting;
        $this->display('admin/goods/category/info.html');
    }

    public function save()
    {
        if ($_POST['no_redirect']) { //为了临时添加分类特殊处理
            $this->begin();
        } else {
            $redirect = 'index.php?app=b2c&ctl=admin_goods_cat&act=index';
            if ($_POST['cat']['parent_id']) {
                $redirect = 'index.php?app=b2c&ctl=admin_goods_cat&act=index&p[0]=' . $_POST['cat']['parent_id'];
            }
            $this->begin($redirect);
        }
        if ($_POST['p_order'] === '') {
            $_POST['p_order'] = 0;
        }
        $cat_data = $_POST['cat'];
        $objCat = $this->app->model('goods_cat');
        #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录管理员操作日志@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        if ($obj_operatorlogs = vmc::service('operatorlog.goods')) {
            $olddata = $objCat->dump($_POST['cat']['cat_id']);
        }
        #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录管理员操作日志@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        if ($objCat->save($cat_data)) {
            #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录管理员操作日志@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
            if ($obj_operatorlogs = vmc::service('operatorlog.goods')) {
                if (method_exists($obj_operatorlogs, 'goodscat_log')) {
                    $obj_operatorlogs->goodscat_log($cat_data, $olddata);
                }
            }

            #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录管理员操作日志@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
            $the_cat = $objCat->dump($cat_data['cat_id']);
            $this->end(true, ('保存成功'), null, array('the_cat' => $the_cat));
        } else {
            $this->end(false, ('保存失败'));
        }
    }

    public function remove($nCatId)
    {
        $objCat = $this->app->model('goods_cat');
        $cat_sdf = $objCat->dump($nCatId);
        $this->begin('index.php?app=b2c&ctl=admin_goods_cat&act=index&p[0]=' . $cat_sdf['parent_id']);
        if ($objCat->remove($nCatId, $msg)) {
            $this->end(true, $cat_sdf['cat_name'] . ('已删除'));
        }
        $this->end(false, $msg);
    }

    public function edit($nCatId)
    {
        $this->_info($nCatId, 'edit');
    }

    public function update()
    {
        $mdl_gcat = $this->app->model('goods_cat');
        $cat = $mdl_gcat->getRow('parent_id', array('cat_id' => current($_POST['p_order'])));
        $this->begin('index.php?app=b2c&ctl=admin_goods_cat&act=index&p[0]=' . $cat['parent_id']);
        foreach ($_POST['p_order'] as $k => $v) {
            $mdl_gcat->update(array('p_order' => ($v === '' ? null : $v)), array('cat_id' => $k));
        }
        $mdl_gcat->clean_cache();
        $this->end(true, ('操作成功'));
    }

    /**
     * 添加资质 页面
     * @param int $nCatId
     *
     */
    public function addAptitudes($nCatId = 0)
    {
        $this->pagedata['cat'] = $this->app->model('goods_cat')->getRow('cat_name, cat_id', array('cat_id' => $nCatId));
        $this->pagedata['aptitudes'] = $this->app->model('cat_aptitudes')->getRow('*', array('cat_id' => $nCatId));
        $this->display('admin/goods/category/addAptitudes.html');
    }

    /**
     * 设置分类所需资质
     */
    public function saveAptitudes()
    {
        $this->begin('index.php?app=b2c&ctl=admin_goods_cat&act=index');
        $data = array(
            'id' => $_POST['id'],
            'cat_id' => $_POST['cat_id'],
            'creature' => $_POST['creature'] ?: 'false',
            'food' => $_POST['food'] ?: 'false',
            'butcher' => $_POST['butcher'] ?: 'false',
            'muslim' => $_POST['muslim'] ?: 'false',
            'shanghai' => $_POST['shanghai'] ?: 'false',
            'iso14001' => $_POST['iso14001'] ?: 'false',
            'iso22000' => $_POST['iso22000'] ?: 'false',
            'iso9001' => $_POST['iso9001'] ?: 'false',
            'time' => time(),
        );
        if ($data['id']) {
            $sql = " UPDATE `vmc_b2c_cat_aptitudes` SET  `cat_id`={$data['cat_id']},`creature`='{$data['creature']}',`food`='{$data['food']}',`butcher`='{$data['butcher']}',`muslim`='{$data['muslim']}',`shanghai`='{$data['shanghai']}',`iso14001`='{$data['iso14001']}',`iso22000`='{$data['iso22000']}',`iso9001`='{$data['iso9001']}' WHERE `id`={$data['id']}";

        } else {
            $sql = "INSERT INTO `vmc_b2c_cat_aptitudes`(`cat_id`,`creature`,`food`,`butcher`,`muslim`,`shanghai`,
`iso14001`,`iso22000`,`iso9001`,`time` ) VALUES ({$data['cat_id']},'{$data['creature']}','{$data['food']}','{$data['butcher']}','{$data['muslim']}','{$data['shanghai']}','{$data['iso14001']}','{$data['iso22000']}','{$data['iso9001']}' ,'{$data['time']}')";
        }

        if (!$jg = vmc::database()->exec($sql)) {
            $this->end(false, '设置失败');
        }
        $this->end(true, '设置成功');
    }
}
