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

/**
 *  挂件处理
 */
class b2c_view_widget {

    /**
     * 分类挂件
     */
    public function function_WIDGET_B2C_GOODS_CAT($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        // $render->pagedata['category_tree'] = vmc::service('view_datasetting')->good_cat($params);
        $mdl_goods_cat = app::get('b2c')->model('goods_cat');
        $tree = $mdl_goods_cat->get_tree();
        foreach ($tree as &$value) {
            $value['son'] = $mdl_goods_cat->children($value['cat_id']);
        }
        $render->pagedata['category_tree'] = $tree;
        return $render->fetch('widget/category.html');
    }

    public function function_WIDGET_RECOME($params, &$smarty) {
        extract($params);
        $tpl = empty($tpl) ? 'image' : $tpl; // 0普通 1、幻灯 2 商品
        $page = empty($page) ? 'index' : $page;
        $position_id = empty($position) ? 0 : $position;
        $render->pagedata['contents'] = app::get('b2c')->model('pages_content')->getlist("*", compact('position_id'));
        return $render->fetch("widget/{$tpl}.html");
    }

    // Nav
    public function function_WIDGET_B2C_PUBLIC_NAV($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['nva'] = app::get('b2c')->model('setting')->get_nav();
        return $render->fetch('widget/nav.html');
    }

    // 首页-幻灯
    public function function_WIDGET_B2C_INDEX_SLIDER($params, &$smarty) {
        $render = new base_render(app::get($params['app']));
        //$render->pagedata['slider'] = app::get('b2c')->model('ad')->getList('*', array('page_id' => 34, 'ad_type' => 1, 'status' => 'true',));
       $render->pagedata['contents']= app::get('b2c')->model('pages_content')->getList('*', array('type' => '1', 'status' => '1',));
        return $render->fetch('widget/slider.html');
    }

    // 首页-好评商品
    public function function_WIDGET_B2C_GOODS_INDEX_GOOD_COMMENT($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        return $render->fetch('widget/good.comment.html');
    }

    //所在城市
    public function function_WIDGET_B2C_INDEX_CITY($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['city'] = vmc::service('view_datasetting')->city();
        return $render->fetch('widget/b2c.city.html');
    }

    //楼层左侧推荐
    public function function_WIDGET_B2C_INDEX_LEFT_GOOD($params, &$smaryt) {
        $render = new base_render(app::get($params['app']));
        $render->pagedata['position_id'] = $params['position_id'];
        //$render->pagedata['floor_left'] = vmc::service('view_datasetting')->floor_left($params);
        $render->pagedata['contents'] = app::get('b2c')->model('pages_content')->getList('*', array('type' => '2', 'status' => '1', 'position_id'=>$params['position_id'],));
        return $render->fetch('widget/index_left_good.html');
    }

    //楼层店铺
    public function function_WIDGET_B2C_GOODS_INDEX_SHOP_SHOW($params, &$smaryt) {
        $render = new base_render(app::get('b2c'));
        //$render->pagedata['store'] = app::get('b2c')->model('ad')->ad_shop();
        return $render->fetch('widget/index.shop.show.html');
    }

    // 首页-楼层
    public function function_WIDGET_B2C_GOODS_INDEX_GOOD_FLOOR($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['num'] = $params['num'];
        $render->pagedata['position_id'] = $params['position_id'];
        //$render->pagedata['goods'] = vmc::service('view_datasetting')->floor($params);
         $render->pagedata['contents'] = app::get('b2c')->model('pages_content')->getList('*', array('type' => '2','position_id'=>$params['position_id'],));
        return $render->fetch('widget/good.floor.html');
    }

