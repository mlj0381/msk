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


class b2c_messenger_iBase64{

    private function pattern(){
        return array(
        '+'=>'_1_',
        '/'=>'_2_',
        '='=>'_3_',
        );
    }
    public function encode($str){
        $str = base64_encode($str);
        return strtr($str, $this->pattern());
    }

    public function decode($str){
        $str = strtr($str, array_flip($this->pattern()));
        return base64_decode($str);
    }
}