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




class b2c_mdl_orders extends dbeav_model {

    var $has_tag = true;
    var $defaultOrder = array('createtime', 'DESC');
    var $has_many = array(
        'items' => 'order_items',
        'promotions' => 'order_pmt',
        'store_info' => 'store@store:append:store_id^store_id',
        'comment' => 'member_comment:replace:order_id^order_id',
        'goods' => 'goods:replace:goods_id^goods_id'
    );
    public $has_one = array();
    public $subSdf = array(
        'default' => array(
            'store_info' => array(
                '*'
            ),
            'comment' => array(
                'comment_id'
            ),
            'goods' => array('*')
        ),
    );

    /**
     *
     * @params null
     * @return string 订单编号
     */
    public function apply_id() {
        $tb = $this->table_name(1);
        do {
            $i = substr(mt_rand(), -5);
            $new_order_id = (date('y') + date('m') + date('d')) . date('His') . $i;
            $row = $this->db->selectrow('SELECT order_id from ' . $tb . ' where order_id =' . $new_order_id);
        } while ($row);

        return $new_order_id;
    }

    /**
     * 重载订单标准数据
     * @params array - standard data format
     * @params boolean 是否必须强制保存
     */
    public function save(&$sdf, $mustUpdate = null, $mustInsert = false) {
        $info_object = vmc::service('sensitive_information');
        if (is_object($info_object))
            $info_object->opinfo($sdf, 'b2c_mdl_orders', __FUNCTION__);
        $is_save = parent::save($sdf, $mustUpdate, $mustInsert);
        return $is_save;
    }

    /**
     * 返回订单字段的对照表
     * @params string 状态
     * @params string key value
     */
    public function trasform_status($type = 'status', $val) {
        switch ($type) {
            case 'status':
                $tmpArr = array(
                    'active' => ('活动'),
                    'finish' => ('完成'),
                    'dead' => ('死单'),
                );
                return $tmpArr[$val];
                break;
            case 'pay_status':
                $tmpArr = array(
                    0 => ('未付款'),
                    1 => ('已付款'),
                    2 => ('付款至担保方'),
                    3 => ('部分付款'),
                    4 => ('部分退款'),
                    5 => ('已退款'),
                );
                return $tmpArr[$val];
                break;
            case 'ship_status':
                $tmpArr = array(
                    0 => ('未发货'),
                    1 => ('已发货'),
                    2 => ('部分发货'),
                    3 => ('部分退货'),
                    4 => ('已退货'),
                );
                return $tmpArr[$val];
                break;
        }
    }

    /**
     * 重写getList方法
     */
    public function getList($cols = '*', $filter = array(), $offset = 0, $limit = -1, $orderType = null) {
        $arr_list = parent::getList($cols, $filter, $offset, $limit, $orderType);
        $obj_extends_order_service = vmc::serviceList('b2c_order_extends_actions');
        if ($obj_extends_order_service) {
            foreach ($obj_extends_order_service as $obj)
                $obj->extend_list($arr_list);
        }
        $info_object = vmc::service('sensitive_information');
        if (is_object($info_object))
            $info_object->opinfo($arr_list, 'b2c_mdl_orders', __FUNCTION__);
        return $arr_list;
    }

    public function modifier_pay_app($col) {
        $mdl_papp = app::get('ectools')->model('payment_applications');
        $papp = $mdl_papp->dump($col);
        return $papp['name'] ? $papp['name'] : $col;
    }

    public function modifier_member_id($row) {
        if ($row === 0 || $row == '0') {
            return ('非会员顾客');
        } else {
            return vmc::singleton('b2c_user_object')->get_member_name(null, $row);
        }
    }

    public function modifier_need_invoice($col) {
        $_return = $col == 'true' ? '<span>是</span>' : '<span class="text-muted">否</span>';
        return $_return;
    }

    function _filter($filter, $tableAlias = null, $baseWhere = null) {
        if (isset($filter) && $filter && is_array($filter) && array_key_exists('member_login_name', $filter)) {
            $obj_pam_account = app::get('pam')->model('members');
            $pam_filter = array(
                'login_account|has' => $filter['member_login_name'],
            );
            $row_pam = $obj_pam_account->getList('*', $pam_filter);
            $arr_member_id = array();
            if ($row_pam) {
                foreach ($row_pam as $str_pam) {
                    $arr_member_id[] = $str_pam['member_id'];
                }
                $filter['member_id|in'] = $arr_member_id;
            } else {
                if ($filter['member_login_name'] == ('非会员顾客'))
                    $filter['member_id'] = 0;
            }
            unset($filter['member_login_name']);
        }

        foreach (vmc::servicelist('b2c_mdl_orders.filter') as $k => $obj_filter) {
            if (method_exists($obj_filter, 'extend_filter')) {
                $obj_filter->extend_filter($filter);
            }
        }
        $info_object = vmc::service('sensitive_information');
        if (is_object($info_object))
            $info_object->opinfo($filter, 'b2c_mdl_orders', __FUNCTION__);
        $filter = parent::_filter($filter);
        return $filter;
    }

