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


class b2c_mdl_goods_cat extends dbeav_model
{
    /**
     * 构造方法.
     *
     * @param object model相应app的对象
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->use_meta();
    }

    /**
     * 注册商品分类的meta.
     *
     * @param null
     */
    public function cat_meta_register()
    {
        $col = array(
            'seo_info' => array(
                'type' => 'serialize',
                'label' => ('seo设置'),
            ) ,
        );
        $this->meta_register($col);
    }
    /**
     * 统一保存、更新的方法.
     *
     * @param mixed 保存的数据内容
     *
     * @return bool
     */
    public function save(&$aData, $mustUpdate = null, $mustInsert = false)
    {
        $path = array();
        $aData['parent_id'] = $aData['parent_id']?$aData['parent_id']:0;
        $parent_id = $aData['parent_id'];
        if(!parent::save($aData, $mustUpdate, $mustInsert)){
            return false;
        }
        $this->update_path($aData['cat_id']);//更新自己的路径
        $this->update_path($parent_id);//更新父类的路径
        $this->update_children_path($aData['cat_id']);//更新子类的路径
        $this->clean_cache();

        return true;
    }
    /**
     * 分类树.
     */
    public function get_tree($parent_id = 0, $step = 1)
    {
        $tree = $this->tree($parent_id, $step);
        $this->touch_cache(true);

        return $tree;
    }


    private function tree($parent_id = 0, $step = null)
    {
        $step_key = (is_null($step)) ? 'all' : 's-'.$step;
        $tree = $this->children($parent_id);
        if ($step !== null) {
            $step = $step - 1;
        }
        if ($step === null || $step > 0) {
            foreach ($tree as $cat_id => &$cat) {
                if ($cat['has_children'] == 'true') {
                    $cat["children"] = $this->tree($cat["cat_id"], $step);
                }
            }
        }
        return $tree;
    }
     /**
      * 获得子类.
      */
     public function children($parent_id)
     {
         $cache_expired = $this->touch_cache();
         if (cacheobject::get('b2c-gcat-tree-cache-'.$parent_id, $children) && $children && $cache_expired > 0) {
             return $children;
         } else {
             $children = $this->getList('*', array('parent_id' => $parent_id), 0, -1, ' p_order ASC');
             $children = utils::array_change_key($children, 'cat_id');
             cacheobject::set('b2c-gcat-tree-cache-'.$parent_id, $children, time()+60*60*24*30);
             foreach($children as $key => &$value){
                $value['son'] = $this->children($value['cat_id']);
             }
             return $children;
         }
     }

     /**
      * 获得所有子孙含自己的cat_id
      */
     public function get_all_children_id($cat_id){
         //子类
         $filter['cat_id'] = $cat_id;
         if ($filter['cat_id'] || $filter['cat_id'] === 0) {

             $cats = $this->getList('cat_path,cat_id', array(
                     'cat_id' => $filter['cat_id'],
                 ));

             $path = '';
             if ($cats) {
                 foreach ($cats as $v) {
                     $path .= ' cat_path LIKE \''.($v['cat_path']).',%\' OR';
                 }
             }
             if ($cat_ids = $this->db->select('SELECT cat_id FROM vmc_b2c_goods_cat WHERE '.$path.' cat_id in ('.implode((array) $filter['cat_id'], ' , ').')')) {
                 $filter['cat_id'] = array_keys(utils::array_change_key($cat_ids, 'cat_id'));
             }

             return $filter['cat_id'];
         }
         return $cat_id;
     }

    /**
     * 删除分类.
     */
    public function remove($catid, &$msg = '')
    {
        if ($this->count(array('parent_id' => $catid))) {
            $msg = '该分类下面还有子分类';

            return false;
        }
        if ($this->app->model('goods')->count(array('cat_id' => $catid))) {
            $msg = '该分类下面还有商品';

            return false;
        }

        $cat_parent = $this->getRow('parent_id', array(
            'cat_id' => intval($catid),
        ));
        if ($this->delete(array('cat_id' => $catid))) {
            //更新父类路径
            $this->update_path($cat_parent['parent_id']);
            $this->clean_cache();

            return true;
        } else {
            return false;
        }
    }

    /**
     * 得到当前的路径
     * @param string cat id
     * @param bool 包含自己
     * @return mixed 路径数据
     */
    public function getPath($cat_id,$show_self = false) {

        if (!$cat_id) return array();
        $row = $this->getRow("cat_path,cat_name,cat_id", array(
            'cat_id' => $cat_id
        ));
        $ret = array(
            array(
                'type' => 'cat',
                'title' => $row['cat_name'],
                'ident' => $row['cat_id']
            )
        );
        if ($row['cat_path']) {
            $rows = $this->getList('cat_name,cat_id', array(
                'cat_id|in' => ($show_self?explode(',', $row['cat_path']):explode(',', $row['cat_path'],-1))
            ) , 0, -1, 'cat_path DESC');
            foreach ($rows as $row) {
                array_unshift($ret, array(
                    'type' => 'cat',
                    'title' => $row['cat_name'],
                    'ident' => $row['cat_id']
                ));
            }
        }
        return $ret;
    }

    /**
     * 路径计算.
     */
    public function update_path($cat_id)
    {
        if (!$cat_id) {
            return false;
        }
        $cat = $this->getRow('parent_id,cat_path', array('cat_id' => $cat_id));
        if (!$cat) {
            return false;
        }
        if ($cat['parent_id'] > 0) {
            $cat_parent = $this->getRow('cat_path', array('cat_id' => $cat['parent_id']));
            $update_params = array('cat_path' => $cat_parent['cat_path'].','.$cat_id);
        } else {
            $update_params = array('cat_path' => $cat_id);
        }
        $update_params['has_children'] = ($this->count(array('parent_id' => $cat_id)) ? 'true' : 'false');

        return $this->update($update_params, array('cat_id' => $cat_id));
    }
    /**
     * 子类路径计算.
     */
    public function update_children_path($cat_id)
    {
        if (!$cat_id) {
            return false;
        }
        $children = $this->getList('cat_id,cat_path', array('parent_id' => $cat_id));
        if (!$children) {
            return false;
        }
        foreach ($children as $key => $cat) {
            $this->update_path($cat['cat_id']);
        }
    }

    /**
     * 缓存过期.
     */
    public function touch_cache($update = false)
    {
        if (!$update) {
            $expired = app::get('b2c')->getConf('goods_cat_cache_expired');
            if (!$expired) {
                return -1;
            } else {
                if($update && $expired == -1){
                    app::get('b2c')->setConf('goods_cat_cache_expired', time());
                }
                return $expired;
            }
        }
    }
    /**
     * 清除缓存.
     */
    public function clean_cache()
    {
        app::get('b2c')->setConf('goods_cat_cache_expired', -1);
    }
}
