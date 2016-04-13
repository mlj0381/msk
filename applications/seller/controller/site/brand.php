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
// | 商家品牌申请、授权
//

class seller_ctl_site_brand extends seller_frontpage
{

    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
        $this->mBrand = $this->app->model('brand');
        $this->mB2cbrand = app::get('b2c')->model('brand');
    }

    public function index()
    {
        /**
         * 润和接口 品牌列表
         * ISL231149 查询企业产品品牌
         * ISL231153 查询卖家产品品牌
         */
        $this->title = '商品品牌';
        //查询店铺详细信息
        $this->pagedata['brands'] = $this->mB2cbrand->getList('*', array('seller_id' => $this->seller['seller_id'],'brand_class'=> 2));
        $this->output();
    }

    //添加品牌
    public function add($brand_id)
    {
        /**
         * 润和接口 品牌列表
         * ISL231146 增加企业产品品牌
         * ISL231150 增加卖家产品品牌
         */
        if ($_POST) {
            $params = utils::_filter_input($_POST);
            unset($_POST);
            $this->_post($params);
        }
        $this->pagedata['company'] = app::get('base')->model('company_seller')->getList('company_id, company_name',
            array('uid' => $this->seller['seller_id'], 'from' => 1));
        $this->pagedata['brands'] = $this->mB2cbrand->getList('*',array('seller_id' => $this->seller['seller_id']));
        if (is_numeric($brand_id)) {
            $this->pagedata['brand'] = app::get('b2c')->model('brand')->getRow('*',
                array('brand_id' => $brand_id, 'seller_id' => $this->seller['seller_id']));
            //查询商家所有的公司
        }
        $this->output();
    }

    //品牌添加
    public function brand_add()
    {
        if ($_POST) {
            $params = utils::_filter_input($_POST);
            unset($_POST);
            $this->_post($params);
        }
        //查询商家所有的公司
        $this->pagedata['company'] = app::get('base')->model('company_seller')->getList('company_id, company_name',
            array('uid' => $this->seller['seller_id'], 'from' => 1));
        $this->display('ui/brand_add_modal.html');
    }

    private function _post($post)
    {
        $redirect = array('app' => 'seller', 'ctl' => 'site_brand', 'act' => 'index');
        $redirect = $this->gen_url($redirect);
        $store_brand = app::get('b2c')->model('brand')->getRow('*',array('brand_id' => $post['brand']['brand_id']));
        $post['brand']['seller_id'] = $this->seller['seller_id'];
        $post['brand']['brand_name'] = $store_brand['brand_name'];
        $post['brand']['api_brand_id'] = $store_brand['api_brand_id'];
        unset($post['brand']['brand_id']);
        if (!$this->mB2cbrand->save($post['brand'])) {
            $this->splash('error', $redirect, '操作失败');
        } else {
            $brand_data = app::get('b2c')->model('brand')->getRow('*',array('brand_id' => $post['brand']['brand_id']));
            $data = array(
                'slCode' => app::get('seller')->model('sellers')->getRow('sl_code',array('seller_id' => $brand_data['seller_id']))['sl_code'],
                'brandEpId' => app::get('base')->model('company')->getRow('ep_id',array('company_id' => $brand_data['company_id']))['ep_id'],
                'brandId' => (int)$brand_data['api_brand_id'],
                'brandName' => $brand_data['brand_name'],
                'brandType' => $brand_data['type'] == 2 ? $brand_data['type'] : 1,
                'brandClass' => 0,
                'contractNo' => $brand_data['agent_code'],
                'termBegin' => $brand_data['agent_start'],
                'termEnd' => $brand_data['agent_end'],
            );
//            vmc::dump($data);die;
            if(!$this->app->rpc('add_seller_brand')->request($data)['status']){
                $this->splash('error', $redirect, '数据同步失败');
            }
        }

        $this->splash('success', $redirect, '添加成功');
    }


    //修改店铺品牌
    public function store_brand_add()
    {
        if ($_POST) {
            $params = utils::_filter_input($_POST);
            unset($_POST);
            $this->_post($params);
        }
        $this->pagedata['brands'] = $this->mB2cbrand->getList('*', array('seller_id' => $this->seller['seller_id'],'brand_class'=> 1));
        $this->pagedata['company'] = app::get('base')->model('company_seller')->getList('company_id, company_name',
            array('uid' => $this->seller['seller_id'], 'from' => 1));
        $this->output();
    }

    //删除
    public function remove($brand_id)
    {
        $brand_id = $_POST['brand_id'] ?: $brand_id;
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_brand', 'act' => 'index'));
        if (!is_numeric($brand_id)) {
            $this->splash('error', $redirect, '非法操作');
        }
        $filter = app::get('store')->model('store')->getList('store_id',
            array('seller_id' => $this->seller['seller_id']));
        $mdl_b2c_goods = app::get('b2c')->model('goods');
        foreach ($filter as $value) {
            $value['brand_id'] = $brand_id;
            if ($mdl_b2c_goods->count($value)) {
                $this->splash('error', $redirect, '该品牌下还有商品，不允许删除');
            }
        }
        $db = vmc::database();
        $db->beginTransaction();
        $result = $this->mBrand->delete(array('brand_id' => $brand_id, 'seller_id' => $this->seller['seller_id']));
        if (!$result) {
            $db->rollback();
            $this->splash('error', $redirect, '删除失败');
        }
        $result = app::get('b2c')->model('brand')->delete(array(
            'brand_id' => $brand_id,
            'seller_id' => $this->seller['seller_id'],
        ));
        if (!$result) {
            $db->rollback();
            $this->splash('error', $redirect, '删除失败');
        }
        $db->commit();
        $this->splash('success', $redirect, '删除成功');
    }

    //判断品牌重名
    public function check_brand_name()
    {
        $mdl_brand = app::get('b2c')->model('brand');
        $post = $_POST;
        if ($mdl_brand->getRow('brand_name', array('brand_name' => $post['brand_name']))) {
            $this->splash('error', '', '重名');
        }
        $this->splash('success', '', '可用');
    }

    //取得品牌首字母拼音
    public function brand_initial()
    {
        $initials = new base_py('utf-8');
        $py = $initials->getInitials($_POST['brand_name']);
        preg_match('/^[A-Za-z]/', $py, $result);
        $inital = current($result);
        if ($inital) {
            $this->splash('success', '', $inital);
        }
        $this->splash('error', '', '~');
    }

}
