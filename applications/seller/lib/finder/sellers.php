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
class seller_finder_sellers{

    public $column_control = '操作';
    public $column_store = '店铺';
    public $column_goods = '商品数';
    public $column_order = '订单数';
    public $column_contact = '联系人';
    public $column_contact_tel = '电话';
    public $column_company_name = '公司名称';
    public $detail_basic = '编辑';
    public function __construct($app){
        $this->app = $app;
    }
    public function detail_basic($seller_id){
        $render = $this->app->render();
        $user_passport = vmc::singleton('seller_user_passport');
        $render->pagedata['company'] = $user_passport->get_company($seller_id);
        $render->pagedata['contact'] = $user_passport->get_contact($seller_id);
        return $render->fetch('admin/seller/finder/baics.html');
    }

    public function column_contact($seller_id){
        $this->contact = app::get('seller')->model('contact')->getRow('name, tel', array('seller_id' => $seller_id));
        return $this->contact['name'];
    }
    public function column_contact_tel($seller_id){
        return $this->contact['tel'];
    }
    public function column_company_name($seller_id){
        $company_name = app::get('seller')->model('company')->getRow('company_name, company_prototype, company_product', array('seller_id' => $seller_id));
        return $company_name['company_name'];
    }
    public function column_store($row){
        $store = app::get('store')->model('store')->getRow('store_id, status', array('seller_id' => $row['seller_id']));
        if($store){
            if($store['status'] == 0){
                $return = '审核中';
            }else if($store['status'] == 1){
                $return = "<a class='btn btn-default btn-xs'$row href='index.php?app=seller&ctl=admin_seller&act=assign_goods&p[0]={$store['store_id']}'>分配商品</a>";
            }else {
                $return = '未通过';
            }
        }else{
            $return = '未申请';
        }
        return $return;
    }
    public function column_control($row){
        return '<a class="btn btn-default btn-xs"><i class="fa fa-edit"></i>冻结</a>
                <a class="btn btn-default btn-xs"><i class="fa fa-edit"></i>惩罚</a>';
    }
    public function column_goods($row){
        return '商品数';
    }
    public function column_order($row){
        return '订单数';
    }


}
