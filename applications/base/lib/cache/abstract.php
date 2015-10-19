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



abstract class base_cache_abstract
{

    /*
     * 取得数据
     * @var string $type
     * @var string $key
     * @access public
     * @return mixed
     */
    public function get_modified($type, $key)
    {
        base_kvstore::instance('cache/expires/'.strtolower($type))->fetch(strtolower($key), $time);
        return $time;
    }//End Function

    /*
     * 设置数据
     * @var string $type
     * @var string $key
     * @var int $time
     * @access public
     * @return boolean
     */
    public function set_modified($type, $key, $time=0)
    {
        $now = ($time>0) ? $time : time();
        if(is_array($key)){
            foreach($key as $k){
                base_kvstore::instance('cache/expires/'.strtolower($type))->store(strtolower($k), $now);
            }
        }else{
            base_kvstore::instance('cache/expires/'.strtolower($type))->store(strtolower($key), $now);
        }
        return true;
    }//End Function
}//End Class
