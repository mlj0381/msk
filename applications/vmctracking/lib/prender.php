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


class vmctracking_prender
{
    public function pre_display(&$content)
    {
            $tracking_js=<<<SCRIPT
            <script>
                var _hmt = _hmt || [];
                (function() {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?54161c6a77230b2f5577190a1270b0c7";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
                })();
            </script>

SCRIPT;
            $content = preg_replace("/(<\/body>)/",$tracking_js."$1",$content);
    }//End Function


}
