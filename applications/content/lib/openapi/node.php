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


class content_openapi_node extends base_openapi
{
    /**
     *  @param array $params;
     */
    public function tree($params, $return = false)
    {
        $default_params = array(
            'node_id' => 0,
            'show_article' => false,
            'article_limit' => 10,
            'show_self' => false,
        );
        $params = array_merge($default_params, $params);
        $list_map = vmc::singleton('content_article_node')->get_listmaps($params['node_id'], $params['step']);
        $tree = array();
        foreach ($list_map as $key => $value) {
            if ($value['ifpub'] == 'false' || $value['disabled'] == 'true') {
                continue;
            }
            $item = array(
                'node_id' => $value['node_id'],
                'node_path' => $value['node_path'],
                'node_name' => $value['node_name'],
                'link' => app::get('site')
                ->router()
                ->gen_url(array('app' => 'content', 'ctl' => 'site_node', 'act' => 'index', 'args' => array($value['node_id']))),
            );
            if ($params['show_article']) {
                $articles_list = $this->articles(array('node_id' => $value['node_id'], 'article_limit' => $params['article_limit']), true);
                $item['articles'] = array_values($articles_list);
            }
            $tree[] = $item;
        }
        // foreach ($tree as $node_id => $node) {
        //     $node_path = $node['node_path'];
        //     $node_path_arr = explode(',', $node_path, -1);
        //     if (!empty($node_path_arr)) {
        //         unset($tree[$node_id]);
        //         $eval_str = '$tree['.implode('][', $node_path_arr).'][$node_id]= $node;';
        //         eval($eval_str);
        //     }
        // }

        if ($params['node_id'] > 0 && $params['show_self'] == 'true') {
            $node_self = vmc::singleton('content_article_node')->get_node($params['node_id'], true);
            $tree_data = array(
                'node_id' => $params['node_id'],
                'node_path'=> $params['node_path'],
                'node_name' => $node_self['node_name'],
                'link' => app::get('site')
                ->router()
                ->gen_url(array('app' => 'content', 'ctl' => 'site_node', 'act' => 'index', 'args' => array($params['node_id']))),
            );
            if ($params['show_article']) {
                $articles_list = $this->articles(array('node_id' => $params['node_id'], 'article_limit' => $params['article_limit']), true);
                $tree_data['articles'] = array_values($articles_list);
            }
            array_unshift($tree,$tree_data);
        }
        $tree_data = array_values($tree);
        if ($return) {
            return $tree_data;
        }
        $this->success($tree_data);
    }

    public function articles($params, $_return = false)
    {
        $default_params = array(
            'node_id' => 0,
            'article_limit' => 10,
        );
        $params = array_merge($default_params, $params);
        $mdl_aindexs = app::get('content')->model('article_indexs');
        $list = $mdl_aindexs->getList('article_id,title', array('node_id' => $params['node_id'], 'ifpub|notin' => array('false')), 0, $params['article_limit']);
        if ($list) {
            foreach ($list as $key => $value) {
                $list[$key]['link'] = app::get('site')
                ->router()
                ->gen_url(array('app' => 'content', 'ctl' => 'site_article', 'act' => 'index', 'args' => array($value['article_id'])));
            }
        }
        if ($_return) {
            return $list;
        }
        $this->success($list);
    }

}
