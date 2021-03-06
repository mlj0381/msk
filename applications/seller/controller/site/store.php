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
// | Description 商家店铺
// +----------------------------------------------------------------------

class seller_ctl_site_store extends seller_frontpage
{
    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
        $this->mStore = app::get('store')->model('store');
        $this->mComment = app::get('b2c')->model('member_comment');
    }

    public function index()
    {
        $this->output();
    }

    //举报管理
    public function complaints()
    {
        $this->output();
    }

    //店铺设置
    public function setting()
    {
        if ($_POST) $this->_setting($_POST);
        $this->pagedata['store_info'] = app::get('store')->model('store')->getRow('*', array('store_id' => $this->store['store_id']));
        $this->pagedata['store_type'] = $this->app->getConf('store_type');
        $this->pagedata['store_principal'] = app::get('base')->model('company_extra')->getList('*', array('uid' => $this->seller['seller_id'], 'from' => '1', 'key' => 'store_principal'));
        $this->output();
    }

    //店铺模板管理
    public function modal_merg()
    {
        $this->output();
    }

    //修改基本信息
    private function _setting($post)
    {
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_store', 'act' => 'setting'));
        $post['store']['store_id'] = $this->store['store_id'];
        $post['store']['seller_id'] = $this->seller['seller_id'];
        $db = vmc::database();
        $db->beginTransaction();
        if (!$this->mStore->save($post['store'])) {
            $db->rollback();
            $this->splash('error', $redirect, '修改失败');
        }
        $post['store_principal']['from'] = 1;
        $post['store_principal']['uid'] = $this->seller['seller_id'];
        if (!app::get('base')->model('company_extra')->extra_save('store_principal', $post)) {
            $db->rollback();
            $this->splash('error', $redirect, '修改失败');
        }
        $db->commit();
        $this->splash('success', $redirect, '修改成功');
    }

    //评价
    public function appraisal($comment_type = 'all', $page = 1)
    {

        $limit = 10;
        $mdl_goods_mark = app::get('b2c')->model('goods_mark');
        $filter = array('store_id' => $this->store['store_id'], 'display' => 'true', 'for_comment_id' => '0');
        if (is_numeric($comment_type)) {
            $comment_id = $mdl_goods_mark->getList('comment_id', array('mark_star' => $comment_type));
            $tmp = array();
            foreach ($comment_id as $key => &$value) {
                array_push($tmp, $value['comment_id']);
            }
            $filter['comment_id|in'] = $tmp;
        }
        $comment_list_member = $this->mComment->groupList('*', $filter, ($page - 1) * $limit, $limit);
        $this->mComment->comments($comment_list_member);
        unset($filter['for_comment_id']);
        $filter['for_comment_id|notin'] = 0;
        $comment_list_seller = $this->mComment->groupList('*', $filter, ($page - 1) * $limit, $limit);
        $this->mComment->comments($comment_list_seller);
        $this->pagedata['member_info'] = $this->member;
        $this->pagedata['comment_type'] = $comment_type;
        $this->pagedata['comment_member'] = $comment_list_member;
        $this->pagedata['comment_seller'] = $comment_list_seller;
        $this->pagedata['order'] = $order;
        $this->output();
    }

    //回复评价
    public function reply()
    {
        extract($_POST);
        $redirect_url = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_store', 'act' => 'appraisal'));
        //评价追加、回复
        $mdl_comment = app::get('b2c')->model('member_comment');
        $countFilter = array(
                            'order_id' => $reply['order_id'],
                            'goods_id' => $reply['order_id'],
                            'member_id' => $reply['member_id'],
                            'product_id' => $reply['product_id'],
                            'for_comment_id|in' => 0,
                            );
        $comment = $mdl_comment->count($countFilter);
        if (isset($reply) && !empty($reply)) {
            $new_reply = array('comment_id' => $mdl_comment->apply_id('reply'),
                                'for_comment_id' => $reply['member_id'],
                                'order_id' => $reply['order_id'],
                                'comment_num' => $comment,
                                'goods_id' => $reply['goods_id'],
                                'product_id' => $reply['product_id'],
                                'store_id' => $this->store['store_id'],
                                'author_name' => $this->store['store_name'],
                                'createtime' => time(),
                                'member_id' => $reply['member_id'],
                                'content' => htmlspecialchars($reply['content']),);
            $new_reply['title'] = substr(preg_replace('/\s/', '', $new_reply['content']), 0, 100) . '...';
            if (!$mdl_comment->save($new_reply)) {
                $this->splash('error', $redirect_url, '回复失败');
            }

        }

        $this->splash('success', $redirect_url, '提交成功');
    }

    //店员设置
    public function clerk_setting()
    {
        $this->output();
    }

}
