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
class site_mdl_map extends dbeav_model{
    
    public function get_list($columns = '*', $filter = '') {
        $map_list = parent::getList($columns, $filter);
        return $this->son($map_list);
    }
    
    private function son($tmp){
        $map_list = array();
        foreach($tmp as $value){
            $map_list[$value['id']] = $value;
        }
        $map = array();
        foreach($map_list as $value){
            if(isset($map_list[$value['pid']])){
                $map_list[$value['pid']]['son'][] = &$map_list[$value['id']];
            } else {
                $map[] = &$map_list[$value['id']];
            }
        }
        return $map;
    }
}
