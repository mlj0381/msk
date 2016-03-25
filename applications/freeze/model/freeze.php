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


class freeze_mdl_freeze extends dbeav_model
{

    public function save(&$data, $mustUpdate = null, $mustInsert = false)
    {
        parent::save($data, $mustUpdate = null, $mustInsert = false);

        //调用接口推送全部最新信息
        $api_data = $this->getRow('*',array('freeze_id',$data['freeze_id']));

        return true;
    }




}