    /**
     * 重写搜索的下拉选项方法
     * @param null
     * @return null
     */
    public function searchOptions() {
        $columns = array();
        foreach ($this->_columns() as $k => $v) {
            if (isset($v['searchtype']) && $v['searchtype']) {
                $columns[$k] = $v['label'];
            }
        }
        /** 添加用户名搜索 * */
        $columns['member_login_name'] = ('会员用户名');
        /** end * */
        /** 添加额外的搜索列 * */
        $arr_extends_options = array();
        foreach (vmc::servicelist('b2c.order.searchOptions.addExtends') as $object) {
            if (!isset($object) || !is_object($object))
                continue;
            if (method_exists($object, 'get_order'))
                $index = $object->get_order();
            else
                $index = 10;

            $arr_extends_options[$index] = $object;
        }
        if ($arr_extends_options) {
            ksort($arr_extends_options);
            foreach ($arr_extends_options as $obj) {
                $obj->get_extends_cols($columns);
            }
        }
        /** end * */
        return $columns;
    }

    /**
     * 订单删除之后做的事情
     * @param array post
     * @return boolean
     */
    public function suf_recycle($filter = array()) {
        if (!$filter)
            $filter = $_GET['p'][0];

        $is_update = true;
        $obj_suf_recycles = vmc::servicelist('b2c.order.after_delete');
        if ($obj_suf_recycles) {
            foreach ($obj_suf_recycles as $obj_suf) {
                $is_update = $obj_suf->dorecycle($filter);
            }
        }

        return $is_update;
    }

    /**
     * 订单恢复之后做的事情
     * @param array post
     * @return boolean
     */
    public function suf_restore($filter = array()) {
        $is_update = true;
        $obj_suf_restores = vmc::servicelist('b2c.order.after_restore');
        if ($obj_suf_restores) {
            foreach ($obj_suf_restores as $obj_suf) {
                $is_update = $obj_suf->dorestore($filter);
            }
        }

        return $is_update;
    }

    /**
     * 获得相邻订单
     */
    public function get_border($order_id) {
        $table = $this->table_name(1);
        $sql = "(SELECT order_id FROM $table WHERE order_id<$order_id ORDER BY order_id DESC LIMIT 1) UNION (SELECT order_id FROM $table WHERE order_id>$order_id ORDER BY order_id ASC LIMIT 1) ORDER BY order_id DESC";
        $dorder = $this->db->select($sql);
        if (count($dorder) < 2) {
            array_unshift($dorder, array('order_id' => null));
        }
        return $dorder;
    }

    //订单各状态数量统计
    public function type_count($filter){
        $return = array();
        $return['no_pay'] = $this->getRow('count(order_id) as no_pay',
            array_merge($filter, array( 'pay_status' => '0')));
        $return['no_ship'] = $this->getRow('count(order_id) as no_ship',
            array_merge($filter, array( 'ship_status' => '0')));
        $return['confirm'] = $this->getRow('count(order_id) as confirm',
            array_merge($filter, array('confirm' => 'N')));
        $return['comment'] = $this->getRow('count(order_id) as comment',
            array_merge($filter, array('comment' => 'false', 'confirm' => 'Y', 'comment_type' => '0')));
        return $return;
    }
    
    //会员订单筛选条组合
    public function filter(){
        return array(
            'all' => array(
                
            ) ,
            's1' => array(
               
                'status' => 'active',
                'pay_status' => array(
                    '0',
                    '3',
                    '5',
                ),
                'is_cod' => 'N'
            ) ,
            's2' => array(
                
                'status' => 'active',
                'pay_status' => array(
                    '1',
                    '2',
                ) ,
                'ship_status|notin' => array(
                    '1',
                ),
            ) ,
            's3' => array(
                
                'status' => 'active',
                'ship_status' => array(
                    '1',
                    '2',
                ),
                'confirm' => 'N'
            ) ,
            's4' => array(
                
                'status' => 'active',
                'confirm'=> 'Y',
                'comment_type' => '0'
            ),
            's5' => array(
               
                'status' => 'active',
                'confirm'=> 'Y',
                'comment_type|notin'=> '0',
            ),
            's6' => array(
                
                'status' => 'dead',
            ),
            's7' => array(
                
                'status' => 'del',
            ),
        );
    }
}
