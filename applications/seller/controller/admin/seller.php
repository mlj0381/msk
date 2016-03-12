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

class seller_ctl_admin_seller extends desktop_controller {

    public function __construct($app)
    {
        parent::__construct($app);
        $this->passport_obj = vmc::singleton('seller_user_passport');
    }

    public function index() {
        $title = '商家管理';
        $this->finder('seller_mdl_sellers', array(
            'title' => $title ,
            'icon' => 'fa-plus',
            'href' => 'index.php?app=b2c&ctl=admin_seller&act=index',
        ));
    }

    /**
     * 获取商家详情信息
     * */
    public function detail()
    {
        $params = vmc::singleton('base_component_request')->get_get();
        $seller_id = $params['p'][0];
        $step = $params['p'][1];
        $storeType = $params['p'][2];
        $type = $params['p'][3];
        $seller_data = vmc::singleton('seller_user_object')->get_sellers_data(array('sellers' => '*', $seller_id));
        $countPage = $this->passport_obj->countPage();
        $step = $params['pageIndex'] ? $params['pageIndex'] : $step;
        $step = $type == 'up' ? $step - 1 : $step + 1;
        $step <= 1 && $step = 1;
        if($step >= $countPage['sum'])
        {
            $this->pagedata['disabled'] = 'disabled';
        }

        if ($params['typeId']) $storeType = $params['typeId'];
        if (!$storeType && $seller_data['sellers']['ident'] & 1) $storeType = 1;
        if (!$storeType && $seller_data['sellers']['ident'] & 2) $storeType = 2;
        if (!$storeType && $seller_data['sellers']['ident'] & 4) $storeType = 4;

        if (!$licence_type) {
            $licence_type = $this->passport_obj->new_or_old($seller_id);
        }

        $columns = $this->passport_obj->page_setting($step, $licence_type, $storeType);
        $index = $step;
        $this->passport_obj->_entry($step, $storeType, $index);
        $this->pagedata['info'] = $this->passport_obj->edit_info($columns, $seller_id, $storeType);
        $this->pagedata['info']['company_extra']['page_setting'] = $this->passport_obj->columns();
        $this->pagedata['info']['company_extra']['pageIndex'] = $step;
        $this->pagedata['checked'] = 'checked';
        $this->pagedata['storeType'] = $storeType;
        $this->pagedata['pageSet'] = $columns;
        $this->pagedata['pageIndex'] = $step;
        $this->pagedata['seller_id'] = $seller_id;
        $this->page('admin/seller/detail.html');
    }

    public function checkin()
    {
        $this->begin('index.php?app=seller&ctl=admin_seller&act=index&p[0]=checkin');
        if(!$_POST) $this->end(false, '非法请求');
        $user_passport = vmc::singleton('seller_user_passport');
        if(!$user_passport->update_selelr($_POST['seller'])){
           $this->end(false, '审核失败');
       }
        $this->end(true, '审核成功');
    }
    public function assign_goods($store_id, $type = 'Y'){
        $goods = app::get('b2c')->model('goods')->getList('*', array('assign' => $type));
        $mdl_cat = app::get('b2c')->model('goods_cat');
        foreach ($goods as $key => $value) {
            $cat_name = $mdl_cat->getRow('cat_name', array('cat_id' => $value['cat_id']));
            $goods[$key]['cat_id'] = $cat_name['cat_name'];
        }
        $this->pagedata['store_id'] = $store_id;
        $this->pagedata['goods'] = $goods;
        $this->page('admin/seller/assign_goods.html');
    }


    public function assign_post(){
        $this->begin('index.php?app=seller&ctl=admin_seller&act=index');
        if(!$_POST) $this->end(false, '非法请求');
        $mdl_goods = app::get('b2c')->model('goods');
        $update_value = array('store_id' => $_POST['store_id'], 'assign' => $_POST['assign']);
        if(!$mdl_goods->update($update_value, array('goods_id|in' => $_POST['goods_id']))){
            $this->end(false, '分配失败');
        }else{
            $this->end(ture, '分配成功');
        }
    }


    function create() {
        $this->page('admin/seller/index.html');
    }
    function save() {
        $this->begin('index.php?app=seller&ctl=admin_seller&act=index');
        $objBrand = $this->app->model('seller');
        $brandname = $objBrand->dump(array(
            'brand_name' => $_POST['brand_name'],
            'brand_id'
        ));
        if (empty($_POST['brand_id']) && is_array($brandname)) {
            $this->end(false, ('品牌名重复'));
        }
        $_POST['ordernum'] = intval($_POST['ordernum']);
        $data = $this->_preparegtype($_POST);
        #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录管理员操作日志@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        if ($obj_operatorlogs = vmc::service('operatorlog.goods')) {
            $olddata = app::get('seller')->model('brand')->dump($_POST['brand_id']);
        }
        #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录管理员操作日志@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        if ($objBrand->save($data)) {
            #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录管理员操作日志@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
            if ($obj_operatorlogs = vmc::service('operatorlog.goods')) {
                if (method_exists($obj_operatorlogs, 'brand_log')) {
                    $obj_operatorlogs->brand_log($_POST, $olddata);
                }
            }
            #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录管理员操作日志@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
            $this->end(true, ('品牌保存成功'));
        } else {
            $this->end(false, ('品牌保存失败'));
        }
    }
    function edit($brand_id) {
        $this->path[] = array(
            'text' => ('商品品牌编辑')
        );
        $objBrand = $this->app->model('brand');
        $this->pagedata['brandInfo'] = $objBrand->dump($brand_id);
        $this->page('admin/goods/brand/detail.html');
    }
    function _preparegtype($data) {
        $data['seo_info']['seo_title'] = $data['seo_title'];
        $data['seo_info']['seo_keywords'] = $data['seo_keywords'];
        $data['seo_info']['seo_description'] = $data['seo_description'];
        $data['seo_info'] = serialize($data['seo_info']);
        unset($data['seo_title']);
        unset($data['seo_keywords']);
        unset($data['seo_description']);
        return $data;
    }

}
