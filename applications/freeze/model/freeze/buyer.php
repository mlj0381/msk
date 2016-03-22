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


class freeze_mdl_freeze_buyer extends dbeav_model
{


    public function get_account($data)
    {
        $buyer_id = $data['buyer_id'];
        $count = $this->count(array('buyer_id' => $buyer_id));
        $account_name = $data['login_account'];
        if ($count < 10) {
            $account_name .= '0' . ($count + 1);
        } else {
            $account_name .= ($count + 1);
        }

        return $account_name;
    }

    public function get_freezeList($cols = '*', $filter = array(), $offset = false, $limit = false, $orderType = null)
    {
        $where = 'WHERE   1';
        foreach($filter as $k=>$v){
            $where .= ' AND fb.'.$k.' =';
            $where .= $v ;
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
        $sql = "SELECT $cols FROM vmc_freeze_freeze_buyer fb LEFT JOIN vmc_freeze_freeze f ON fb.freeze_id=f.freeze_id  $where $where_limit";
        $result = $this->db->select($sql);

        return $result;
    }

    public function get_freezeCount($filter = array())
    {
        $where = 'WHERE   1';
        foreach($filter as $k=>$v){
            $where .= ' AND fb.'.$k.' =';
            $where .= $v ;
        };

        $sql = "SELECT count(1) as count FROM vmc_freeze_freeze_buyer fb LEFT JOIN vmc_freeze_freeze f ON fb.freeze_id=f.freeze_id  $where ";
        $result = $this->db->select($sql);

        return $result[0]['count'];
    }

}
