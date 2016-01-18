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


class aftersales_ctl_site_member extends b2c_ctl_site_member
{
    public $title = '售后服务';

    /**
     * 构造方法.
     *
     * @param object application
     */
    public function __construct(&$app)
    {
        $this->app_current = $app;
        $this->app_b2c = app::get('b2c');
        parent::__construct($this->app_b2c);
    }

    /**
     * 新请求.
     */
    public function order($page = 1)
    {
        $limit = 3;
        $mdl_order = app::get('b2c')->model('orders');
        $mdl_order_items = $this->app->model('order_items');
        $filter = array(
            'status' => array('active', 'finish'),
            'ship_status|notin' => array('0', '4'),
            'member_id' => $this->member['member_id'],
        );
        $order_list = $mdl_order->getList('*', $filter, ($page - 1) * $limit, $limit);
        $order_count = $mdl_order->count($filter);
        $oids = array_keys(utils::array_change_key($order_list, 'order_id'));
        $order_items = $mdl_order_items->getList('*', array(
            'order_id' => $oids,
        ));
        $order_items_group = utils::array_change_key($order_items, 'order_id', true);
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['order_items_group'] = $order_items_group;
        $this->pagedata['pager'] = array(
            'total' => ceil($order_count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'aftersales',
                'ctl' => 'site_member',
                'act' => 'order',
                'args' => array(
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );

        $this->output('aftersales');
    }

    /**
     * 售后服务申请.
     */
    public function newrequest($order_id, $product_id, $action = 'input', $type = 'goods')
    {
        if ($action == 'save') {
            $mdl_as_request = $this->app_current->model('request');
            $image_upload_arr = array(
                'name' => $_FILES['images']['name'],
                'tmp_name' => $_FILES['images']['tmp_name'],
                'error' => $_FILES['images']['error'],
                'size' => $_FILES['images']['size'],
                'type' => $_FILES['images']['type'],
            );
            $ready_upload = array();
            $success_upload_images = array();
            foreach ($image_upload_arr['tmp_name'] as $key => $value) {
                if (!isset($value) || empty($value)) {
                    continue;
                }
                $size = $image_upload_arr['size'][$key];
                $max_conf = $this->app_current->getConf('request_image_size') . 'M';
                $max_size = utils::parse_str_size($max_conf); //byte
                if (isset($image_upload_arr['error'][$key]) && !empty($image_upload_arr['error'][$key]) && $image_upload_arr['error'][$key] > 0) {
                    $this->_upload_error($key, '文件上传失败!' . $image_upload_arr['error'][$key]);
                }
                if ($size > $max_size) {
                    $this->_upload_error($key, '文件大小不能超过' . $max_conf);
                }
                list($w, $h, $t) = getimagesize($value);
                if (!in_array($t, array(1, 2, 3, 6))) {
                    //1 = GIF,2 = JPG，3 = PNG,6 = BMP
                    $this->_upload_error($key, '文件类型错误');
                }
                $ready_upload[] = array(
                    'tmp' => $value,
                    'name' => $image_upload_arr['name'][$key],
                );
            }
            $mdl_image = app::get('image')->model('image');
            foreach ($ready_upload as $k => $item) {
                $image_id = $mdl_image->store($item['tmp'], null, null, $item['name']);
                $success_upload_images[] = array(
                    'target_type' => 'asrequest',
                    'image_id' => $image_id,
                );
                logger::info('前台售后服务图片上传操作' . 'TMP_NAME:' . $item['tmp'] . ',FILE_NAME:' . $item['name']);
            }

            $new_request = array_merge(array(
                'request_id' => $mdl_as_request->apply_id(), //请求一个新的服务流水号
                'member_id' => $this->member['member_id'],
                'order_id' => $order_id,
                'store_id' => $_POST['store_id'],
                'createtime' => time(),
                'images' => $success_upload_images,
                'product' => array('product_id' => $product_id, 'quantity' => $_POST['product_return_num']),
            ), $_POST['request'], array(
                'status' => '1',
            ));
            //$new_request['subject'] = substr(preg_replace('/\s/', '', $new_request['description']), 0, 100).'...';
            if ($mdl_as_request->save($new_request)) {
                $this->_send('success', $new_request);
            }
        } else {
            //表单
            $redirect_order = array('app' => 'aftersales', 'ctl' => 'site_member', 'act' => 'order');
            if (!$order_id || !$product_id) {
                $this->redirect(array('app' => 'aftersales', 'ctl' => 'site_member', 'act' => 'order'));
            }
            $mdl_order = app::get('b2c')->model('orders');
            $mdl_store = app::get('store')->model('store');
            $order = $mdl_order->dump($order_id, '*', array('items' => array('*')));
            $order['store_info'] = $mdl_store->getRow('store_id, store_name', array('store_id' => $order['store_id']));
            $order_items = $order['items'];
            $order_items = utils::array_change_key($order_items, 'product_id');
            if ($order['member_id'] != $this->member['member_id'] || !isset($order_items[$product_id])) {
                $this->splash('error', $redirect_order, '非法操作!');
            }
            $this->pagedata['order'] = $order;
            $this->pagedata['request_item'] = $order_items[$product_id];
            $goods = app::get('b2c')->model('goods')->getRow('type_id', array('type_id|than' => 0, 'goods_id' => $this->pagedata['request_item']['goods_id']));
            if ($goods) {
                $type_info = app::get('b2c')->model('goods_type')->dump($goods['type_id']);
            }
            $this->pagedata['gtype_assrule'] = $type_info['setting']['assrule'];
            $conf = $this->app_current->getConf('request_subject');
            $this->pagedata['conf'] = array_merge($conf['common'], $conf[$type]);
            $this->pagedata['type'] = $type;
            $this->output('aftersales');
        }
    }

    /**
     * 请求列表.
     */
    public function request($page = 1)
    {
        $limit = 10;
        $mdl_as_request = $this->app_current->model('request');
        $mdl_products = app::get('b2c')->model('products');
        $filter = array(
            'member_id' => $this->member['member_id'],
        );
        $count = $mdl_as_request->count($filter);
        $request_list = $mdl_as_request->getList('*', $filter, ($page - 1) * $limit, $limit);
        $mdl_store = app::get('store')->model('store');
        foreach ($request_list as $key => &$item) {
            if ($item['product']['product_id']) {
                $item['product']['info'] = $mdl_products->dump($item['product']['product_id']);
            }
            $item['store_info'] = $mdl_store->getRow('store_id, store_name', array('store_id' => $item['store_id']));
            $item['subject'] = $this->_request_subject($item['subject']);
        }
        $this->pagedata['request_list'] = $request_list;
        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'aftersales',
                'ctl' => 'site_member',
                'act' => 'request',
                'args' => array(
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );

        $this->output('aftersales');
    }

    private function _request_subject($subject)
    {
        $conf = $this->app_current->getConf('request_subject');
            foreach($conf as $request){
                foreach($request as $value){
                    if($subject == $value['id']){
                        return $value['label'];
                    }
                }
            }
    }

    public function req_detail($request_id)
    {
        $mdl_as_request = $this->app_current->model('request');
        $req_detail = $mdl_as_request->dump($request_id);
        if ($req_detail['delivery_id']) {
            $mdl_delivery = app::get('b2c')->model('delivery');
            $delivery = $mdl_delivery->dump($req_detail['delivery_id'], '*', 'default');
            $this->pagedata['delivery'] = $delivery;
            $mdl_dlycorp = app::get('b2c')->model('dlycorp');
            $this->pagedata['dlycorp_list'] = $mdl_dlycorp->getList('*', array('disabled' => 'false'));
        }
        if ($req_detail['bill_id']) {
            $mdl_bills = app::get('ectools')->model('bills');
            $bill = $mdl_bills->dump($req_detail['bill_id']);
            $this->pagedata['bill'] = $bill;
        }
        $this->pagedata['req_detail'] = $req_detail;
        $this->output('aftersales');
    }

    public function update_delivery()
    {
        $mdl_as_request = app::get('aftersales')->model('request');
        $mdl_delivery = app::get('b2c')->model('delivery');
        $request = $mdl_as_request->dump($_POST['request_id'], '*', 'default_sub');
        $redirect = $this->gen_url(array(
            'app' => 'aftersales',
            'ctl' => 'site_member',
            'act' => 'request'
        ));
        if (!$request) {
            $this->splash('error', $redirect, '提交失败!');
        }
        $reship_delivery = $request['reship'];
        $reship_delivery['consignor'] = $request['order']['consignee'];
        $reship_delivery['dlycorp_id'] = $_POST['delivery']['dlycorp_id'];
        $reship_delivery['logistics_no'] = $_POST['delivery']['logistics_no'];
        if ($mdl_delivery->save($reship_delivery)) {
            $this->splash('success', $redirect, '提交成功,请等待确认!');
        } else {
            $this->splash('error', $redirect, '提交失败!');
        }
    }

    private function _send($result, $msg)
    {
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

    private function _upload_error($index, $error)
    {
        echo json_encode(array(
            'fipt_idx' => $index,
            'error' => $error,
        ));
        exit;
    }
}
