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

class b2c_ctl_mobile_comment extends b2c_mfrontpage
{
    public $noCache = true;
    public function __construct(&$app)
    {
        parent::__construct($app);
    }

    public function form($order_id, $product_id, $type = 'comment')
    {
        $this->verify_member();
        $this->member = $this->get_current_member();
        $this->_response->set_header('Cache-Control', 'no-store');
        $mdl_order = app::get('b2c')->model('orders');
        $mdl_mcomment = app::get('b2c')->model('member_comment');
        $exits_comment = $mdl_mcomment->groupList('*', array('order_id' => $order_id, 'comment_type' => $type));
        $order = $mdl_order->dump($order_id, '*', array('items' => array('*')));
        if ($order['member_id'] != $this->member['member_id']) {
            $this->splash('error', '', '非法操作!');
        }
        if ($order['ship_status'] == '0' || $order['status'] == 'dead') {
            $this->splash('error', '', '暂不能评价!');
        }
        $this->pagedata['member_avatar'] = $this->member['avatar'];
        $this->pagedata['order'] = $order;
        $this->pagedata['exits_comment'] = $exits_comment;
        $this->title = '评价#'.$order['order_id'].' 商品';
        $this->set_tmpl('comment_form');
        $this->page('mobile/comment/form.html');
    }

