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


define('COLUMN_IN_HEAD', 'HEAD');
define('COLUMN_IN_TAIL', 'TAIL');
class desktop_finder_builder_prototype
{
    public $plimit_in_sel = array(100,50,20,10);
    public $has_tag = 1;
    public $title = '列表';
    public $object_method = array(
            'count' => 'count',   //获取数量的方法名
            'getlist' => 'getlist',   //获取列表的方法名
        );

    public $addon_columns = array();
    public $detail_pages = array();
    public $addon_actions = array();
    public $finder_aliasname = 'default';
    public $finder_cols = '';

    public function __construct($controller)
    {
        $this->controller = $controller;
        //$this->app = $this->controller->app;
        $this->ui = new base_component_ui($controller, app::get('desktop'));
        $this->name = substr(md5($this->controller->workground.$this->controller->user->user_id), 5, 6);
        $this->name = vmc_('desktop','finder_uid',$this->name);
    }

    public function work($full_object_name)
    {
        $this->url = 'index.php?';

        vmc_('desktop', 'finder_make_get');

        $query = utils::http_build_query($_GET);
        $this->url = $this->url.$query;

        $this->object_name = $full_object_name;

        list($object_app, $object_name) = vmc_('desktop', 'finder_split_model', $full_object_name);

        $service_list = array();		
        foreach (vmc::servicelist('desktop_finder.'.$this->object_name) as $name => $object) {
            $service_list[$name] = $object;
        }
        foreach (vmc::servicelist('desktop_finder.'.$this->object_name.'.'.$this->finder_aliasname) as $name => $object) {
            $service_list[$name] = $object;
        }

        foreach ($service_list as $name => $object) {
            $tmpobj = $object;
            foreach (get_class_methods($tmpobj) as $method) {
                switch (substr($method, 0, 7)) {
                    case 'column_':
                        $this->addon_columns[] = array(&$tmpobj,$method);
                        break;

                    case 'detail_':
                        if (!$this->object_select_model) {
                            $this->detail_pages[$method] = array(&$tmpobj,$method);
                        }
                        break;
                }
            }

            $this->service_object[] = &$tmpobj;

            if (method_exists($tmpobj, 'row_style')) {
                $this->row_style_func[] = &$tmpobj;
            }
            unset($tmpobj);
            $i++;
        }

        /*
         * 对额外添加的column和detail的修改
         */
        $obj_addon_cols = vmc::servicelist('desktop_finder_column_modifier.'.$this->object_name.'.'.$this->finder_aliasname);
        if ($obj_addon_cols) {
            foreach ($obj_addon_cols as $obj) {
                $obj->columns_modifier($this->addon_columns);
            }
        }
        $obj_addon_detail_cols = vmc::servicelist('desktop_finder_detail_modifier.'.$this->object_name.'.'.$this->finder_aliasname);
        if ($obj_addon_detail_cols) {
            foreach ($obj_addon_detail_cols as $obj) {
                $obj->detail_columns_modifier($this->detail_pages);
            }
        }
        /* end **/

        $this->object = app::get($object_app)->model($object_name);
        $this->has_tag = $this->object->has_tag;
        $this->dbschema = $this->object->schema;
        $this->main();
    }

    public function getColumns()
    {
        if (!$this->columns) {
            $cols = $this->app->getConf('view.'.$this->object_name.'.'.$this->finder_aliasname.'.'.$this->controller->user->user_id);
            $cols = $cols ? $cols : $this->finder_cols;
            $func_columns = $this->func_columns();
            $all_cols = $this->all_columns();
            $this->columns = vmc_('desktop', 'finder_get_columns', $cols, $func_columns, (array) $this->dbschema['default_in_list'], $all_cols);
        }

        return $this->columns;
    }

    public function getOrderBy()
    {
        if (isset($_POST['_finder']['orderBy']) || isset($_GET['_finder']['orderBy'])) {
            $this->orderBy = $_POST['_finder']['orderBy'] ? $_POST['_finder']['orderBy'] : $_GET['_finder']['orderBy'];
            $this->orderType = $_POST['_finder']['orderType'] ? $_POST['_finder']['orderType'] : $_GET['_finder']['orderType'];
        } else {
            return $this->dbschema['defaultOrder']; //todo 默认
        }
    }

    //页码处理
    public function getPageLimit()
    {
        if ($this->object_select_model) {
            return 10;
        }
        if (isset($_POST['plimit']) && $_POST['plimit']) {
            $this->app->setConf('lister.pagelimit.'.$this->object_name.'.'.$this->finder_aliasname.'.'.$this->controller->user->user_id, $_POST['plimit']);

            return $_POST['plimit'];
        } else {
            $plimit = $this->app->getConf('lister.pagelimit.'.$this->object_name.'.'.$this->finder_aliasname.'.'.$this->controller->user->user_id);

            return $plimit ? $plimit : 20;
        }
    }

