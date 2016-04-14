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
// | 商家分类
// +----------------------------------------------------------------------
class seller_ctl_site_cat extends seller_frontpage
{
    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->mCat = app::get('store')->model('goods_cat');
        $this->verify();
    }

    public function index()
    {
        $this->pagedata['tree'] = $this->mCat->getList('*', array('store_id' => $this->store['store_id']));
        $this->output();
    }

    //增加
    public function add()
    {
        $this->pagedata['parents'] = $this->mCat->getList('cat_name, cat_id, p_order, parent_id', array('parent_id|in' => array(0, 1), 'store_id' => $this->store['store_id']));
        array_unshift($this->pagedata['parents'], array(
            'cat_name' => '--无--',
            'cat_id' => '',
            'p_order' => '',
            'parent_id' => ''
        ));
        $this->display('site/cat/form.html');
    }

    //删除
    public function del()
    {

    }

    //编辑
    public function edit()
    {

    }

    //保存
    public function save()
    {
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_cat', 'act' => 'index'));
        if (!$_POST) $this->splash('error', $redirect, '非法请求');
        extract($_POST);
        $cat['store_id'] = $this->store['store_id'];
        if (!$this->mCat->save($cat)) {
            $this->splash('error', $redirect, '添加失败');
        }
        $this->splash('success', $redirect, '添加成功');
    }

    //更新排序
    public function update()
    {

    }

    /*
     * 商家入驻添加经营类别
     * */
    public function add_cat()
    {
        //获取分类
        $this->display('ui/add-cat.html');
    }

    //选择商品类目填写相关资质
    public function write_aptitude($cat_id = 0)
    {
        if (!is_numeric($cat_id)) $cat_id = 0;
        $this->pagedata['aptitude'] = app::get('b2c')->model('cat_aptitudes')->getRow('*', array('cat_id' => $cat_id));
        $this->pagedata['cat'] = app::get('store')->model('goods_cat')->getRow('*', array('cat_id' => $cat_id, 'seller_id' => $this->seller['seller_id']));
        $this->pagedata['cat_id'] = $cat_id;
        $this->pagedata['type'] = 'center';
        $this->display('site/goods/write_aptitude.html');
    }

//    /**
//     * 保存分类所需资质
//     */
//    public function saveAptitude()
//    {
//
//        if (!$_POST) {
//            $this->splash('error', '', '非法请求');
//        }
//        print_r($_POST);die;
//        $updateValue = array('extra' => $_POST['cat']);
//        $filter = array('id' => $_POST['id']);
//        if (!app::get('store')->model('goods_cat')->save($updateValue, $filter)) {
//            $this->splash('error', '', '添加失败');
//        }
//        $this->splash('success', '', '添加成功');
//    }
}
