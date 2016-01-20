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

class b2c_ctl_site_comment extends b2c_frontpage {

    public $noCache = true;

    public function __construct(&$app) {
        $this->app = $app;
        parent::__construct($app);
        $this->mComment = $this->app->model('member_comment');
        $this->verify_member();
        $this->member = $this->get_current_member();
        $this->set_tmpl('member');
    }

    public function form($order_id, $product_id, $type = 'comment', $reply = null) {
        
        $this->_response->set_header('Cache-Control', 'no-store');
        $mdl_order = app::get('b2c')->model('orders');
        //$this->store = vmc::singleton('seller_object')->get_current_seller();
        $this->pagedata['good_comment'] = $this->mComment->getRow('*', array('product_id' => $product_id, 'member_id' => $this->member['member_id'], 'order_id' => $order_id, 'type' => $type, 'comment_num' => '1'));

//        $exits_comment = $this->mComment->groupList('*', array('order_id' => $order_id, 'comment_type' => $type));
        $this->pagedata['reply'] = $reply;
        $order = $mdl_order->dump($order_id, '*', array('items' => array('*')));
        if ($order['member_id'] != $this->member['member_id']) {
            $this->splash('error', '', '非法操作!');
        }
        if ($order['ship_status'] == '0' || $order['status'] == 'dead') {
            $this->splash('error', '', '暂不能评价!');
        }
        $order['store_info'] = app::get('store')->model('store')->getRow('store_id, store_name', array('store_id' => $order['store_id']));
        $this->pagedata['order'] = $order;
        $this->pagedata['product_id'] = $product_id;
        //$this->pagedata['exits_comment'] = $exits_comment;
        $this->pagedata['member_avatar'] = $this->member['avatar'];
        $this->title = '评价#' . $order_id . ' 商品';
        $this->set_tmpl('comment_form');
        $this->pagedata['_PAGE_'] = 'site/comment/form.html';
        //$this->output();
        $this->page('site/comment/form.html');
    }

   

    private function comment_count($goods_id){
        vmc::singleton('b2c_openapi_goods', false)->counter(array(
            'goods_id' => $goods_id,
            'comment_count' => 1,
            'comment_count_sign' => md5($goods_id . 'comment_count' . (1 * 1024))//计数签名
        ));
    }
    public function save($type = 'comment') {
        extract($_POST);
        $redirect = $this->gen_url(array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'orders', 'args0' => 's4'));
        if($reply){
            $comment['for_comment_id'] = $comment['member_id'];
            $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_seller', 'act' => 'orders', 'args0' => 's4'));
        }
        $comment['comment_id'] = $this->mComment->apply_id($type);
        $comment['content'] = trim($comment['content']);
        $comment['goods_id'] = $goods_id;
        $comment['createtime'] = time();
        if (is_numeric($comment_id)) {
            //追评
            $comment['comment_num'] = 2;
            if (!$this->mComment->save($comment)) {
                $this->splash('error', $redirect, '提交失败!');
            }
            $comment_type = array('order_id' => $comment['order_id'], 'comment_type' => '2');
            if(!$this->app->model('orders')->save($comment_type)){
                $db->rollback();
                $this->_send('error', '提交失败!');
            }
            $this->splash('success', $redirect, '评论成功!');
            $this->comment_count($goods_id);
        } else {
            //第一次评论
            $db = vmc::database();
            $db->beginTransaction();
            $comment['comment_id'] = $this->mComment->apply_id($type);
            $comment['comment_num'] = 1;
            
            if (!$this->mComment->save($comment)) {
                $db->rollback();
                $this->splash('error', $redirect, '提交失败!');
            }
            $mark['comment_id'] = $comment['comment_id'];
            $mark['goods_id'] = $goods_id;
            if (!$this->app->model('goods_mark')->save($mark)) {
                $db->rollback();
                $this->_send('error', '提交失败!');
            }
            $comment_type = array('order_id' => $comment['order_id'], 'comment_type' => '1');
            if(!$this->app->model('orders')->save($comment_type)){
                $db->rollback();
                $this->_send('error', '提交失败!');
            }
            $this->comment_count($goods_id);
            $db->commit();
            $this->splash('success', $redirect, '评论成功');
        }
    }

    public function show_list($comment_type = 'all', $page = 1) {
        $this->menuSetting = 'setting';
        $limit = 10;
        $mdl_goods_mark = app::get('b2c')->model('goods_mark');
        $filter = array(
            'member_id' => $this->member['member_id'],
            'display' => 'true',
            'for_comment_id' => '0'
        );
        if (is_numeric($comment_type)) {
            $comment_id = $mdl_goods_mark->getList('comment_id', array('mark_star' => $comment_type));
            $tmp = array();
            foreach ($comment_id as $key => &$value) {
                array_push($tmp, $value['comment_id']);
            }
            $filter['comment_id|in'] = $tmp;
        }
        $comment_list_member = $this->mComment->groupList('*', $filter, ($page - 1) * $limit, $limit);
        $filter['for_comment_id'] = $this->member['member_id'];
        $comment_list_seller = $this->mComment->groupList('*', $filter, ($page - 1) * $limit, $limit);
        $this->pagedata['member_info'] = $this->member;
        $this->pagedata['comment_type'] = $comment_type;
        $this->pagedata['comment_member'] = $comment_list_member;
        $this->pagedata['comment_seller'] = $comment_list_seller;
        $this->pagedata['order'] = $order;
        $this->pagedata['_PAGE_'] = 'site/comment/show_list.html';
        $this->output();
    }

    public function show($goods_id, $page = 1) {
        $this->_response->set_header('Cache-Control', 'no-store');
        $limit = 20;
        $filter = array(
            'goods_id' => $goods_id,
            'display' => 'true'
        );
        $comment_list = $this->mComment->groupList('*', $filter, ($page - 1) * $limit, $limit, '', 'goods_id');
        $count = $this->mComment->count($filter);
        $this->pagedata['comment_list'] = $comment_list[$goods_id];
        $this->pagedata['comment_count'] = $count;
        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'b2c',
                'ctl' => 'site_comment',
                'act' => 'show',
                'args' => array(
                    $goods_id,
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );
        if ($this->_request->is_ajax()) {
            //商品详情内展示
            $this->display('site/comment/list.html');
        } else {
            //单独展示
            $goods_detail = vmc::singleton('b2c_goods_stage')->detail($goods_id);
            $this->pagedata['goods_detail'] = $goods_detail;
            $this->title = $goods_detail['name'] . ' 评价\口碑';
            $this->set_tmpl('comment_show');
            $this->page('site/comment/show.html');
        }
    }

    private function _send($result, $msg) {
        if ($result == 'success') {
            echo json_encode(array(
                'success' => '成功',
                'data' => $msg,
            ));
        } else {
            echo json_encode(array(
                'error' => $msg,
                'data' => '',
            ));
        }
        exit;
    }

    private function _upload_error($index, $error) {
        echo json_encode(array(
            'fipt_idx' => $index,
            'error' => $error,
        ));
        exit;
    }

}
