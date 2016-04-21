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


class b2c_mdl_goods extends dbeav_model
{
    public $has_tag = true;
    public $defaultOrder = array(
        'w_order DESC,goods_id DESC',
    );
    public $has_many = array(
        'product' => 'products:append',
        'rate' => 'goods_rate:replace:goods_id^goods_1',
        'keywords' => 'goods_keywords:replace',
        'images' => 'image_attach@image:contrast:goods_id^target_id',
        'tag' => 'tag_rel@desktop:replace:goods_id^rel_id',
    );
    public $has_one = array();
    public $subSdf = array(
        'goods_list' => array(
            'product' => array(
                'price',
                'marketable',
                'product_id',
            ),
        ),
        'default' => array(
            'tag' => array(
                'tag_id',
            ),
            'keywords' => array(
                'keyword',
            ) ,
            'product' => array(
                '*',
            ) ,
            ':goods_type' => array(
                'type_id,name',
            ) ,
            ':goods_cat' => array(
                'cat_id,cat_name',
            ) ,
            ':brand' => array(
                'brand_id,brand_name,brand_logo,brand_country',
            ) ,
            'images' => array(
                'image_id',
            ),
        ) ,
        'delete' => array(
            'keywords' => array(
                '*',
            ) ,
            'product' => array(
                '*',
            ) ,
            'images' => array(
                '*',
            ),
        ),

    );
    public function __construct($app)
    {
        parent::__construct($app);
        //使用meta系统
        $this->use_meta();


    }
    //重写goods filter
    public function _filter($filter, $tbase = '', $baseWhere = null)
    {
        if($filter['_ignore_filterextend_']){
            unset($filter['_ignore_filterextend_']);
            return parent::_filter($filter);
        }
        $filter = vmc::singleton('b2c_goods_filter')->goods_filter($filter, $this);
        return parent::_filter($filter);
    }
    /**
     * 轻量级 getList 方法，绕开复杂filter
     */
    public function lw_getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null){
        $filter['_ignore_filterextend_'] = 'true';
        return parent::getList($cols,$filter,$offset,$limit,$orderType);
    }

    public function save(&$goods, $mustUpdate = null, $mustInsert = false)
    {
        //随机商品管理ID
        $rand_gid = 'v'.str_pad(substr(preg_replace('/[a-z]|4/', '', uniqid()), -6), 8, rand(10, 99), STR_PAD_BOTH);
        if (!$goods['gid']) {
            $goods['gid'] = $rand_gid;
        }
        is_array($goods['product']) or $goods['product'] = array();
        foreach ($goods['product'] as $pk => $pv) {
            if ($goods['goods_type']) { //product add goods_type default normal
            $goods['product'][$pk]['goods_type'] = $goods['goods_type'];
            }
            //随机货号
            if (!$pv['bn']) {
                $goods['product'][$pk]['bn'] = 'bn'.str_pad(preg_replace('/[a-z]/', '', substr(uniqid(), -5)), 7, time(), STR_PAD_BOTH);
            }
            $goods['product'][$pk]['name'] = $goods['name'];
        }
        #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录编辑商品日志-start@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        if ($obj_operatorlogs = vmc::service('operatorlog.goods')) {
            $addorrestore_goods_flag = false;
            if (empty($goods['goods_id'])) { //添加商品则为空
                $addorrestore_goods_flag = true;
                if (method_exists($obj_operatorlogs, 'new_goods')) {
                    $obj_operatorlogs->new_goods($goods['name']);
                }
            } else { //回收站恢复商品时判断
                $isindb = $this->getList('goods_id', array(
                    'goods_id' => $goods['goods_id'],
                ));
                if (!$isindb['0']['goods_id']) {
                    $addorrestore_goods_flag = true;
                }
            }
            if (isset($addorrestore_goods_flag) && !$addorrestore_goods_flag) {
                $olddata = app::get('b2c')->model('goods')->dump($goods['goods_id'], '*', 'default');
            }
        }
        #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录编辑商品日志-end@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        $rs = parent::save($goods, $mustUpdate);
        #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录编辑商品日志-start@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        
        if ($obj_operatorlogs = vmc::service('operatorlog.goods')) {
            if (method_exists($obj_operatorlogs, 'goods_log')) {
                if (isset($addorrestore_goods_flag) && !$addorrestore_goods_flag) {
                    $newdata = app::get('b2c')->model('goods')->dump($goods['goods_id'], '*', 'default');
                    $obj_operatorlogs->goods_log($newdata, $olddata);
                }
            }
        }
        #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录编辑商品日志-end@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

        if($rs){
            //商品保存成功时执行
            foreach (vmc::servicelist('b2c.goods.save') as $object) {
                if (method_exists($object, 'exec')) {
                    $object->exec($goods);
                }
            }
        }
        return $rs;
    }
    public function delete($filter, $subSdf = 'delete')
    {
        $rs = parent::delete($filter, $subSdf);
        if($rs){
            //商品删除成功时执行
            foreach (vmc::servicelist('b2c.goods.delete') as $object) {
                if (method_exists($object, 'exec')) {
                    $object->exec($filter);
                }
            }
        }
        return $rs;
    }

    public function getPath($gid, $method = null)
    {
        $row = $this->getRow('cat_id,name', array(
            'goods_id' => $gid,
        ));
        $ret = $this->app->model('goods_cat')->getPath($row['cat_id'], $method);
        $ret[] = array(
            'type' => 'goods',
            'title' => $row['name'],
        );

        return $ret;
    }

    public function getLinkList($goods_id)
    {
        return $this->db->select('SELECT r.*, goods_id, gid, name FROM vmc_b2c_goods_rate r, vmc_b2c_goods
                WHERE ((goods_2 = goods_id AND goods_1='.intval($goods_id).') OR (goods_1 = goods_id AND goods_2 = '.intval($goods_id).' AND manual=\'both\')) AND rate > 99');
    }

    public function searchOptions()
    {
        $arr = parent::searchOptions();
        $arr = array_merge($arr, array(
            'bn|has' => ('货号'),
            'keyword' => ('商品关键字'),
            'barcode|has' => ('条码'),
        ));

        return $arr;
    }
    public function pre_restore(&$data, $restore_type = 'add')
    {
        if ($restore_type == 'add') {
            if ($this->checkProductBn($data['bn'])) {
                $data['bn'] = '';
            }
            foreach ($data['product'] as $k => $p) {
                if ($this->checkProductBn($p['bn'])) {
                    $data['product'][$k]['bn'] = '';
                }
            }
        }
        if ($restore_type == 'none') {
            if ($this->checkProductBn($data['bn'])) {
                return false;
            }
            foreach ($data['product'] as $k => $p) {
                if ($this->checkProductBn($p['bn'])) {
                    return false;
                }
            }
        }
        $data['need_delete'] = true;

        return true;
    }


    public function pre_recycle($rows)
    {
        $this->recycle_msg = '删除成功!';
        $gids = array_keys(utils::array_change_key($rows, 'goods_id'));
        $order_items = app::get('b2c')->model('order_items')->getList('*', array('goods_id' => $gids));
        if($order_items){
            $order_id = array_keys(utils::array_change_key($order_items, 'order_id'));
            if (app::get('b2c')->model('orders')->count(array('status' => 'active', 'order_id' => $order_id))) {
                $this->recycle_msg = '活动订单：'.implode(',', $order_id).'包含要删除的商品!请先完成或作废订单.';

                return false;
            }
        }
        return true;
    }

    /**
     *
     */
     public function get_spec_history(){
         $spec_desc = $this->getList('spec_desc',array('spec_desc|notin'=>array(null,NULL,'null','NULL')));
         return $spec_desc;
     }

     public function response_goods($params)
     {
         $b2c_api = vmc::singleton('b2c_source_goods');
         if(method_exists($b2c_api, 'request_params')){
             return $b2c_api->request($params);
         }else{
             //没定义接口调用本地数据
         }
     }

    /**
     * 根据选择的当前档案卡id筛选相应的档案卡信息
     * @param $type
     * @param $cat_id
     * @return array
     */
    public function &fileCard($type, $cat)
    {
        $card = array(
            'apt_stock' => 'card_pd_mat',//原料种源信息同步
            'apt_prove' => 'card_pd_org',//原种种源标准指标
            'apt_raise' => 'card_pd_fed',//原种饲养标准指标
            'apt_technology' => 'card_pd_mct',//产品加工技术标准指标
            'apt_quality' => 'card_pd_tnc',//产品加工质量标准指标
            'apt_common' => 'card_pd_gnq',//产品通用质量标准指标
            'apt_safety' => 'card_pd_sft',//产品安全标准指标
            'apt_transport' => 'card_pd_tsp',//储存运输标准指标
        );
        $result = Array();
        if(array_key_exists($type, $card))
        {
            $result = app::get('seller')->rpc($card[$type])->request(array(1), '604800');//一星期
        }		
        $cat_id = explode('-', $cat); //01-1-01 分类编码组合 一级 - 二级 - 三级
        foreach($result['result']['searchList'] as $value)
        {
			if(!$value['breedCode']) $cat_id[2] = ''; //原料种源信息同步 特征没返回
            if($value['classesCode'] == $cat_id[0] && $value['machiningCode'] == $cat_id[1] && $value['breedCode'] == $cat_id[2])
            {
                return $value;
            }
        }
    }
}
