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
    public $column_check = '审核';
    public $column_goods = '商品数';
    public $column_order = '订单数';
    public $column_contact = '联系人';
    public $column_contact_tel = '电话';
    public $column_company_name = '公司名称';
    public $detail_basic = '编辑';
    public function __construct($app){
        $this->app = $app;
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
        if($store['status'] == 0){
            $return = '审核中';
        }else if($store['status'] == 1){
            $return = "<a class='btn btn-default btn-xs'$row href='index.php?app=seller&ctl=admin_seller&act=assign_goods&p[0]={$store['store_id']}'>分配商品</a>";
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
    public function column_check($row){

         $seller = app::get('seller')->model('sellers')->dump($row['seller_id'], '*', 'checkin');
         $suatus[] = array_shift($seller['company']);
         array_unshift($suatus, array_shift($seller['aptitudes']));
         array_unshift($suatus, array_shift($seller['store']));
         array_unshift($suatus, array_shift($seller['brand']));
         foreach ($suatus as $key => $value) {
             switch ($value['status']) {
                 case '1':
                     $style[$key] = 'background-color:#008000';
                     break;
                 case '-1':
                     $style[$key] = 'background-color:#ff0000';
                     break;
                 case '0':
                     $style[$key] = '';
                     break;
             }
         }
         $html = <<<HTML
                <a style="{$style[3]}" href="index.php?app=seller&ctl=admin_seller&act=checked&p[0]={$row['seller_id']}&p[1]=company" class="btn btn-default btn-xs" data-toggle="modal" data-target="#check_company"><i class="fa fa-edit"></i>公司</a>
                <a style="{$style[2]}" href="index.php?app=seller&ctl=admin_seller&act=checked&p[0]={$row['seller_id']}&p[1]=aptitudes" class="btn btn-default btn-xs" data-toggle="modal" data-target="#check_aptitudes"><i class="fa fa-edit"></i>资质</a>
                <a style="{$style[1]}" href="index.php?app=seller&ctl=admin_seller&act=checked&p[0]={$row['seller_id']}&p[1]=store" class="btn btn-default btn-xs" data-toggle="modal" data-target="#check_store"><i class="fa fa-edit"></i>店铺</a>
                <a style="{$style[0]}" href="index.php?app=seller&ctl=admin_seller&act=checked&p[0]={$row['seller_id']}&p[1]=brand" class="btn btn-default btn-xs" data-toggle="modal" data-target="#check_brand"><i class="fa fa-edit"></i>品牌</a>
                <div class="modal fade" id="check_company" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                          <div class="modal-content">

                          </div>
                    </div>
                </div>
                <div class="modal fade" id="check_aptitudes" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                          <div class="modal-content">

                          </div>
                    </div>
                </div>

                <div class="modal fade" id="check_store" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                          <div class="modal-content">

                          </div>
                    </div>
                </div>

                <div class="modal fade" id="check_brand" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                          <div class="modal-content">

                          </div>
                    </div>
                </div>


HTML;
        return $html;
    }

}
