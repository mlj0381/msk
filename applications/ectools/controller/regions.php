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


class ectools_ctl_regions extends desktop_controller
{
    public function __construct($app)
    {
        parent::__construct($app);
        header('cache-control: no-store, no-cache, must-revalidate');
    }

    public function index($type = '0')
    {
        $this->showarea($type);
    }

    /**
     * 展示所有地区.
     *
     * @params null
     */
    private function showarea($type)
    {
        //$dArea = $this->app->model('regions');
        $obj_regions_op = vmc::service('ectools_regions_apps', array('content_path' => 'ectools_regions_operation'));
        $obj_regions_op->type = $type;
        $this->path[] = array('text' => '配送地区列表');
        if ($obj_regions_op->getTreeSize()) {
            //超过100条
            $this->pagedata['area'] = $obj_regions_op->getRegionById();
        } else {
            $this->pagedata['area'] = $obj_regions_op->getRegionById();
//            $obj_regions_op->getMap();
//            $this->pagedata['area'] = $obj_regions_op->regions;
        }
        $this->pagedata['type'] = $type;
        $this->page('regions/area_treeList.html');
    }

    public function getChildNode()
    {
        $obj_regions_op = vmc::service('ectools_regions_apps', array('content_path' => 'ectools_regions_operation'));
        $obj_regions_op->type = $_POST['type'];
        $this->pagedata['area'] = $obj_regions_op->getRegionById($_POST['regionId']);

        $this->display('regions/area_sub_treeList.html');
    }

    /**
     * 修改地区信息的入口.
     *
     * @params null
     */
    public function save()
    {
        $redirect  = 'index.php?app=ectools&ctl=regions&act=index';
        if($_POST['region']['type'] === '1') $redirect .= '&p[0]=1';
        $this->begin($redirect);
        $obj_regions_op = vmc::service('ectools_regions_apps', array('content_path' => 'ectools_regions_operation'));
        $region_data = $_POST['region'];
        $obj_regions_op->type = $region_data['type'];
        if (!empty($region_data['p_region'])) {
            list($package, $region_name_path, $region_id) = explode(':', $region_data['p_region']);
            $region_data['p_region_id'] = $region_id;
        } else {
            unset($region_data['p_region_id']);
        }
        unset($region_data['p_region']);
        if (isset($region_data['region_id'])) {
            if (!$obj_regions_op->updateDlArea($region_data, $msg)) {
                $this->end(false, '保存失败，'.$msg);
            }
        } else {
            if (!$obj_regions_op->insertDlArea($region_data, $msg)) {
                $this->end(false, '添加失败，'.$msg);
            }
        }
        $this->end(true, '保存成功，地区名称：'.$region_data['local_name']);
    }

    /**
     * 编辑显示页面.
     *
     * @params string 地区的regions id
     */
    public function edit($region_id, $p_region_id, $type = 0)
    {
        $mdl_regions = $this->app->model('regions');
        $this->pagedata['area'] = $mdl_regions->getDlAreaById($region_id);
        $p_region = $mdl_regions->dump($p_region_id);
        if ($p_region) {
            $path_name = array();
            $p_region_rel = $mdl_regions->getList('local_name', array('package' => $p_region['package'], 'region_id' => explode(',',
                $p_region['region_path']), 'type' => $type));
            foreach ($p_region_rel as $i) {
                $path_name[] = $i['local_name'];
            }
            $p_region = implode(':', array(
                $p_region['package'],
                implode('/', $path_name),
                $p_region['region_id'],
            ));
        }
        $this->pagedata['type'] = $type;
        $this->pagedata['p_region'] = $p_region;
        $this->display('regions/area_edit.html');
    }

    /**
     * 删除对应regions id 的地区.
     *
     * @params string region id
     */
    public function toRemoveArea($regionId)
    {
        $this->begin();
        $obj_regions_op = vmc::service('ectools_regions_apps', array('content_path' => 'ectools_regions_operation'));
        if ($obj_regions_op->toRemoveArea($regionId)) {
            $this->end(true, '删除地区成功！');
        } else {
            $this->end(false, '删除地区失败！');
        }
    }

    /**
     * 更新地区排序数据.
     *
     * @params null
     */
    public function updateOrderNum()
    {
        $this->begin('index.php?app=ectools&ctl=regions&act=index');

        $is_update = true;
        $dArea = $this->app->model('regions');
        $arrPOdr = $_POST['p_order'];

        $arrRegions = array();
        if ($arrPOdr) {
            foreach ($arrPOdr as $key => $strPOdr) {
                $arrdArea = $dArea->dump($key, 'region_id,ordernum');
                $arrdArea['ordernum'] = $strPOdr;
                $arrRegions[] = $arrdArea;
            }
        }

        if ($arrRegions) {
            foreach ($arrRegions as $arrRegionsinfo) {
                $is_update = $dArea->save($arrRegionsinfo);
            }
        }

        if ($is_update) {
            $is_update = vmc::singleton('ectools_regions_operation')->updateRegionData();
        }

        $this->end($is_update, app::get('ectools')->_($is_update ? '排序成功！' : '失败'));
    }
}
