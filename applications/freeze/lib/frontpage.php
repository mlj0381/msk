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


class freeze_frontpage extends site_controller
{

    protected $member = array();

    function __construct(&$app)
    {
        parent::__construct($app);
        $this->action = $this->_request->get_act_name();
        $this->controller = $this->_request->get_ctl_name();
        $this->menuSetting = 'index';
    }



    public function get_menu()
    {
        $xmlfile = $this->app->app_dir . "/menu.xml";
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, file_get_contents($xmlfile), $tags);
        xml_parser_free($parser);
        $group = Array();
        $menus = Array();
        $count = count($tags);
        $menuSetting = array(
            'index' => array('index'),
            'setting' => array('setting'),
            'message' => array('message'),
        );
        $menu = $menuSetting[$this->menuSetting];
        foreach ($tags as $key => $item) {
            if ($item['tag'] == 'menugroup' && in_array($item['attributes']['name'], $menu)) {
                $menuItem = $item['attributes'];

                for ($i = $key + 1; $i < $count; $i++) {
                    if ($tags[$i]['tag'] == 'menu') {
                        $tags[$i]['attributes']['label'] = $tags[$i]['value'];
                        $menuItem['items'][] = $tags[$i]['attributes'];
                        continue;
                    }
                    break;
                }
                $menus[] = $menuItem;
            }
        }
        return $menus;
    }

    /**
     * 会员中心框架统一输出.
     */
    protected function output($app_id = '') {
        $app_id || $app_id = $this->app->app_id;
        $this->pagedata['seller'] = $this->seller;
        $this->pagedata['store'] = $this->store;
        $this->pagedata['menu'] = $this->get_menu($this->action);
        $this->pagedata['app'] = $this->app->app_id;
        $this->pagedata['current_controller'] = $this->controller;
        $this->pagedata['current_action'] = $this->action;
        $this->pagedata['active'] = $this->menuSetting;
        $this->action_view = $this->action . '.html';
        $controller = str_replace("site_", "", $this->controller);
        if ($this->pagedata['_PAGE_']) {
            $this->pagedata['_PAGE_'] = 'site/' . $controller . "/" . $this->pagedata['_PAGE_'];
        } else {
            $this->pagedata['_PAGE_'] = 'site/' . $controller . '/' . $this->action_view;
        }
        $this->pagedata['app_id'] = $app_id;
        $this->pagedata['_MAIN_'] = 'site/main.html';
        $this->page('site/main.html');
    }
}
