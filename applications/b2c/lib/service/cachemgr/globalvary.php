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


/**
 * 缓存数据键值.
 */
class b2c_service_cachemgr_globalvary
{
    public function get_varys()
    {
        return array(
                        'MEMBER_LEVEL_ID' => $_COOKIE['MEMBER_LEVEL_ID'],
                    );
    }
}
