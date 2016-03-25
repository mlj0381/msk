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
            return $area['result'];
        }else{
            return array();
        }
    }

}
