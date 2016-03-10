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




class b2c_mdl_reship extends dbeav_model{
    var $has_many = array(
        'reship_items'=>'reship_items',
        'orders'=>'order_delivery:contrast:reship_id^dly_id',
    );

    var $defaultOrder = array('t_begin','DESC');


	public function insert(&$data)
	{
		$info_object = vmc::service('sensitive_information');
		if(is_object($info_object)) $info_object->opinfo($data,'b2c_mdl_reship',__FUNCTION__);
		return parent::insert($data);
    }

    function save(&$sdf,$mustUpdate = null, $mustInsert=false){
        if(!isset($sdf['orders'])){
            $sdf['orders'] = array(
                                array(
                                    'order_id' => $sdf['order_id'],
                                    'items' => $sdf['items'],
                                )
                            );
        }
        $tmpvar = $sdf['orders'];
        foreach($tmpvar as $k => $row){
            $sdf['orders'][$k]['dlytype'] = 'reship';
            $sdf['orders'][$k]['dly_id'] = $sdf['reship_id'];
        }
        unset($tmpvar);

        if(parent::save($sdf)){
            //一张发货单多个订单
            $oOrder = $this->app->model('orders');
            foreach($sdf['orders'] as $order){
                if($sdf['order_id']){
                    $sdf_order = $oOrder->dump($order['order_id']);
                    if($sdf_order['ship_status'] == 5){
                        continue;
                    }

                    //todo 订单是否完全发货
                    $data['ship_status'] = 4;

                    $data['order_id'] = $sdf['order_id'];
                    $filter['order_id'] = $sdf['order_id'];
                    $orders = $this->app->model('orders');
                    $orders->update($data, $filter);
                }
            }
        }
        return true;
    }

    function gen_id(){
        $sign = '9'.date("Ymd");

        while(true)
        {
            $randval = substr(mt_rand(), 0, -3) . rand(100, 999);

            $aRet = $this->db->selectrow( "SELECT COUNT(*) as c FROM vmc_b2c_reship WHERE reship_id='" . ($sign.$randval) . "'" );
            if( !$aRet['c'] )
                break;
        }
		return $sign.$randval;
    }

    /**
     * 重写getlist方法
     */
    public function getList($cols='*',$filter=array(),$start=0,$limit=-1,$orderType=null)
    {
        $arr_reship = parent::getList($cols,$filter,$start,$limit,$orderType);
        $obj_extends_service = vmc::servicelist('b2c.api_reship_extends_actions');
        if ($obj_extends_service)
        {
            foreach ($obj_extends_service as $obj)
            {
                $obj->extend_list($arr_reship);
            }
        }
        $info_object = vmc::service('sensitive_information');
		if(is_object($info_object)) $info_object->opinfo($arr_reship,'b2c_mdl_reship',__FUNCTION__);
        return $arr_reship;
    }

    public function modifier_money($row)
    {
        $app_ectools = app::get('ectools');
        $row = $app_ectools->model('currency')->changer_odr($row,null,false,false,$this->app->getConf('system.money.decimals'),$this->app->getConf('system.money.operation.carryset'));

        return $row;
    }

	public function modifier_delivery($row)
    {
        $obj_dlytype = $this->app->model('dlytype');
		$arr_dlytype = $obj_dlytype->dump($row, 'dt_name');

        return $arr_dlytype['dt_name'] ? $arr_dlytype['dt_name'] : '-';
    }

	public function modifier_member_id($row){
      if ($row === 0 || $row == '0'){
            return ('非会员顾客');
        }
        else{
            return vmc::singleton('b2c_user_object')->get_member_name(null,$row);
        }
  }
}