    //网站导航
    public function function_WIDGET_B2C_GOODS_INDEX_WEB_NAV($params, &$smaryt) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['web_nav'] = vmc::service('view_datasetting')->web_nav($params);
        return $render->fetch('widget/web.nav.html');
    }

    //商品筛选
    public function function_WIDGET_B2C_GOODS_LIST_FILTER($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        $conf = app::get('b2c')->getConf('serach');
        switch ($params['target']) {
            case 'brand':
                $tmp = app::get('b2c')->model($params['target'])->getList('brand_id, brand_name');
                foreach ($tmp as $key => $value) {
                    $render->pagedata['filter']['items'][$key]['id'] = $value['brand_id'];
                    $render->pagedata['filter']['items'][$key]['name'] = $value['brand_name'];
                }
                break;
            case 'price':
                $render->pagedata['filter']['items'] = $conf['price'];
                break;
            case 'norms':
                $render->pagedata['filter']['items'] = $conf['norms'];
                break;
            case 'ability':
                $render->pagedata['filter']['items'] = $conf['ability'];
                break;
        }
        $render->pagedata['filter']['type'] = $params['target'];
        $render->pagedata['filter']['filter'] = $params['filter'];
        return $render->fetch('widget/list.filter.html');
    }

    //网站底部内容管理
    public function function_WIDGET_B2C_GOODS_INDEX_FOOTER($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['content'] = vmc::service('view_datasetting')->index_footer($params);
        return $render->fetch('widget/index.footer.html');
    }

    //获取基础数据
    public function function_WIDGET_B2C_INDEX_HEADER_BASIC($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['basic'] = vmc::service('view_datasetting')->basic($params);
        $render->pagedata['keywords'] = $params['keywords'];
        $render->pagedata['type'] = $params['type'];
        return $render->fetch('widget/index.header.basic.html');
    }

    //获取首页頂部广告
    public function function_WIDGET_B2C_INDEX_TOP_ADVERTISING($params, &$smaryt) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['advertising'] = vmc::service('view_datasetting')->advertising($params);
        return $render->fetch('widget/advertising/index.top.html');
    }

    //获取首页樓層广告
    public function function_WIDGET_B2C_INDEX_FLOOR_ADVERTISING($params, &$smaryt) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['advertising'] = vmc::service('view_datasetting')->advertising($params);
        return $render->fetch('widget/advertising/index.floor.html');
    }

    //获取首页橱窗广告
    public function function_WIDGET_B2C_INDEX_SHOWCASE_ADVERTISING($params, &$smaryt) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['advertising'] = vmc::service('view_datasetting')->advertising($params);
        return $render->fetch('widget/advertising/index.showcase.html');
    }

    //获取店铺橱窗广告
    public function function_WIDGET_STORE_INDEX_SHOWCASE_ADVERTISING($params, &$smaryt) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['advertising'] = vmc::service('view_datasetting')->advertising($params);
        return $render->fetch('widget/advertising/store.showcase.html');
    }

    //获取登录左侧广告
    public function function_WIDGET_B2C_LOGIN_ADVERTISING($params, &$smaryt) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['advertising'] = vmc::service('view_datasetting')->advertising($params);
        return $render->fetch('widget/advertising/login.left.html');
    }

    //我的收藏
    public function function_WIDGET_B2C_FAVORITE($params, &$smarty) {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['advertising'] = vmc::service('b2c_source_member')->favorite_read($params);
        return $render->fetch('widget/advertising/login.left.html');
    }

    //广告
    public function function_WIDGET_AD($params, &$smarty) {
        $render = new base_render(app::get($params['app']));
        //$render->pagedata['ad'] = app::get('b2c')->model('ad')->option_ad($params);
        return $render->fetch('widget/ad/index.top.html');
    }

    //楼层测试
    public function function_WIDGET_B2C_GOODS_INDEX_GOOD_FLOOR_TEST($params, &$smarty) {
        $render = new base_render(app::get($params['app']));
        //$render->pagedata['floor'] = vmc::singleton('b2c_source_goods')->floor($params);
        $render->pagedata['floor_title']= app::get('b2c')->model('pages_position')->getList('*', array('type' => '2', 'status' => '1',));
        $render->pagedata['contents']= app::get('b2c')->model('pages_content')->getList('*', array('type' => '2', 'status' => '1',));
        return $render->fetch('widget/floor.test.html');
    }
    //楼层标题
    public function function_WIDGET_B2C_INDEX_FLOOR_TITLE($params, &$smarty) {
        $render = new base_render(app::get($params['app']));
        $render->pagedata['position_id'] = $params['position_id'];
        $render->pagedata['key'] = $params['key'];
        $render->pagedata['floor_title'] = app::get('b2c')->model('pages_position')->getList('*', array('status' => '1', 'position_id'=>$params['position_id'],));
        return $render->fetch('widget/floor.title.html');
    }
    //楼层广告
    public function function_WIDGET_B2C_INDEX_FLOOR_BANNER($params, &$smarty) {
        $render = new base_render(app::get($params['app']));
        $render->pagedata['position_id'] = $params['position_id'];
        $render->pagedata['banner'] = app::get('b2c')->model('pages_content')->getRow('*', array('status' => '1', 'position_id'=>$params['position_id'],));
        return $render->fetch('widget/floor.banner.html');
    }

    //商家推荐、最近浏览、热卖单品、猜你喜欢
    public function function_WIDGET_B2C_GOOD_HOT($params, &$smarty) {
        $render = new base_render(app::get($params['app']));
        return $render->fetch('widget/hot.goods.html');
    }

}
