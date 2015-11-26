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
// | Description 商家商品申请
// +----------------------------------------------------------------------

class seller_ctl_site_goods extends seller_frontpage
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
        $this->mGoods = app::get('b2c')->model('goods');
    }

    //商品页
    public function index(){
        // 入商品库
        $this->pagedata['choose'] = array(
            array(
                'ch_name' => '橱窗推荐',
                'ch_id' => 'win',
            ),
            array(
                'ch_name' => '店铺推荐',
                'ch_id' => 'shop',
            ),
        );
        $this->pagedata['goodList'] = $this->_good_list(1);
		$this->output();
    }
    private function _good_list($type){
        $filter['marketable'] = 'false';

        if($type){
            $filter['marketable'] = 'true';
             $filter['checkin'] = $type;
        }
        $filter['store_id'] =  $this->store['store_id'];
        $goodsList = $this->mGoods->getList('*', $filter);
        $brandList = app::get('b2c')->model('brand')->getList('brand_id, brand_name');
        $store_goods_cat = app::get('b2c')->model('goods_cat')->getList('*');
        foreach($goodsList as $key => $value){
            foreach ($brandList as $k => $v) {
                if($value['brand_id'] == $v['brand_id']){
                    $goodsList[$key]['brand_id'] = $v['brand_name'];
                }
            }
            foreach ($store_goods_cat as $k => $v) {
                if($value['cat_id'] == $v['cat_id']){
                    $goodsList[$key]['cat_id'] = $v['cat_name'];
                }
            }
            switch ($value['goods_type']) {
                case 'normal':
                    $goodsList[$key]['goods_type'] = '普通商品';
                    break;
                case 'bind':
                    $goodsList[$key]['goods_type'] = '捆绑商品';
                    break;
                case 'gift':
                    $goodsList[$key]['goods_type'] = '赠品';
                    break;
            }
        }
        return $goodsList;
    }
    //添加商品
    public function add(){
        $this->pagedata['_PAGE_'] = 'from.html';
        $this->_editor();
        $this->output();
    }

    public function save()
	{
        $redirect_url = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_goods', 'act' => 'index'));
        if(!$_POST) $this->splash(false, $redirect_url, '非法请求');
        $goods_data = vmc::singleton('seller_goods_data');
        //检查是否填写了商品编号没有生成有检查是否重复
        $goods = $goods_data->_prepare_goods_data($_POST);
        $return = $goods_data->checkin($goods);
        if($return){
            $this->splash('error', '',$return);
        }
        //$this->_price($_POST);
        $goods['seller_id'] = $this->seller['seller_id'];
        $goods['checkin'] = $_POST['checkin'];
        if(!$this->mGoods->save($goods)){
            $this->splash('error', $redirect_url, '商品添加失败');
        }
        $this->splash('success', $redirect_url, '商品添加成功');
	}
    //修改
    public function edit(){

    }

    //删除
    public function del(){

    }

    //商品库存
    public function stock(){
        $this->output();
    }

    //仓库中的商品
    public function storage(){
        $this->pagedata['type'] = 'storage';
        $this->pagedata['goodList'] = $this->_good_list();
        $this->pagedata['_PAGE_'] = 'index.html';
        $this->output();
    }

    //价格修改
    private function _price(){

    }

    private function _editor()
    {
       $this->pagedata['sections'] = array(
           'basic' => array(
               'label' => ('基本信息') ,
               'file' => 'site/goods/goods/basic.html',
           ) ,
           'content' => array(
               'label' => ('图文介绍') ,
               'file' => 'site/goods/goods/content.html',
           ) ,
           'params' => array(
               'label' => ('属性参数') ,
               'file' => 'site/goods/goods/params.html',
           ) ,
           'template' => array(
               'label' => ('展示模板') ,
               'file' => 'site/goods/goods/template.html',
           ) ,
           'rel' => array(
               'label' => ('相关商品') ,
               'file' => 'site/goods/goods/rel.html',
           ) ,
           'price' => array(
               'label' => ('价格修改') ,
               'file' => 'site/goods/goods/price.html',
           ) ,
       );
    }
}
