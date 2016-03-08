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
// 
// interface

class seller_goods_module {

    private $goods_id = '';
    private $brand = 0;
    private $gid = 0;
    private $name = '';
    private $brief;
    private $images = Array();
    private $origin = 0;
    private $type_id = 0;
    private $spec_desc = Array();
    private $product = Array();
    private $description = '';
    private $marketable = false;
    private $showcase = 0;
    private $unit = '';
    private $image_default_id = '';
    private $keywords = Array();
    private $image_default = '';
    private $category = 0;
    private $tag = array();
    private $rate = array();
    private $gain_score = null;

    // 初始
    public function &init(Array &$params) {
        foreach ($params as $key => $item) {
            if (isset($this->$key))
                $this->$key = $item;
        }
//        $methods = get_class_methods(__CLASS__);
//        foreach ($methods as $func) {
//            $this->$func();
//        }
        return $this;
    }

    // 相册
    private function _photo() {
        is_array($this->images) && $this->image_default_id = $this->image_default;
    }

    // product
    private function _marketable() {
        foreach ($this->product as $item) {
            if ($item['marketable'] == 'true') {
                $this->marketable = true;
                return;
            }
        }
    }

    private function _spec() {
        //去除空规格值
        if (isset($this->spec_desc['t'])) {
            foreach ($this->spec_desc['t'] as $key => $value) {
                if (trim($value) == '') {
                    unset($this->spec_desc['t'][$key], $this->spec_desc['v'][$key], $this->spec_desc['vplus'][$key]);
                }
            }
        }
        if (isset($this->spec_desc['v'])) {
            foreach ($this->spec_desc['v'] as $key => &$value) {
                if (trim($value) == '') {
                    unset($this->spec_desc['t'][$key], $this->spec_desc['v'][$key], $this->spec_desc['vplus'][$key]);
                    continue;
                }
                if (!is_array($this->spec_desc['vplus']))
                    continue;
                if ($this->spec_desc['vplus'][$key])
                    $v .= "," . $this->spec_desc['vplus'][$key];
                unset($this->spec_desc['vplus'][$key]);
            }
        }
        if (empty($this->spec_desc) || empty($this->spec_desc['v']) || empty($this->spec_desc['t']) || count($this->product) < 2) {
            $this->spec_desc = null;
        }
    }

    //关键词
    private function _keywords() {
        if (!$this->keywords)
            return;
        $keywords = explode(',', $this->keywords);
        array_walk($keywords, function(&$v, $k) {
            $v = array(
                'keyword' => $v,
                'res_type' => 'goods',
            );
        });
    }

    private function _params() {
        if (!$this->params)
            return;
        $result = Array();
        foreach ($this->params as $key => $value) {
            $group = $this->goodsParams['group'][$key];
            $group_item = $this->goodsParams['item'][$key];
            $result[$group[$group_item]] = $value;
        }
        $this->params = $result;
    }

    public function _min_buy() {
        if (!$this->min_buy) {
            unset($this->min_buy);
        }
    }

    private function _brand() {
        if (empty($this->brand['brand_id'])) {
            $this->brand['brand_id'] = null;
        }
    }

    private function _image() {
        array_walk($this->images, function(&$v, $k) {
            $v = array(
                'image_id' => $v,
                'target_type' => 'goods',
            );
        });
    }

    private function _product() {
        if (!$this->default_product) {
            $products = $this->product;
            $this->default_product = key(array_shift($products));
        }
        foreach ($this->product as $key => &$item) {
            $item['is_default'] = 'false';
            $key == $this->default_product && $item['is_default'] = 'true';
//            if ($this->unit) {
//                $this->product[$prok]['unit'] = $this->unit;
//            }
            empty($item['marketable']) && $item['marketable'] = 'false';
            if (!$item['product_id'] || substr($item['product_id'], 0, 4) == 'new') {
                unset($item['product_id']);
            }
            $item['price'] = trim($item['price']);
            $item['mktprice'] = !empty($item['mktprice']) ? trim($item['mktprice']) : 0;
            empty($item['weight']) && $item['weight'] = 0;
            //strpos($value['product_id'], 'new');
        }
    }

    //相关商品
//    private function _link_goods() {
//        $last_goods_id = vmc::database()->lastinsertid();
//
//        if (is_array($this->linkid)) {
//            foreach ($this->linkid as $id) {
//                if (!empty($this->goods_id)) {
//                    $last_goods_id = $this->goods_id;
//                } else {
//                    $last_goods_id = intval($last_goods_id) + 1;
//                }
//                $link_arr[] = array(
//                    'goods_1' => $last_goods_id,
//                    'goods_2' => $id,
//                    'manual' => $this->linktype[$id],
//                    'rate' => 100,
//                );
//            }
//            unset($this->linkid);
//            unset($this->linktype);
//            $this->rate = $link_arr;
//        }
//    }
//
//    public function prepare_goods_data(&$data) {
//
//        if (!$this->category['cat_id']) {
//            $this->category['cat_id'] = 0;
//        }
//        if (!$this->tag) {
//            $this->tag = array();
//        }
//
//        if (!$this->rate) {
//            $this->rate = array();
//        }
//        if ($this->gain_score === '') {
//            $this->gain_score = null;
//        }
//        if ($this->props) {
//            foreach ($this->props as $pk => $pv) {
//                if (substr($pk, 2) <= 20 && $pv['value'] === '') {
//                    $this->props[$pk]['value'] = null;
//                }
//            }
//        }
//
//        return $goods;
//    }
//
//    public function checkin(&$goods) {
//        if (!empty($this->gid) && $this->mdl_goods->count(array(
//                    'gid' => $this->gid,
//                    'goods_id|notin' => $this->goods_id,
//                )) > 0) {
//            return ('重复的商品ID' . $this->gid);
//        }
//
//        if (empty($this->product) || count($this->product) == 0) {
//            return '货品信息未填写完整';
//        }
//        if (!$this->name) {
//            return ('商品名称不能为空');
//        }
//
//        //验证
//        foreach ($this->product as $k => $p) {
//            if (empty($p['bn'])) {
//                return ('货号未填写');
//            }
//            if (!empty($p['price']) && !is_numeric($p['price'])) {
//                return ($p['bn'] . '销售价填写有误');
//            }
//            if (!empty($p['mktprice']) && !is_numeric($p['mktprice'])) {
//                return ($p['bn'] . '市场价填写有误');
//            }
//            if ($this->mdl_products->count(array(
//                        'bn' => $p['bn'],
//                        'goods_id|notin' => $this->goods_id,
//                    )) > 0) {
//                return ('重复的货号：' . $p['bn']);
//            }
//            if ($p['barcode'] && $this->mdl_products->count(array(
//                        'barcode' => $p['barcode'],
//                        'goods_id|notin' => $this->goods_id,
//                    )) > 0) {
//                return ('重复的条码：' . $p['barcode']);
//            }
//        }
//
//        foreach ($this->extsplashed_cat as $k => $v) {
//            if (!$v || $v < 0) {
//                unset($this->extsplashed_cat[$k]);
//            }
//        }
//        $this->mdl_goods->has_many['product'] = 'products:contrast';
//    }

}
