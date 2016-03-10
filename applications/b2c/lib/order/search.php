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
// | Description 商家订单
// +----------------------------------------------------------------------

class b2c_order_search
{
    public function search($filter){
        if(empty($filter)) return null;
        if(is_numeric($filter['search'])){
            $where['order_id|has'] = $filter['search'];
            $where['sql'] = " AND `order_id`  LIKE '%{$filter['search']}%'  ";
        }else{
            $goodsName = trim($filter['search']);
            //得到货品id
            $product = app::get('b2c')->model('products')->getList('product_id', array('name|has' => $goodsName));
            //得到订单id
            $product_id = array();
            foreach($product as $key => $value){
                $product_id['product_id'][$key] = $value['product_id'];
            }
            unset($product);
            $order = app::get('b2c')->model('order_items')->getList('order_id', array('product_id|in' => $product_id['product_id']));
            $order_id = array();
            foreach($order as $key => $value){
                $order_id['order_id'][$key] = $value['order_id'];
            }
            unset($order);
            $where['sql'] = "  AND  `order_id` in(" . join(',', $order_id['order_id']) . ")";
            $where['order_id|in'] = $order_id['order_id'];
        }
        return $where;
    }
}
