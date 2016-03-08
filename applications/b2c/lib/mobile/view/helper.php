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




class b2c_mobile_view_helper
{

    function function_SYSTEM_HEADER_M($params, &$smarty)
    {
        // 首页

        if ($smarty->app->app_id == 'mobile') return '';
        return $smarty->fetch('mobile/common/header.html', app::get('b2c')->app_id);
    }



    function function_SYSTEM_FOOTER_M($params, &$smarty)
    {


        if ($smarty->app->app_id == 'mobile') return '';
        $html= $smarty->fetch('mobile/common/footer.html',app::get('b2c')->app_id);

        return $html;
    }

}//结束
