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
class b2c_source_member extends base_source {

    protected $host = 'http://localhost/mskapi/goods.php';
    protected $params = array();
    protected $method = 'post';
    protected $schema = 'http';
    protected $path = '';
    private $args = array(
        'label' => '',
        'num' => '',
        'addr' => '',
    );

    public function __construct($app) {
        $this->app = $app;
        $this->params = array(
            'app' => $this->app,
            'method' => $this->method,
            'schema' => $this->schema,
            'host' => $this->host,
        );
    }

    /*
     * 基本信息修改
     * @param $params array()
     * return true/false
     */

    public function edit_info($params) {
        
    }
    
    /*
     * 修改、找回密码
     * @param $params array()
     * return true/alse
     */

    public function edit_pwd($params) {
        
    }
    
    /*
     * 加入收藏
     * @param $params array()
     * return true/false
     */

    public function favorites_add($params) {
        
    }

    /*
     * 查看我的收藏
     * @param $params array()
     * return array() list
     */

    public function favorite_read($params) {
        $params['member_id'] = $params['member_id'] ? $params['member_id'] : vmc::singleton('b2c_user_object')->get_member_id();
        $mdl_member_goods = app::get('b2c')->model('member_goods');
        $return['goods'] = $mdl_member_goods->getRow('goods_id', array('member_id' => $params['member_id'], 'goods_id' => $params['goods_id'], 'type' => 'fav', 'object_type' => 'goods'));
        $return['store'] = $mdl_member_goods->getRow('goods_id', array('member_id' => $params['member_id'], 'goods_id' => $params['store_id'], 'type' => 'fav', 'object_type' => 'store'));
        $store['store_id'] = $return['store']['goods_id'];
        return array_merge($store, $return['goods']);
    }

    /*
     * 删除我的收藏
     * @param $params array()
     * return true/false
     */

    public function favorite_del($params) {
        
    }

    /*
     * 最近访问 商品/店铺
     * @param $params array()
     * return $data 商品/店铺
     */

    public function lately_visit($params) {
        
    }
    
    /*
     * 首页基础数据，我的收藏
     * @params $params member_id
     * return array() List    
     */

    public function basic($params) {
        return $this->favorite_read($params);
    }
}
