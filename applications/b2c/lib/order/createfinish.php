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




class b2c_order_createfinish
{

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 订单创建完成时
     * @params array - 订单完整数据，含ITEMS
     * @return boolean - 执行成功与否
     */
    public function exec($sdf,&$msg='')
    {
        logger::debug($sdf['order_id'].'createfinish exec');


        if($sdf['is_cod'] == 'Y'){
            $freeze_data = array();
            foreach ($sdf['items'] as $key => $item) {

                //购买数量计数
                vmc::singleton('b2c_openapi_goods',false)->counter(array(
                    'goods_id'=>$item['goods_id'],
                    'buy_count'=>$item['nums'],
                    'buy_count_sign'=>md5($item['goods_id'].'buy_count'.($item['nums'] * 1024))//计数签名
                ));
                //组织库存冻结数据
                $freeze_data[] = array(
                    'sku'=>$item['bn'],
                    'quantity'=>$item['nums']
                );
            }

            //库存冻结
            if(!vmc::singleton('b2c_goods_stock')->freeze($freeze_data,$msg)){
                logger::error('库存冻结异常!ORDER_ID:'.$sdf['order_id'].','.$msg);
            }
        }

        /* 订单金额为0 **/
        $order_sdf = $sdf;
        if ($order_sdf['order_total'] == '0') {
            // 生成支付账单
            $obj_bill = vmc::singleton('ectools_bill');
            $bill_sdf = array(
                'bill_type' => 'payment',
                'pay_object' => 'order',
                'pay_mode' => (in_array($order_sdf['pay_app'], array(
                    '-1',
                    'cod',
                    'offline',
                )) ? 'offline' : 'online') ,
                'order_id' => $order_sdf['order_id'],
                'pay_app_id' => $order_sdf['pay_app'],
                'pay_fee' => $order_sdf['cost_payment'],
                'member_id' => $order_sdf['member_id'],
                'status' => 'succ',
                'money' => $order_sdf['order_total'],
                'memo' => '订单0元时自动生成',
            );
            if (!$obj_bill->generate($bill_sdf, $msg)) {
                //TODO 自动支付失败,
                logger::error('订单0元时自动支付失败!'.$msg);

                return;
            }
        }

        return true;
    }


}