    public function save($type = 'comment')
    {
        $this->verify_member();
        $this->member = $this->get_current_member();
        $mdl_mcomment = app::get('b2c')->model('member_comment');
        $new_comment_id = $mdl_mcomment->apply_id($type);
        $redirect = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'mobile_comment',
            'act' => 'form',
            'args'=>array($_POST['order_id'])
        ));
        $fipt_idx = -1;
        $max_conf = $this->app->getConf('comment_image_size').'M';
        $max_size = utils::parse_str_size($max_conf); //byte
        if (!$_POST) {
            $this->splash('error',$redirect ,'缺少参数！');
        }
        //新评价
        if ($comment_data = $_POST[$type]) {
            /**
             * $word = array($product_id => $content);.
             */
            foreach ($comment_data['word'] as $goods_id => $word) {
                $product_id = key($word);
                $content = current($word);
                $new_comment = array(
                    'comment_id' => $new_comment_id++,
                    'goods_id' => $goods_id,
                    'product_id' => $product_id,
                    'member_id' => $this->member['member_id'],
                    'order_id' => $_POST['order_id'],
                    'author_name' => $this->member['uname'],
                    'createtime' => time(),
                    'content' => htmlspecialchars($content),
                );
                $new_comment['content'] = preg_replace("/\n/is", '<br>', $new_comment['content']);
                if (empty($new_comment['content']) || trim($new_comment['content']) == '') {
                    continue;
                }
                $new_comment['title'] = substr(preg_replace('/\s/','',$new_comment['content']),0,100).'...';
                if ($mark = $comment_data['mark'][$goods_id]) {
                    //评分
                    $new_comment['mark'] = array(
                        'mark_star' => floatval($mark),
                        'goods_id' => $goods_id,
                        'comment_id' => $new_comment['comment_id'],
                    );
                }
                //晒一晒处理
                $image_upload_arr = $comment_data['image'][$product_id];
                //图片上传验证
                foreach ($image_upload_arr as $image_base64) {
                    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $image_base64, $result)) {
                        $type = $result[2];
                        $ready_tmp_file = tempnam(TMP_DIR, $image_name = 'avatar.'.$type);
                        file_put_contents($ready_tmp_file, base64_decode(str_replace($result[1], '', $image_base64)));
                    }else{
                        continue;
                    }
                    $size = filesize($ready_tmp_file);
                    list($w, $h, $t) = getimagesize($ready_tmp_file);
                    if (!in_array($t, array(1, 2, 3, 6))) {
                        //1 = GIF,2 = JPG，3 = PNG,6 = BMP
                        $this->splash('error',$redirect ,'文件上传失败.类型错误');
                    }
                    $ready_upload[] = $ready_tmp_file;
                }
                $mdl_image = app::get('image')->model('image');
                foreach ($ready_upload as $k => $item) {
                    $image_id = $mdl_image->store($item, null, null, $item['name']);//保存图片
                    $new_comment['images'][] = array(
                         'target_type' => 'comment',
                         'image_id' => $image_id,
                         'target_id' => $new_comment['comment_id'],
                     );
                    logger::info('前台评价晒一晒图片上传操作'.'TMP_NAME:'.$item['tmp'].',FILE_NAME:'.$item['name']);
                }

                if (!$mdl_mcomment->save($new_comment)) {
                    $this->splash('error',$redirect ,'提交失败');
                } else {
                    //商品评价计数
                    vmc::singleton('b2c_openapi_goods', false)->counter(array(
                        'goods_id' => $goods_id,
                        'comment_count' => 1,
                        'comment_count_sign' => md5($goods_id.'comment_count'.(1 * 1024)),//计数签名
                    ));
                }
            }
        }

        //评价追加、回复
        if (isset($_POST['reply']) && !empty($_POST['reply'])) {
            foreach ($_POST['reply'] as $key => $value) {
                $new_reply = array(
                    'comment_id' => $new_comment_id++,
                    'for_comment_id' => $key,
                    'order_id' => $_POST['order_id'],
                    'goods_id' => $value['goods_id'],
                    'product_id' => $value['product_id'] ,
                    'member_id' => $this->member['member_id'],
                    'author_name' => $this->member['uname'],
                    'createtime' => time(),
                    'content' => htmlspecialchars($value['content']),
                );
                if (empty($new_reply['content']) || trim($new_reply['content']) == '') {
                    continue;
                }
                $new_reply['title'] = substr(preg_replace('/\s/','',$new_reply['content']),0,100).'...';
                if (!$mdl_mcomment->save($new_reply)) {
                    $this->splash('error',$redirect ,'追加评论失败');
                } else {
                    //更新最后回复时间
                    $mdl_mcomment->update(array('lastreply'=>time()),array('comment_id'=>$key));
                    //商品评价计数
                    vmc::singleton('b2c_openapi_goods', false)->counter(array(
                        'goods_id' => $value['goods_id'],
                        'comment_count' => 1,
                        'comment_count_sign' => md5($value['goods_id'].'comment_count'.(1 * 1024)),//计数签名
                    ));
                }
            }
        }
        $this->splash('success',$redirect ,'提交成功！');
    }

    public function show($goods_id, $page = 1)
    {

        $this->_response->set_header('Cache-Control', 'no-store');
        $mdl_mcomment = app::get('b2c')->model('member_comment');
        $limit = 20;
        $filter = array(
            'goods_id' => $goods_id,
            'display' => 'true',
        );
        $comment_list = $mdl_mcomment->groupList('*', $filter, ($page - 1) * $limit, $limit, '', 'goods_id');
        $count = $mdl_mcomment->count($filter);
        $this->pagedata['comment_list'] = $comment_list[$goods_id];
        $this->pagedata['comment_count'] = $count;
        $this->title='商品评价'."($count)";
        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit) ,
            'current' => $page,
            'link' => array(
                'app' => 'b2c',
                'ctl' => 'mobile_comment',
                'act' => 'show',
                'args' => array(
                    $goods_id,
                    ($token = time()),
                ) ,
            ) ,
            'token' => $token,
        );
        if ($this->_request->is_ajax()) {
            //商品详情内展示
            $this->display('site/comment/list.html');
        } else {
            //单独展示
            // $goods_detail = vmc::singleton('b2c_goods_stage')->detail($goods_id);
            // $this->pagedata['goods_detail'] = $goods_detail;
            $this->set_tmpl('comment_show');
            $this->page('mobile/comment/show.html');
        }
    }


}
