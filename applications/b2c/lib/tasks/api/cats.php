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


class b2c_tasks_api_cats extends base_task_abstract implements base_interface_task
{
    //订单创建成功时，相关处理业务
    public function exec($params = null)
    {

        ini_set('max_execution_time', '0');
        set_time_limit(0);
        $mdl_cat = app::get('b2c')->model('goods_cat');
        //查询一级分类
        $rpc_cat1 = app::get('b2c')->rpc("select_product_cat1");
        $result_cat1 = $rpc_cat1->request(array('1'));
        foreach ($result_cat1['result'] as $cat1) {

            if (!$row1 =  $mdl_cat->db->select("SELECT cat_id,cat_name,addon as classesCode FROM `vmc_b2c_goods_cat` WHERE parent_id = 0 AND cat_name = '{$cat1['classesName']}'")[0]) {
                //保存一级分类
                $row1 = array(
                    'parent_id' => 0,
                    'has_children' => 'false',
                    'cat_name' => $cat1['classesName'],
                    'addon' => $cat1['classesCode'],
                );
                $mdl_cat->save($row1);
            };
            //查询二级分类
            $result_cat2 = app::get('b2c')->rpc("select_product_cat2")->request($cat1);
            if ($result_cat2['status'] && !empty($result_cat2['result'])) {
                foreach ($result_cat2['result'] as $cat2) {
                    if (!$row2 = $mdl_cat->db->select("SELECT cat_id,cat_name,addon as machiningCode FROM `vmc_b2c_goods_cat` WHERE parent_id = {$row1['cat_id']} AND cat_name = '{$cat2['machiningName']}'")[0]) {
                        //保存二级分类
                        $row2 = array(
                            'parent_id' => $row1['cat_id'],
                            'has_children' => 'false',
                            'cat_name' => $cat2['machiningName'],
                            'addon' => $cat2['machiningCode'],
                        );
                        $mdl_cat->save($row2);
                    }
                    //查询三级分类  、产品品种
                    $cat2['classesCode'] = $cat1['classesCode'];
                    $result_cat3 = app::get('b2c')->rpc("select_product_cat3")->request($cat2);
                    if ($result_cat3['status'] && !empty($result_cat3['result'])) {
                        foreach ($result_cat3['result'] as $cat3) {
                            if (!$row3 = $mdl_cat->db->select("SELECT cat_id,cat_name,addon as breedCode FROM `vmc_b2c_goods_cat` WHERE parent_id = {$row2['cat_id']} AND cat_name = '{$cat3['breedName']}'")[0]) {
                                //保存三级级分类
                                $row3 = array(
                                    'parent_id' => $row2['cat_id'],
                                    'has_children' => 'false',
                                    'cat_name' => $cat3['breedName'],
                                    'addon' => $cat3['breedCode'],
                                );
                                $mdl_cat->save($row3);
                            }
                            //查询四级分类、产品特征
//                            $cat3['classesCode'] = $cat1['classesCode'];
//                            $cat3['machiningCode'] = $cat2['machiningCode'];
//                            $result_cat4 = app::get('b2c')->rpc("select_product_cat4")->request($cat3);
//                            if ($result_cat4['status'] && !empty($result_cat4['result'])) {
//                                foreach ($result_cat4['result'] as $cat4) {
//                                    if (!$row4 = $mdl_cat->db->select("SELECT cat_id,cat_name,addon as featureCode FROM `vmc_b2c_goods_cat` WHERE parent_id = {$row3['cat_id']} AND cat_name = '{$cat4['featureName']}'")[0]) {
//                                        //保存三级级分类
//                                        $row4 = array(
//                                            'parent_id' => $row3['cat_id'],
//                                            'has_children' => 'false',
//                                            'cat_name' => $cat4['featureName'],
//                                            'addon' => $cat4['featureCode'],
//                                        );
//                                        $mdl_cat->save($row4);
//                                    }
//                                    //查询五级分类、产品净重分类
//                                    $cat4['classesCode'] = $cat1['classesCode'];
//                                    $cat4['machiningCode'] = $cat2['machiningCode'];
//                                    $cat4['breedCode'] = $cat3['breedCode'];
//                                    $result_cat5 = app::get('b2c')->rpc("select_product_cat5")->request($cat4);
//                                    if ($result_cat5['status'] && !empty($result_cat5['result'])) {
//                                        foreach ($result_cat5['result'] as $cat5) {
//                                            if (!$row5 = $mdl_cat->db->select("SELECT cat_id,cat_name,addon as weightCode FROM `vmc_b2c_goods_cat` WHERE parent_id = {$row4['cat_id']} AND cat_name = '{$cat5['weightName']}'")[0]) {
//                                                //保存三级级分类
//                                                $row5 = array(
//                                                    'parent_id' => $row4['cat_id'],
//                                                    'has_children' => 'false',
//                                                    'cat_name' => $cat5['weightName'],
//                                                    'addon' => $cat5['weightCode'],
//                                                );
//                                                $mdl_cat->save($row5);
//                                            }
//                                        }
//                                    }
//                                }
//                            }
                        }
                    }
                }
            }
        }

        return true;
    }
}
