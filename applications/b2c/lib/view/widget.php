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
class b2c_view_widget
{
    /**
     * 分类挂件
     */
    public function function_WIDGET_B2C_GOODS_CAT($params,&$smarty){
        $render = new base_render(app::get('b2c'));
        $render->pagedata['category_tree'] = vmc::service('view_datasetting')->good_cat($params);
        return $render->fetch('widget/category.html');
    }

	// Nav
	public function function_WIDGET_B2C_PUBLIC_NAV($params, &$smarty)
	{
		$render = new base_render(app::get('b2c'));

		return $render->fetch('widget/nav.html');
	}

	// 首页-幻灯
	public function function_WIDGET_B2C_INDEX_SLIDER($params, &$smarty)
	{
		$render = new base_render(app::get('b2c'));
        $render->pagedata['slider'] = vmc::service('view_datasetting')->slider($params);
		return $render->fetch('widget/slider.html');
	}

	// 首页-好评商品
	public function function_WIDGET_B2C_GOODS_INDEX_GOOD_COMMENT($params, &$smarty)
	{
		$render = new base_render(app::get('b2c'));
		return $render->fetch('widget/good.comment.html');
	}

    //所在城市
    public function function_WIDGET_B2C_INDEX_CITY($params, &$smarty)
    {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['city'] = vmc::service('view_datasetting')->city();
		return $render->fetch('widget/b2c.city.html');
    }
    //楼层左侧推荐
    public function function_WIDGET_B2C_INDEX_LEFT_GOOD($params, &$smaryt){
        $render = new base_render(app::get('b2c'));
        $render->pagedata['floor_left'] = vmc::service('view_datasetting')->floor_left($params);
        return $render->fetch('widget/index_left_good.html');
    }
    //楼层店铺
    public function function_WIDGET_B2C_GOODS_INDEX_SHOP_SHOW($params, &$smaryt){
        $render = new base_render(app::get('b2c'));
        $render->pagedata['store'] = vmc::service('view_datasetting')->show_store($params);
        return $render->fetch('widget/index.shop.show.html');
    }
    // 首页-楼层
	public function function_WIDGET_B2C_GOODS_INDEX_GOOD_FLOOR($params, &$smarty)
	{
		$render = new base_render(app::get('b2c'));
        $render->pagedata['goods'] = vmc::service('view_datasetting')->floor($params);
		return $render->fetch('widget/good.floor.html');
	}
    //网站导航
    public function function_WIDGET_B2C_GOODS_INDEX_WEB_NAV($params, &$smaryt)
    {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['web_nav'] = vmc::service('view_datasetting')->web_nav($params);
		return $render->fetch('widget/web.nav.html');
    }
    //商品筛选
    public function function_WIDGET_B2C_GOODS_LIST_FILTER($params, &$smarty)
    {
        $render = new base_render(app::get('b2c'));
        $render->pagedata['filter'] = vmc::service('view_datasetting')->goods_list_filter($params);
		return $render->fetch('widget/list.filter.html');
    }
    //商品列表分类
    // public function function_WIDGET_B2C_GOODS_LIST_CAT($params, &$smarty)
    // {
    //     $render = new base_render(app::get('b2c'));
    //     $render->pagedata['cat'] = vmc::service('view_datasetting')->goods_list_cat($params);
	// 	return $render->fetch('widget/list.cat.html');
    // }
}
