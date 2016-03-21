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
class b2c_ctl_site_member extends b2c_frontpage
{
    public $title = '会员中心';

    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
        $this->verify_member();
        $this->action = $this->_request->get_act_name();
        $this->set_tmpl('member');
        //刷新经验值和会员等级
        //vmc::singleton('b2c_member_exp')->renew($this->member['member_id']);
    }

    /**
     * 会员中心首页.
     */
    public function index($page)
    {
        $this->pagedata['order_count'] = $this->app->model('orders')->type_count(array('member_id' => $this->member['member_id']));
        $user_obj = vmc::singleton('b2c_user_object');
        $this->pagedata['pam_data'] = $user_obj->get_pam_data('*', $this->member['member_id']);
        //查询最近浏览
        $this->lately($page);
        $scan['store'] = app::get('store')->model('store')->getRow('store_name, store_id', array());
        $this->pagedata['member_type'] = 'index';
        $this->output();
    }

    /**
     * 最近浏览
     * @params page 当前页数
     */
    public function lately($page = 1, $type = null)
    {
        $mdl_member_goods = $this->app->model('member_goods');
        $scan = '';
        if ($this->member['member_id']) {
            $pageSize = $type == 'load' ? 9999999 : 8;
            $filter = array('member_id' => $this->member['member_id'], 'type' => 'scan');
            $scan = $mdl_member_goods->getList('*', $filter, ($page - 1) * $pageSize, $pageSize, 'gnotify_id desc');
            $mdl_goods = $this->app->model('goods');
            foreach ($scan as &$value) {
                $value['store'] = $mdl_goods->getRow('store_id', array('goods_id' => $value['goods_id']));
            }
            $token = time();
            $this->pagedata['pager'] = array(
                'total' => ceil($mdl_member_goods->count($filter) / $pageSize),
                'token' => $token,
                'current' => $page,
                'link' => $this->gen_url(array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'index', 'args0' => $token)),
            );
        }
        $this->pagedata['scan'] = $scan;
        if($this->_request->is_ajax()){
            $this->display('site/member/action/lately.html');
        }
    }

    public function home()
    {
        $this->page('site/member/home.html');
    }

    /**
     * 会员头像
     */
    public function avatar($action = false)
    {
        $this->menuSetting = 'setting';
        if ($action == 'upload') {
            $redirect_here = array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'avatar');
            $mdl_image = app::get('image')->model('image');
            $image_name = $_FILES['avatar_file']['name'];
            $ready_tmp_file = $_FILES['avatar_file']['tmp_name'];
            $bt_size = filesize($ready_tmp_file);
            $max_conf = $this->app->getConf('member_avatar_max_size') . 'M';
            $max_size = utils::parse_str_size($max_conf); //byte
            if ($_FILES['avatar_file']['error']) {
                $this->splash('error', $redirect_here, '头像上传失败!' . $_FILES['avatar_file']['error']);
            }
            if ($bt_size > $max_size) {
                $this->splash('error', $redirect_here, '头像文件大小不能超过' . $max_conf);
            }
            list($w, $h, $t) = getimagesize($ready_tmp_file);
            if (!in_array($t, array(1, 2, 3, 6))) {
                //1 = GIF,2 = JPG，3 = PNG,6 = BMP
                $this->splash('error', $redirect_here, '文件类型错误');
            }
            $image_id = $mdl_image->store($_FILES['avatar_file']['tmp_name'], $this->member['avatar'], null, $image_name);
            logger::info('前台会员头像上传操作' . 'TMP_NAME:' . $_FILES['avatar_file']['tmp_name'] . ',FILE_NAME:' . $image_name);
            if (!$image_id) {
                $this->splash('error', $redirect_here, '头像上传失败!');
            }
            $mdl_image->rebuild($image_id, array('S', 'XS'));
            if ($this->app->model('members')->update(array('avatar' => $image_id), array('member_id' => $this->member['member_id']))) {
                $this->splash('success', $redirect_here, '上传并保存成功!');
            } else {
                $this->splash('error', $redirect_here, '保存失败!');
            }
        }
        $system_max = get_cfg_var("upload_max_filesize");
        $conf_max = $this->app->getConf('member_avatar_max_size') . 'M';
        if (utils::parse_str_size($conf_max) > utils::parse_str_size($system_max)) {
            $this->pagedata['upload_max'] = $system_max;
        } else {
            $this->pagedata['upload_max'] = $conf_max;
        }
        $this->output('', array('act' => 'setting'));
    }

    public function set_pam_uname($action = false)
    {
        $user_obj = vmc::singleton('b2c_user_object');
        $redirect_member_index = array('app' => 'b2c', 'ctl' => 'site_member');
        $redirect_here = array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'set_pam_uname');
        $pam_data = $user_obj->get_pam_data('*', $this->member['member_id']);
        if ($pam_data['local']) {
            $this->splash('success', $redirect_member_index, '已设置用户名');
        }
        if ($action == 'save') {
            $local_uname = $_POST['local_uname'];
            if (!vmc::singleton('b2c_user_passport')->set_local_uname($local_uname, $msg)) {
                $this->splash('error', $redirect_here, $msg);
            } else {
                $this->splash('success', $redirect_member_index, $msg);
            }
        }
        $this->pagedata['member'] = $this->member;
        $this->pagedata['pam_data'] = $pam_data;
        $pam_data_schema = app::get('pam')->model('members')->get_schema();
        $this->pagedata['pam_type'] = $pam_data_schema['columns']['login_type']['type'];
        $this->page('site/member/set_pam_local.html');
    }

    public function set_pam_mobile($action = false)
    {
        $user_obj = vmc::singleton('b2c_user_object');
        $redirect_member_index = array('app' => 'b2c', 'ctl' => 'site_member');
        $redirect_here = array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'set_pam_mobile');
        $pam_data = $user_obj->get_pam_data('*', $this->member['member_id']);
        unset($pam_data['memberData']);//2015/12/25
        if ($pam_data['mobile']) {
            $this->splash('success', $redirect_member_index, '已绑定手机');
        }
        if ($action == 'save') {
            $mobile = $_POST['mobile'];
            $vcode = $_POST['vcode'];
            if (!vmc::singleton('b2c_user_vcode')->verify($vcode, $mobile, 'signup')) {
                $this->splash('error', $redirect_here, '验证码不正确');
            }
            if (!vmc::singleton('b2c_user_passport')->set_mobile($mobile, $msg)) {
                $this->splash('error', $redirect_here, $msg);
            } else {
                $this->splash('success', $redirect_member_index, $msg);
            }
        }
        $this->pagedata['member'] = $this->member;
        $this->pagedata['pam_data'] = $pam_data;
        $pam_data_schema = app::get('pam')->model('members')->get_schema();
        $this->pagedata['pam_type'] = $pam_data_schema['columns']['login_type']['type'];
        $this->page('site/member/set_mobile.html');
    }

    public function set_pam_email($action = false)
    {
        $user_obj = vmc::singleton('b2c_user_object');
        $redirect_member_index = array('app' => 'b2c', 'ctl' => 'site_member');
        $redirect_here = array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'set_pam_email');
        $pam_data = $user_obj->get_pam_data('*', $this->member['member_id']);
        unset($pam_data['memberData']);//2015/12/25
        if ($pam_data['email']) {
            $this->splash('success', $redirect_member_index, '已绑定邮箱');
        }
        if ($action == 'save') {
            $email = $_POST['email'];
            $vcode = $_POST['vcode'];
            if (!vmc::singleton('b2c_user_vcode')->verify($email, $vcode, 'activation')) {
                $this->splash('error', $signup_url, '验证码不正确');
            }
            if (!vmc::singleton('b2c_user_passport')->set_email($email, $msg)) {
                $this->splash('error', $redirect_here, $msg);
            } else {
                $this->splash('success', $redirect_member_index, $msg);
            }
        }
        $this->pagedata['member'] = $this->member;
        $this->pagedata['pam_data'] = $pam_data;
        $pam_data_schema = app::get('pam')->model('members')->get_schema();
        $this->pagedata['pam_type'] = $pam_data_schema['columns']['login_type']['type'];
        $this->page('site/member/set_email.html');
    }

    public function active_pam_email($action = false)
    {
        if ($action == 'active') {
            $params = $_POST;
            if (!vmc::singleton('b2c_user_vcode')->verify($params['vcode'], $params['email'], 'reset')) {
                $this->splash('error', '', '验证码错误！');
            }
            $mdl_pm = app::get('pam')->model('members');
            $p_m = $mdl_pm->getRow('member_id,login_type', array('login_account' => $params['email']));
            if (empty($p_m['member_id']) || $p_m['login_type'] != 'email') {
                $this->splash('error', '', '账号异常!');
            }
            if ($mdl_pm->update(array('disabled' => 'false'), array('member_id' => $p_m['member_id'], 'login_type' => $p_m['login_type']))) {
                $this->splash('success', array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'securitycenter'), $params['email'] . '已成功激活!');
            } else {
                $this->splash('error', '', '激活异常!');
            }
        } else {
            $user_obj = vmc::singleton('b2c_user_object');
            $pam_data = $user_obj->get_pam_data('*', $this->member['member_id']);
            $this->pagedata['pam_data'] = $pam_data;
            $this->page('site/member/active_email.html');
            //$this->output();
        }
    }

    public function setting()
    {
        $this->menuSetting = 'setting';
        $this->pagedata['member_data'] = $this->app->model('members')->getRow('member_id, mobile, email', array('member_id' =>
            $this->member['member_id']));
        $this->output();
    }


    public function company()
    {
        $this->menuSetting = 'setting';
        $user_obj = vmc::singleton('b2c_user_object');
        $company = $user_obj->page_company();
        $manage = $user_obj->page_manage();
        $this->pagedata['extra'] = $company['info'];
        $this->pagedata['extra']['manageInfo'] = $manage['info']['manageInfo'];
        $this->pagedata['extra']['use'] = $manage['info']['use'];
        $this->pagedata['extra']['plant'] = $manage['info']['plant'];
        $this->pagedata['extra']['member_cat'] = $manage['info']['member_cat'];
        $this->output('', array('act' => 'setting'));
    }

    public function save_company()
    {
        if ($_POST) {
            $pageSetting = $this->app->getConf('member_extra_column');
            $obj_passport = vmc::singleton('b2c_user_passport');
            foreach ($pageSetting as $key => $val) {
                $_POST['pageIndex'] = $key + 1;
                $_POST['member_id'] = $this->member['member_id'];
                $result = $obj_passport->save_company($_POST);
                $redirect = $this->gen_url(array(
                    'app' => 'b2c',
                    'ctl' => 'site_member',
                    'act' => 'company',
                ));
                if (!$result) {
                    $this->splash('error', $redirect, '修改失败');
                }
            }
            $this->splash('success', $redirect, '修改成功');
        }
    }

    public function save_setting()
    {
        $url = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_member',
            'act' => 'setting',
        ));
        $member_model = $this->app->model('members');
        foreach ($_POST as $key => $val) {
            if (strpos($key, 'box:') !== false) {
                $aTmp = explode('box:', $key);
                $_POST[$aTmp[1]] = serialize($val);
            }
        }
        //--防止恶意修改
        $arr_colunm = array(
            'contact',
            'profile',
            'pam_account',
            'currency',
            'addon',
            'mobile',
            'email'
        );
        $attr = $this->app->model('member_attr')->getList('attr_column');
        foreach ($attr as $attr_colunm) {
            $colunm = $attr_colunm['attr_column'];
            $arr_colunm[] = $colunm;
        }
        foreach ($_POST as $post_key => $post_value) {
            if (!in_array($post_key, $arr_colunm)) {
                unset($_POST[$post_key]);
            }
        }
        //---end
        $_POST['member_id'] = $this->member['member_id'];

        if ($member_model->save($_POST)) {
            $this->splash('success', $url, ('保存成功'));
        } else {
            $this->splash('failed', $url, ('保存失败'));
        }
    }

    /**
     * 我的订单.
     */
    public function orders($status = 'all', $page = 1)
    {
        $mdl_order = $this->app->model('orders');
        $mdl_order_items = $this->app->model('order_items');
        $limit = 5;
        $status_filter = $mdl_order->status_filter();

        $this->pagedata['status'] = $status;
        $filter = $status_filter[$status];
        $obj_order_search = vmc::singleton('b2c_order_search');
        $search = $obj_order_search->search($_POST);
        $filter['member_id'] = $this->member['member_id'];
        if ($status == 's2') {
            $where = $search['sql'];
            $sql = "SELECT
* FROM
vmc_b2c_orders WHERE `member_id`={$this->member['member_id']} AND `status` = 'active' AND `confirm` = 'N' AND (`is_cod`='Y' OR
`pay_status`='1') {$where} AND `ship_status`='0' ORDER BY createtime desc LIMIT " . (($page - 1) * $limit) . ", {$limit}";
            $order_list = vmc::database()->select($sql);
        } else {
            $search['order_id|has'] && $filter['order_id|has'] = $search['order_id|has'];
            $search['order_id|in'] && $filter['order_id|in'] = $search['order_id|in'];
            $order_list = $mdl_order->getList('*', $filter, ($page - 1) * $limit, $limit);
        }
        $obj_store = vmc::singleton('store_store_object');
        $mdl_request_order = app::get('aftersales')->model('request');
        foreach ($order_list as $key => $value) {
            //所属店铺信息
            $store_info = $obj_store->store_info($value['store_id'], 'store_id, store_name');
            $order_list[$key]['store_name'] = $store_info['store_name'];
            //查看订单是否已申请退款、售后
            $result = $mdl_request_order->getRow('request_id, order_id', array('order_id' => $value['order_id']));
            $order_list[$key]['request'] = $result;
        }
        $oids = array_keys(utils::array_change_key($order_list, 'order_id'));
        $order_items = $mdl_order_items->getList('*', array(
            'order_id' => $oids,
        ));
        $order_items_group = utils::array_change_key($order_items, 'order_id', true);
        $order_count = $mdl_order->count($filter);
        $this->pagedata['search'] = $_POST['search'];
        $this->pagedata['type'] = 'orders';
        $this->pagedata['current_status'] = $status;
        $this->pagedata['status_map'] = $status_filter;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['order_count'] = $order_count;
        $this->pagedata['order_items_group'] = $order_items_group;
        $this->pagedata['pager'] = array(
            'total' => ceil($order_count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'b2c',
                'ctl' => 'site_member',
                'act' => 'orders',
                'args' => array(
                    $status,
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );
        $this->output();
    }

    //购买过的店铺
    public function buy_store()
    {
        $this->output();
    }

    //最近访问
    public function visit()
    {
        $this->output();
    }

    //我的足迹
    public function sleuth()
    {
        $current_time = time();
        $week = date('w', $current_time);

        //计算当天之后还要补几天加上当前天
        $after_day = $week == '0' ? 0 : 8 - $week;
        //计算日期要往前推多少天
        $week_num = date('w', $current_time - 30 * 86400);
        $before_day = $week_num == '0' ? 6 : $week_num - 1;
        $sum_day = $before_day + $after_day + 30;
        $days = array();
        for($i = 0; $i < $sum_day; $i++){
            $index = floor($i / 7);
            if($i > $before_day + 30){
                $time = $current_time + ($i - $before_day - 30) * 86400;
                $date = date('Y-m-d', $current_time - ($sum_day - $before_day - $i) * 86400);
                $week = date('w', $current_time - ($sum_day - $before_day - $i) * 86400);
            }else{
                $time = $current_time - ($sum_day - $after_day - $i) * 86400;
                $date = date('Y-m-d',$current_time - ($sum_day - $after_day - $i) * 86400);
                $week = date('w',$current_time - ($sum_day - $after_day - $i) * 86400);
            }
            $type = 'green';
            if($i <= $before_day || $i > $before_day + 30){
                $type = 'gray';
            }
            $days[$index][$i] = array(
                        'type' => $type,
                        'date' => $date,
                        'week' => $week,
                        'time' => $time,);
        }
        $this->pagedata['days'] = $days;
        $this->output();
    }

    public function date(){

    }

    //退货与维权
    public function refund()
    {
        $this->output();
    }

    /**
     * 我的收藏.
     */
    public function favorite($action = 'list', $gid = false, $obj_type = 'goods')
    {
        $this->set_tmpl('passport');
        $member_id = $this->member['member_id'];
        $mdl_member_goods = app::get('b2c')->model('member_goods');
        $redirect_here = array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'favorite');
        switch ($action) {
            case 'del':
                if (!$gid) {
                    $this->splash('error', $redirect_here, '删除收藏失败!');
                } else {
                    if ($mdl_member_goods->delete(array('member_id' => $member_id, 'goods_id' => $gid, 'type' => 'fav'))) {
                        $this->splash('success', $redirect_here, '删除成功!');
                    } else {
                        $this->splash('error', $redirect_here, '删除收藏失败!');
                    }
                }
                break;
            case 'add':
                if (!$mdl_member_goods->add_fav($member_id, $gid, $obj_type)) {

                    $this->splash('error', '', '加入收藏失败!');
                } else {
                    $this->splash('success', '', '加入收藏成功!');
                }
            default:
                $list_tmp = $mdl_member_goods->getList('*', array('member_id' => $member_id, 'type' => 'fav'));
                $mdl_goods = $this->app->model('goods');
                $this->pagedata['favorite_count'] = count($list_tmp);
                $list = array();
                foreach ($list_tmp as $key => &$value) {
                    if ($value['object_type'] == 'goods') {
                        $list['goods'][$key] = $value;
                        $list['goods'][$key]['store'] = $mdl_goods->getRow('store_id', array('goods_id' => $value['goods_id']));
                    } else {
                        $list['store'][$key] = $value;
                    }
                }
                $list['goods_count'] = count($list['goods']);
                $list['store_count'] = count($list['store']);
                unset($list_tmp);
                $this->pagedata['tag'] = app::get('desktop')->model('tag')->getList('tag_id, tag_name', array('member_id' => $this->member['member_id'], 'tag_mode' => 'favorite'));
                $this->pagedata['member_lv_name'] = $this->member['levelname'];
                $this->pagedata['member_lv_discount'] = $this->member['lv_discount'];
                $this->pagedata['data'] = $list;
                //$this->output();
                $this->page('site/member/action/favorite.html');
                break;
        }
    }

    //ajax添加收藏店铺的标签
    public function add_tag()
    {
        extract($_POST);
        if (empty($tagText) && !isset($tagText)) {
            $this->splash('error', '', '标签名称不能为空');
        }
        $mdl_tag = app::get('desktop')->model('tag');
        $data = array(
            'tag_name' => $tagText,
            'tag_mode' => 'favorite',
            'member_id' => $this->member['member_id'],
            'app_id' => 'b2c'
        );
        if ($tag_id = $mdl_tag->insert($data)) {
            $this->splash('success', '', $tag_id);
        }
        $this->splash('error', '', '添加失败');
    }

    //ajax添加取消店铺标签
    public function update_tag()
    {
        extract($_POST);
        if (!is_numeric($tagId) && empty($type)) {
            $this->splash('error', '', '非法请求');
        }
        $mdl_member_goods = $this->app->model('member_goods');
        $store_tag = $mdl_member_goods->getRow('tag', array('gnotify_id' => $favId));
        $tag_array = $store_tag['tag'] ? $store_tag['tag'] : array();
        $data['gnotify_id'] = $favId;
        if ($type == 'add') {
            $tag_array[$tagId] = $tagId;
            $data['tag'] = $tag_array;
        } else if ($type == 'del') {
            $tmp = array_flip($tag_array);
            unset($tmp[$tagId]);
            $data['tag'] = array_flip($tmp);
        }
        if ($mdl_member_goods->save($data)) {
            $this->splash('success', '', '操作成功');
        }
        $this->splash('error', '', '操作失败');
    }

    //ajax删除标签
    public function del_tag()
    {
        extract($_POST);
        $data = array('tag_id' => $tagId, 'member_id' => $this->member['member_id']);
        if (app::get('desktop')->model('tag')->delete($data)) {
            $this->splash('success', '', '操作成功');
        }
        $this->splash('error', '', '操作失败');
    }

    //店铺添加备注
    public function add_remark()
    {
        $data = array('gnotify_id' => $_POST['favId'], 'remark' => $_POST['value']);
        if ($this->app->model('member_goods')->save($data)) {
            $this->splash('success', '', '操作成功');
        }
        $this->splash('error', '', '操作失败');
    }

    /**
     * ajax检查商品、店铺收藏
     */
    public function check_favorite()
    {
        $member_api = vmc::singleton('b2c_source_member');
        $return = $member_api->favorite_read($_GET);
        if (empty($return)) {
            $this->splash('error', '', '没有收藏');
        } else {
            $this->splash('success', '', $return);
        }
    }

    /**
     * ajax浏览记录
     */
    public function scan_goods()
    {
        $member_api = vmc::singleton('b2c_source_member');
        if (empty($_POST['goods_id'])) return null;
        $data = array('goods_id' => $_POST['goods_id'], 'member_id' => $this->member['member_id'], 'type' => 'scan', 'status' => 'ready');
        $member_api->scan($data);
    }

    /**
     * 消息中心.
     */
    public function message($msg_id = 0, $page = 1)
    {
        $this->menuSetting = 'message';
        $limit = 10;
        $filter = array(
            'member_id' => $this->member['member_id'],
            'msg_type' => 'normal',
        );
        if ($msg_id > 0) {
            $filter['msg_id'] = $msg_id;
        }
        $mdl_member_msg = $this->app->model('member_msg');
        if (isset($filter['msg_id'])) {
            $msg = $mdl_member_msg->getRow('*', $filter);
            $mdl_member_msg->update(array('status' => 'received'), $filter);
            $this->pagedata['msg'] = $msg;
            return $this->display('site/member/action/message-detail.html');
        }
        $msg_list = $mdl_member_msg->getList('*', $filter, ($page - 1) * $limit, $limit);
        $msg_count = $mdl_member_msg->count($filter);
        $this->pagedata['msg_list'] = $msg_list;
        $this->pagedata['msg_count'] = $msg_count;
        $this->pagedata['pager'] = array(
            'total' => ceil($msg_count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'b2c',
                'ctl' => 'site_member',
                'act' => 'message',
                'args' => array(
                    $msg_id,
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );
        $this->output();
    }

    /*
     *会员中心收货地址
     * */
    public function receiver($action = 'list', $addr_id = false)
    {
        $this->menuSetting = 'setting';
        $this->pagedata['action'] = $action;
        $mdl_maddr = $this->app->model('member_addrs');
        $member_id = $this->member['member_id'];
        $redirect = array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'receiver');
        $this->pagedata['receiving'] = $this->app->getConf('receiving_time');
        switch ($action) {
            case 'set_default':
                if (!$mdl_maddr->set_default($addr_id, $member_id)) {
                    $this->splash('error', '', '设置失败');
                }
                $this->splash('success', $redirect, '设置成功');
                break;
            case 'delete':
                if (!$mdl_maddr->delete(array('member_id' => $member_id, 'addr_id' => $addr_id))) {
                    $this->splash('error', '', '删除失败');
                }
                $this->splash('success', $redirect, '删除成功');
                break;
            case 'edit':
                $this->pagedata['maddr'] = $mdl_maddr->getRow('*', array('member_id' => $member_id, 'addr_id' => $addr_id));
                $this->output();
                break;
            case 'save':
                $addr = $_POST['maddr'];
                $addr['member_id'] = $member_id;
                if (!$mdl_maddr->save($addr)) {
                    $this->splash('error', '', '保存失败');
                }
                $this->splash('success', $redirect, '保存成功');
                break;
            default:

                $this->pagedata['list'] = $mdl_maddr->getList('*', array('member_id' => $member_id));
                $this->output();
                break;
        }
    }

    /**
     *会员收货地址 购物流程快捷设置专用.
     */
    public function quick_maddr($action = 'list', $addr_id = false)
    {
        $this->pagedata['action'] = $action;
        $mdl_maddr = $this->app->model('member_addrs');
        $member_id = $this->member['member_id'];
        $redirect = array('app' => 'b2c', 'ctl' => 'site_member', 'act' => 'receiver');
        switch ($action) {
            case 'set_default':
                if (!$mdl_maddr->set_default($addr_id, $member_id)) {
                    $this->splash('error', '', '设置失败');
                }
                $this->splash('success', $redirect, '设置成功');
                break;
            case 'delete':
                if (!$mdl_maddr->delete(array('member_id' => $member_id, 'addr_id' => $addr_id))) {
                    $this->splash('error', '', '删除失败');
                }
                $this->splash('success', $redirect, '删除成功');
                break;
            case 'edit':
                $data = $mdl_maddr->getRow('*', array('member_id' => $member_id, 'addr_id' => $addr_id));
                unset($data['updatetime']);
                unset($data['day']);
                unset($data['time']);
                $this->splash('success', $redirect, $data);
                break;
            case 'save':
                $addr = $_POST['maddr'];
                $addr['member_id'] = $member_id;
                if (!$mdl_maddr->save($addr)) {
                    $this->splash('error', '', '保存失败');
                }
                $addr['area'] = vmc::singleton('base_view_helper')->modifier_region($addr['area']);
                $this->splash('success', $redirect, $addr);
                break;
        }
    }

    /**
     * 我的优惠券.
     */
    public function coupon($action = 'list')
    {
        $member_id = $this->member['member_id'];
        $this->pagedata['available_coupons'] = vmc::singleton('b2c_coupon_stage')->get_member_couponlist($member_id, $mycoupons);
        $this->pagedata['mycoupons'] = $mycoupons;
        $memc_code_arr = array();
        foreach ($mycoupons as $coupon) {
            $memc_code_arr[] = $coupon['memc_code'];
        }
        $couponlogs = $this->app->model('member_couponlog')->getList('*', array('member_id' => $member_id, 'memc_code' => $memc_code_arr));
        $this->pagedata['couponlogs'] = utils::array_change_key($couponlogs, 'memc_code');
        $this->output();
    }

    /**
     * 安全中心.
     */
    public function securitycenter()
    {
        $this->menuSetting = 'setting';
        $user_obj = vmc::singleton('b2c_user_object');
        $this->pagedata['pam_data'] = $user_obj->get_pam_data('*', $this->member['member_id']);
        $this->output();
    }

    /**
     * 增票资质.
     */
    public function ticket()
    {
        $this->menuSetting = 'setting';
        $user_obj = vmc::singleton('b2c_user_object');
        $this->pagedata['pam_data'] = $user_obj->get_pam_data('*', $this->member['member_id']);
        $this->output();
    }

    /**
     * 站内信.
     */
    /*public function sitemsg()
    {
        $this->menuSetting = 'message';
        $user_obj = vmc::singleton('b2c_user_object');
        $this->pagedata['pam_data'] = $user_obj->get_pam_data('*', $this->member['member_id']);
        $this->output();
    }

    public function sendmsg()
    {
        $this->menuSetting = 'message';
        $user_obj = vmc::singleton('b2c_user_object');
        $this->pagedata['pam_data'] = $user_obj->get_pam_data('*', $this->member['member_id']);
        $this->output();
    }*/

    /**
     * 我的积分概览
     */
    public function integral($page = 1)
    {
        $limit = 20;
        $mdl_mintegral = app::get('b2c')->model('member_integral');
        $filter = array(
            'member_id' => $this->member['member_id']
        );
        $count = $mdl_mintegral->count($filter);
        $this->pagedata['integral_list'] = $mdl_mintegral->getList('*', $filter, ($page - 1) * $limit, $limit);
        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'b2c',
                'ctl' => 'site_member',
                'act' => 'integral',
                'args' => array(
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );
        $this->output();
    }

    /**
     * 我的冻品管家
     */
    public function freeze()
    {
        $member_id = $this->member['member_id'];
        $mdl_freeze_member = app::get('freeze')->model('freeze_member');
        $mdl_freeze = app::get('freeze')->model('freeze');
        $freeze = $mdl_freeze_member->getRow('*',array('member_id'=>$member_id));
        $freeze_list = $mdl_freeze->getList('*');

        $this->pagedata['freeze_list'] = $freeze_list;
        $this->pagedata['freeze'] = $freeze;
        $this->output();
    }

    /**
     * 管家列表
     */
    public function freeze_list()
    {
        $this->set_tmpl('default');
        $this->page('site/member/action/freeze_list.html');
    }






}