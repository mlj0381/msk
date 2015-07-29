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


class ectools_mdl_bills extends dbeav_model {
    var $defaultOrder = array(
        'last_modify',
        'DESC'
    );
    public function apply_id($bill_sdf) {
        if (is_null($bill_sdf) || empty($bill_sdf['bill_type']) || empty($bill_sdf['pay_object'])) {
            trigger_error("单号申请失败" , E_USER_ERROR);
            exit;
        }
        $t_map = array(
            'payment' => '1',
            'refund' => '2'
        );
        $o_map = array(
            'order' => '0',
            'recharge' => '1'
        );
        $key = $t_map[$bill_sdf['bill_type']] . $o_map[$bill_sdf['pay_object']];

        $tb = $this->table_name(1);
        do{
            $microtime = utils::microtime();
            mt_srand($microtime);
            $i = substr(mt_rand() , -3);
            $bill_id = $key . (date('y')+date('m')+date('d')).date('His') . $i;
            $row = $this->db->selectrow('SELECT bill_id from '.$tb.' where bill_id ='.$bill_id);
        }while($row);
        return $bill_id;
    }
    public function save(&$data, $mustUpdate = null, $mustInsert = false) {
        if ($bill = $this->dump($data['bill_id'])) {
            if ($bill['order_id'] && $bill['order_id'] != $data['order_id']) {
                return false;
            }
            if ($bill['status'] == $data['status'] || ($bill['status'] != 'progress' && $bill['status'] != 'ready')) {
                return true;
            }
        } else {
            $data['createtime'] = time();
        }
        return parent::save($data, $mustUpdate, $mustInsert);
    }
    public function modifier_member_id($row) {
        if (is_null($row) || empty($row)) {
            return '未知';
        }
        $login_name = vmc::singleton('b2c_user_object')->get_member_name(null, $row);
        if ($login_name) {
            return $login_name;
        } else {
            return '未知';
        }
    }
    /**
     * filter字段显示修改
     * @params string 字段的值
     * @return string 修改后的字段的值
     */
    public function modifier_op_id($row) {
        if (is_null($row) || empty($row)) {
            return '-';
        }
        $obj_pam_account = app::get('pam')->model('account');
        $arr_pam_account = $obj_pam_account->getList('login_name', array(
            'account_id' => $row
        ));
        return $arr_pam_account[0]['login_name'] ? $arr_pam_account[0]['login_name'] : '未知操作员';
    }
    /**
     * filter字段显示修改
     * @params string 字段的值
     * @return string 修改后的字段的值
     */
    public function modifier_pay_app_id($col) {

        $mdl_payapps = $this->app->model('payment_applications');
        $pay_app = $mdl_payapps->dump($col);
        if ($pay_app) {
            return $pay_app['name'].$pay_app['version'].'('.$pay_app['display_name'].')';
        } else return 'app_name';
    }
}
