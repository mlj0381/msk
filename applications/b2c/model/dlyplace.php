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


class b2c_mdl_dlyplace extends dbeav_model
{
    /**
     * 获取所有的仓库及覆盖地区列表
     */
    public function &getDlyplaceAll()
    {
        $dlyplace = $this->getList('*', array('dp_type' => 'warehouse'));
        $mdl_warehouse = $this->app->model('warehouse');
        foreach($dlyplace as $key => &$value)
        {
            $value['warehouse'] = $mdl_warehouse->getList('*', array('dlyplace_id' => $value['dp_id']));
        }
        return $dlyplace;
    }

    /**
     * 润和接口 物流区
     * IPD141114 2 物流区
     */
    public function get_api_area()
    {
        $rpc_area = app::get('b2c')->rpc('select_area');
        $area = $rpc_area->request(array(1),2592000); //缓存时间一个月
        if($area['status'])
        {
            //183.37.209.57 深圳IP
            $current_area = $this->getIPLoc_sina('',array('city'));
            //用户有选择过所在城市，就显示他的选择，，没有就通过ip地址去获取
            if($_SESSION['account']['addr'])
            {
                foreach($area['result']['logiAreaList'] as $v){
                    if($v['logiAreaCode'] == $_SESSION['account']['addr'])
                    {
                        $area['result']['default']['logiAreaCode'] =  $v['logiAreaCode'];
                        $area['result']['default']['logiAreaName'] =  $v['logiAreaName'];
                        break;
                    }
                }
            }else{
                foreach($area['result']['logiAreaList'] as $v){
                    if($v['logiAreaName'] == $current_area)
                    {
                        $area['result']['default']['logiAreaCode'] =  $v['logiAreaCode'];
                        $area['result']['default']['logiAreaName'] =  $v['logiAreaName'];
                        $_SESSION['account']['addr'] = $v['logiAreaCode'];
                        break;
                    }
                }
            }

            return $area['result'];
        }else{
            return array();
        }
    }

    //获取ip地址
    private function getIPaddress()
    {
        $IPaddress='';
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $IPaddress = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $IPaddress = $_SERVER["REMOTE_ADDR"];

        }
        return $IPaddress;
    }

    /*
     *根据新浪IP查询接口获取IP所在地
     */
    private function getIPLoc_sina($queryIP = '',$area = array('province','city')){
        /*
         * $area 参数
         * country   国家
         * province  省
         * city      市
         * district  县
         * */
        if(!$queryIP)
        {
            $queryIP = $this->getIPaddress();
        }
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP;
        $ch = curl_init($url);
        //curl_setopt($ch,CURLOPT_ENCODING ,'utf8');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
        $location = curl_exec($ch);
        $location = json_decode($location);
        curl_close($ch);

        if($location===FALSE) return "";
        $loc = '';
        if (empty($location->desc)) {
            if(is_array($area))
            {
                foreach($area as $v)
                {
                    $loc .= $location->$v;
                }
            }
        }else{
            $loc = $location->desc;
        }
        return $loc;
    }

}
