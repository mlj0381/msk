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


class b2c_mdl_member_comment extends dbeav_model {

    public $has_many = array(
        'images' => 'image_attach@image:contrast:comment_id^target_id',
        'reply' => 'member_comment:contrast:comment_id^for_comment_id',
    );
    public $has_one = array(
        'mark' => 'goods_mark@b2c:contrast:comment_id^comment_id'
    );
    public $subSdf = array(
        'delete' => array(
            'images' => array(
                '*',
            ),
            'mark' => array(
                '*',
            ),
            'reply' => array(
                '*'
            )
        ),
    );

    public function apply_id($type = 'comment') {
        $sign = (($type == 'comment') ? '8' : '9');
        $tb = $this->table_name(1);
        do {

            $i = substr(mt_rand(), -3);
            $comment_id = $sign . (date('y') + date('m') + date('d')) . date('His') . $i;
            $row = $this->db->selectrow('SELECT bill_id from ' . $tb . ' where bill_id =' . $bill_id);
        } while ($row);

        return $comment_id;
    }

    public function save(&$sdf, $mustUpdate = null, $mustInsert = false) {
        if (!$sdf['comment_id']) {
            $sdf['comment_id'] = $this->apply_id($sdf['comment_type'] ? $sdf['comment_type'] : 'comment');
        }
        $is_save = parent::save($sdf, $mustUpdate, $mustInsert);
        return $is_save;
    }

    /**
     * 获得分组详细评价列表
     */
    public function groupList($cols = '*', $filter = array(), $offset = 0, $limit = -1, $orderType = null, $group_by = 'product_id') {

        $orderType = ' createtime DESC'; //fixOrder
        $list = parent::getList($cols = '*', $filter, $offset, $limit, $orderType);
        $list = utils::array_change_key($list, $group_by, true);
        foreach ($list as $group => &$items) {
            $items = utils::array_change_key($items, 'comment_id');

            foreach ($items as $key => &$comment) {
//                if(!empty($comment['for_comment_id'])){
//                    $items[$comment['for_comment_id']]['reply'][$comment['comment_id']] = $comment;
//                    $items[$comment['for_comment_id']]['lastreply'] = $items[$comment['for_comment_id']]['lastreply']?$items[$comment['for_comment_id']]['lastreply']:$comment['createtime'];
//                    unset($items[$key]);
//                    continue;
//                }
                $comment['mark'] = app::get('b2c')->model('goods_mark')->getRow('*', array('comment_id' => $comment['comment_id']));
//                $comment['images'] = app::get('image')->model('image_attach')->getList('image_id',array('target_id'=>$comment['comment_id']));
            }
        }

        //$this->member_group($list);
        $this->comments($list);
        return $list;
    }

    //按用户分组
    public function member_group(&$list){
        $mdl_member = app::get('pam')->model('members');
        foreach($list as $key => &$value){
            $comment_item = reset($value);
            $member_info = $mdl_member->getRow('login_account, member_id', array('member_id' =>
                $comment_item['member_id']));
            $member_info['comment'][$comment_item['member_id']] = $value;

        }
    }

    public function comments(&$comment_list) {

        $mdl_store = app::get('store')->model('store');
        $mdl_goods = app::get('b2c')->model('goods');
        $mdl_member = app::get('pam')->model('members');
        foreach ($comment_list as $key => &$value) {
            $comment_item = reset($value);
            $comment_list[$key]['store_info'] = $mdl_store->getRow('store_name, store_id', array('store_id' => $comment_item['store_id']));
            $comment_list[$key]['member_info'] = $mdl_member->getRow('login_account, member_id', array('member_id' => $comment_item['member_id']));
            $comment_list[$key]['goods_info'] = $mdl_goods->getRow('name, goods_id', array('goods_id' => $comment_item['goods_id']));
            $comment_list[$key]['goods_info']['comment_num'] = $comment_item['comment_num'];
            $comment_list[$key]['goods_info']['order_id'] = $comment_item['order_id'];
            $comment_list[$key]['goods_info']['product_id'] = $comment_item['product_id'];
            $comment_list[$key]['goods_info']['comment_id'] = $comment_item['comment_id'];
        }
    }
}
