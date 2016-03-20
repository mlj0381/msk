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


class freeze_mdl_freeze_member extends dbeav_model
{


    public function get_freeze_member($cols = '*', $filter = array(), $offset = false, $limit = false, $orderType = null)
    {
        $where = 'WHERE   1';
        foreach($filter as $k=>$v){
            $where .= ' AND fm.'.$k.' =';
            $where .= "'".$v."'" ;
        };
        $where_limit = '';
        if(is_numeric($offset))
        {
            $where_limit .= ' LIMIT '.$offset;
        }

        if(is_numeric($limit))
        {
            $where_limit .=  ','.$limit;
        }
        $sql = "SELECT $cols FROM `vmc_b2c_members` bm LEFT JOIN `vmc_freeze_freeze_member` fm ON bm.member_id = fm.member_id  $where $where_limit";
        $result = $this->db->select($sql);

        return $result;
    }

    public function count_freeze_member( $filter = array())
    {
        $where = 'WHERE   1';
        foreach($filter as $k=>$v){
            $where .= ' AND fm.'.$k.' =';
            $where .= "'".$v."'" ;
        };

        $sql = "SELECT count(1) as count FROM `vmc_b2c_members` bm LEFT JOIN `vmc_freeze_freeze_member` fm ON bm.member_id = fm.member_id  $where ";
        $result = $this->db->select($sql);

        return $result[0]['count'];
    }

}







