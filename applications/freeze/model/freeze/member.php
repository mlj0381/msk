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

    public function save(&$data, $mustUpdate = null, $mustInsert = false)
    {
        parent::save($data, $mustUpdate = null, $mustInsert = false);

        $freeze = app::get('freeze')->model('freeze')->getRow('buyer_id,code',array('freeze_id'=>$data['freeze_id']));
        $buyer_code = app::get('buyer')->model('buyers')->getRow('buyer_code',array('buyer_id'=>$freeze['buyer_id']));
        $refer_id =  app::get('b2c')->model('members')->getRow('refer_id',array('member_id'=>$data['member_id']));
        $api_data = $data;
        $rpc_editorbuyer = app::get('freeze')->rpc("editorbuyer");

        if($api_data['status'] == '1')
        {
            $del_data['code'] = $freeze['code'];
            $del_data['refer_id'] = $refer_id['refer_id'];
            $del_data['buyer_code'] = $buyer_code['buyer_code'];
            $del_data['delFlg'] = '1';
             $rpc_editorbuyer->request($del_data);
        }
        $api_data['refer_id'] = $refer_id['refer_id'];
        $api_data['buyer_code'] = $buyer_code['buyer_code'];
        $api_data['code'] = $freeze['code'];
        $api_data['apply_type'] = $api_data['apply_type']=='1'?'A':'B';
        $api_data['status'] = $api_data['status']=='0'?'1':'2';
        $api_data['time'] = $api_data['apply_time'] = date('Y-m-d',$api_data['time']?$api_data['time']:time());

        $result = $rpc_editorbuyer->request($api_data);
        if($result)
        {

            //成功或需要做什么操作 ，没有返回值暂时不做处理
        }
        return true;
    }

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







