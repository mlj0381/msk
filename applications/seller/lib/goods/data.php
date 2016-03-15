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
class seller_goods_data
{
    public function __construct()
    {
        $this->mdl_goods = app::get('b2c')->model('goods');
        $this->mdl_products = app::get('b2c')->model('products');
        $this->mdl_gtype = app::get('b2c')->model('goods_type');
    }
    public function prepare_goods_data(&$data)
    {
        $last_goods = $this->mdl_goods->getRow('goods_id', null, 0, 1, 'goods_id desc');
        $last_goods_id = $last_goods['goods_id'];
        $goods = $data['goods'];
        $goods['agent'] = $data['agent'];
        //相册默认图
        if (is_array($goods['images'])) {
            $goods['image_default_id'] = $data['image_default'];
        } else {
            $goods['image_default_id'] = null;
        }
        foreach ($goods['product'] as $key => $value) {
            if($value['marketable'] == 'true'){
                $goods['marketable'] = 'true';
                break;
            }
        }
        if (isset($goods['spec_desc']) && isset($goods['spec_desc']['v']) && is_array($goods['spec_desc']['v'])) {
            foreach ($goods['spec_desc']['v'] as $key => $value) {
                if (is_array($goods['spec_desc']['vplus']) && $goods['spec_desc']['vplus'][$key]) {
                    $goods['spec_desc']['v'][$key] .= ','.$goods['spec_desc']['vplus'][$key];
                    unset($goods['spec_desc']['vplus'][$key]);
                }
            }
            //去除空规格值
            if(isset($goods['spec_desc']['t'])){
                foreach ($goods['spec_desc']['t'] as $key => $value) {
                    if(trim($value) == ''){
                        unset($goods['spec_desc']['t'][$key]);
                        unset($goods['spec_desc']['v'][$key]);
                    }
                }
            }
            if(isset($goods['spec_desc']['v'])){
                foreach ($goods['spec_desc']['v'] as $key => $value) {
                    if(trim($value) == ''){
                        unset($goods['spec_desc']['t'][$key]);
                        unset($goods['spec_desc']['v'][$key]);
                    }
                }
            }
        }
        if(empty($goods['spec_desc']) || empty($goods['spec_desc']['v']) ||empty($goods['spec_desc']['t'])){
            // || count($goods['product'])<2
            $goods['spec_desc'] = null;
        }
        //关键词
        if ($data['keywords']) {
            foreach (explode(',', $data['keywords']) as $keyword) {
                $goods['keywords'][] = array(
                    'keyword' => $keyword,
                    'res_type' => 'goods',
                );
            }
        }else{
            $goods['keywords'] = array();
        }
        if ($goods['params']) {
            $g_params = array();
            foreach ($goods['params'] as $gpk => $gpv) {
                $g_params[$data['goodsParams']['group'][$gpk]][$data['goodsParams']['item'][$gpk]] = $gpv;
            }
            $goods['params'] = $g_params;
        }
        if (!$goods['min_buy']) {
            unset($goods['min_buy']);
        }
        if (!$goods['brand']['brand_id']) {
            $goods['brand']['brand_id'] = null;
        }
        $images = array();
        foreach ((array) $goods['images'] as $imageId) {
            $images[] = array(
                'target_type' => 'goods',
                'image_id' => $imageId,
            );
        }
        $goods['images'] = $images;
        unset($images);
        if($goods['default_product']){
            foreach ($goods['product'] as $key=>$product) {
                if($key == $goods['default_product']){
                    $goods['product'][$key]['is_default'] = 'true';
                }else{
                    $goods['product'][$key]['is_default'] = 'false';
                }
            }
        }else{
            $goods['product'][key((array) $goods['product']) ]['is_default'] = 'true';
        }
        foreach ($goods['product'] as $prok => $pro) {
            if ($goods['unit']) {
                $goods['product'][$prok]['unit'] = $goods['unit'];
            }
            if (!$pro['product_id'] || substr($pro['product_id'], 0, 4) == 'new') {
                unset($goods['product'][$prok]['product_id']);
            }
            if (!$pro['marketable']) {
                $goods['product'][$prok]['marketable'] = 'false';
            }
            $goods['product'][$prok]['price'] = trim($goods['product'][$prok]['price']);
            $goods['product'][$prok]['image_id'] = $goods['image_default_id'];
            $goods['product'][$prok]['mktprice'] = trim($goods['product'][$prok]['mktprice']);
        }
        if (is_array($data['linkid'])) {
            foreach ($data['linkid'] as $k => $id) {
                if (!empty($goods['goods_id'])) {
                    $last_goods_id = $goods['goods_id'];
                } else {
                    $last_goods_id = intval($last_goods_id) + 1;
                }
                $link_arr[] = array(
                    'goods_1' => $last_goods_id,
                    'goods_2' => $id,
                    'manual' => $data['linktype'][$id],
                    'rate' => 100,
                );
            }
            $goods['rate'] = $link_arr;
        }
        if (!$goods['category']['cat_id']) {
            $goods['category']['cat_id'] = 0;
        }
        if (!$goods['tag']) {
            $goods['tag'] = array();
        }
        if (!$goods['rate']) {
            $goods['rate'] = array();
        }
        if ($goods['gain_score'] === '') {
            $goods['gain_score'] = null;
        }
        if ($goods['props']) {
            foreach ($goods['props'] as $pk => $pv) {
                if (substr($pk, 2) <= 20 && $pv['value'] === '') {
                    $goods['props'][$pk]['value'] = null;
                }
            }
        }
        foreach ($goods['product'] as $k => $v) {
            if (!$k && $k !== 0) {
                unset($goods['product'][$k]);
            }
            if (empty($goods['product'][$k]['weight'])) {
                $goods['product'][$k]['weight'] = 0;
            }
            if (empty($goods['product'][$k]['mktprice'])) {
                $goods['product'][$k]['mktprice'] = 0;
            }
        }
        if (!$goods['marketable']) {
            $goods['marketable'] = 'false';
        }
        return $goods;
    }

    public function checkin(&$goods){
        if (!empty($goods['gid']) && $this->mdl_goods->count(array(
            'gid' => $goods['gid'],
            'goods_id|notin' => $goods['goods_id'],
        )) > 0) {
            return ('重复的商品ID'.$goods['gid']);
        }
        if (empty($goods['product']) || count($goods['product']) == 0) {
            return '货品信息未填写完整';
        }
        if (!$goods['name']) {
            return ('商品名称不能为空');
        }
        //验证
        foreach ($goods['product'] as $k => $p) {
            if (empty($p['bn'])) {
                return ('货号未填写');
            }
            if (!empty($p['price']) && !is_numeric($p['price'])) {
                return ($p['bn'].'销售价填写有误');
            }
            if (!empty($p['mktprice']) && !is_numeric($p['mktprice'])) {
                return ($p['bn'].'市场价填写有误');
            }
            if ($this->mdl_products->count(array(
                'bn' => $p['bn'],
                'goods_id|notin' => $goods['goods_id'],
            )) > 0) {
                return ('重复的货号：'.$p['bn']);
            }
            if ($p['barcode'] && $this->mdl_products->count(array(
                'barcode' => $p['barcode'],
                'goods_id|notin' => $goods['goods_id'],
            )) > 0) {
                return ('重复的条码：'.$p['barcode']);
            }
        }
        foreach ($goods['extsplashed_cat'] as $k=>$v) {
            if(!$v || $v<0){
                unset($goods['extsplashed_cat'][$k]);
            }
        }
        $this->mdl_goods->has_many['product'] = 'products:contrast';
        
    }
}