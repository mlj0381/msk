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
        return utils::son($map_list, 'id', 'pid');
    }
    
   
}
