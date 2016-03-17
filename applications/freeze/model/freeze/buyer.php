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


class freeze_mdl_freeze_buyer extends dbeav_model {


    public function get_account($data)
    {
        $buyer_id = $data['seller_id'];
        $count = $this->count(array('buyer_id' => $buyer_id));
        $account_name =  $data['login_account'];
        if($count < 10)
        {
            $account_name .= '0'.($count+1);
        }else{
            $account_name .= ($count+1);
        }

        return $account_name;
    }



}
