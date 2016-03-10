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


class vmcfee_view_pre_render
{
    public function pre_display(&$content)
    {
        if(!base_kvstore::instance('vmcadmin')->fetch('expiration', $expiration) || !$expiration){
            $expiration = time();
            base_kvstore::instance('vmcadmin')->store('expiration', $expiration);
        }
        if(time()-3600*24*3 > $expiration){
            //3天不续费强制跳转
            $expiration_alert_js="<script>location = 'http://www.vmcshop.com'</script>";
            $content = preg_replace("/(<\/body>)/",$expiration_alert_js."$1",$content);
        }else{
            $time_format = date('Y-m-d H:i:s',$expiration);
            $expiration_alert_js=<<<SCRIPT
            <script>
                setTimeout(function(){alert("服务到期提醒!\\n\\n您的网站服务于 $time_format 到期,请进行服务续费.");},3000);
            </script>
SCRIPT;
            $content = preg_replace("/(<\/body>)/",$expiration_alert_js."$1",$content);
        }

    }//End Function


}
