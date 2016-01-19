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


 
class base_mdl_company_extra extends base_db_model{
    public function extra_save($key, $data) {
        if (isset($data[$key]) && !empty($data[$key]) && $result = $data[$key]) {
            return $this->save(array_merge($result, array(
                        'key' => $key,
            )));
        }
        return true;
    }
    
    public function get_info(){
        
    }

    public function getList($cols = '*', $filter = array(), $offset = 0, $limit = -1, $orderby = null){
        $rows = parent::getList($cols = '*', $filter = array(), $offset = 0, $limit = -1, $orderby = null);
        $result = array();
        foreach($rows as $row){
            $result[$row['key']] = $row;
        }
        unset($rows);
        return $result;
    }
}

