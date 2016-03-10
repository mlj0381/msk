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


class b2c_view_input
{
    public function input_category($params)
    {

        $mdl_goods_cat = app::get('b2c')->model('goods_cat');
        $render = new base_render(app::get('b2c'));
        $params['cat_openapi'] = vmc::openapi_url('openapi.goods', 'catalog');
        $params['cat_path_openapi'] = vmc::openapi_url('openapi.goods', 'catalog_path');
        $params['domid'] = substr(md5(uniqid()), 0, 6);
        $render->pagedata['tree_data_root'] = $mdl_goods_cat->get_tree();
        if ($params['value'] && $params['value'] > 0) {
            $cat = $mdl_goods_cat->getRow('cat_path,cat_id', array('cat_id' => $params['value']));
            if ($cat) {
                $cat_path = $cat['cat_path'];
                $cat_path_arr = explode(',', $cat_path);
                $cat_path_length = count($cat_path_arr);
                $render->pagedata['root'] = $cat_path_arr[0];
                $render->pagedata['cat_path_length'] = $cat_path_length;
                foreach ($cat_path_arr as $k=>$cat_id) {
                    $clist = $mdl_goods_cat->get_tree($cat_id);
                    if($clist){
                        $tree_data[$cat_id] = $clist;
                        if($tree_data[$cat_id][$cat_path_arr[$k+1]]){
                            $tree_data[$cat_id][$cat_path_arr[$k+1]]['selected'] = true;
                        }
                    }
                }
                $render->pagedata['tree_data'] = $tree_data;
            }
        }
        $render->pagedata['params'] = $params;
        return $render->fetch('common/category.html');
    }


}