    public function &all_columns()
    {
        if(!$this->object_select_model){
            $func_columns = $this->func_columns();
        }
        return vmc_('desktop', 'finder_all_columns', $this->dbschema['in_list'], $func_columns, $this->dbschema['columns']);
    }

    public function &func_columns()
    {
        if (!isset($this->func_list)) {
            $return = array();
            $this->func_list = &$return;
            //标签列
            if ($this->has_tag) {
                $this->addon_columns[] = array(vmc::singleton('desktop_finder_tagcols'),'column_tag');
            }
            foreach ($this->addon_columns as $k => $function) {
                //vmc::dump($function[0]->{$function[1].'_order'},$function[1].'_order');
                $func['type'] = 'func';
                $func['label'] = $function[0]->{$function[1]};
                // if($function[0]->{$function[1].'_order'}==COLUMN_IN_TAIL){
                //     $func['order'] = 100;
                // }elseif($function[0]->{$function[1].'_order'}==COLUMN_IN_HEAD){
                //     $func['order'] = 1;
                // }else{
                //     $func['order'] = $function[0]->{$function[1].'_order'};
                // }
                $func['order'] = $function[0]->{$function[1].'_order'};

                $func['ref'] = $function;
                $func['sql'] = '1';
                $func['order_field'] = '';
                if ($function[0]->{$function[1].'_order_field'}) {
                    $func['order_field'] = $function[0]->{$function[1].'_order_field'};
                }
                $func['alias_name'] = $function[1];
                if ($func['label']) { //只有有名称，才能被显示
                    $return[$function[1]] = $func;
                    //$return[$function[1]] = $func;
                }
            }
        }

        return $this->func_list;
    }
    public function get_views()
    {
        if (!$this->use_view_tab) {
            return array();
        }
        list($app_id, $model) = explode('_mdl_', $this->object_name);
        if ($app_id != $this->controller->app->app_id) {
            return array();
        }

        if (method_exists($this->controller, '_views')) {
            $views = $this->controller->_views();
            $views_temp = vmc_('desktop', 'finder_builder_prototype_get_view_modifier', $views, $this->finder_aliasname, $views_temp);
        }

        //自定义筛选器
        $filter = app::get('desktop')->model('filter');
        $_filter = array(
                'model' => $this->object_name,
                'app' => $_GET['app'],
                'ctl' => $_GET['ctl'],
                'act' => $_GET['act'],
                'user_id' => $this->controller->user->user_id,
            );
        $rows = $filter->getList('*', $_filter, 0, -1, 'create_time asc');
        if (!$views_temp && $rows[0]) {
            $object = app::get($app_id)->model($model);
            $views_temp = array(
                0 => array('label' => '全部','optional' => false,'filter' => '','addon' => $object->count()),
            );
        }
        $extends = $this->_get_args();

        $o = app::get('desktop')->router();
        krsort($views_temp);
        $view = array_slice($views_temp, 0, 1, true);
        $view = array_keys($view);
        $view = $view[0] + 1;
        ksort($views_temp);
        //$view = count($views_temp);
        foreach ($rows as $row) {
            $_url_array = array('app' => $_filter['app'],'act' => $_filter['act'],'ctl' => $_filter['ctl'],'view' => $view);
            $view++;
            $_url_array = vmc_('desktop', 'finder_builder_prototype_get_view_url_array', $extends, $_url_array);
            $url = $o->gen_url($_url_array);
            unset($_url_array);
            $views_temp[] = vmc_('desktop', 'finder_builder_prototype_get_views', $row, $url);
        }

        return (array) $views_temp;
    }

    protected function _get_args()
    {
        return vmc_('desktop', 'finder_get_args', $_GET);
    }

    public function finder_get_view_filter()
    {
        if (!isset($_POST['view'])) {
            return array();
        }
        list($app_id, $model) = explode('_mdl_', $this->object_name);
        if ($app_id != $this->controller->app->app_id) {
            return array();
        }
        if (method_exists($this->controller, '_views')) {
            $views = $this->controller->_views();
        }
        if (isset($views[$_POST['view']])) {
            return $views[$_POST['view']]['filter'];
        }

        //自定义筛选器
        $filter = app::get('desktop')->model('filter');
        $_filter = array(
                'model' => $this->object_name,
                'app' => $_GET['app'],
                'ctl' => $_GET['ctl'],
                'act' => $_GET['act'],
                'user_id' => $this->controller->user->user_id,
            );
        $rows = $filter->getList('*', $_filter, 0, -1, 'create_time asc');
        if ($views) {
            end($views);
            $view_id = $_POST['view'] - key($views) - 1;
        } else {
            $view_id = $_POST['view'] - 1;
        }
        if ($rows[$view_id]) {
            parse_str($rows[$view_id]['filter_query'], $filter_query);
        }

        return $filter_query;
    }
}
