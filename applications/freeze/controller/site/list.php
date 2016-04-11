<?php
class freeze_ctl_site_list extends freeze_frontpage
{
    function __construct(&$app)
    {
        parent::__construct($app);
    }

    /**
     * 管家列表
     */
    public function freeze_list($page=1)
    {
        $this->set_tmpl('default');
        $model_freeze = app::get('freeze')->model('freeze');

        $limit = 8;
        $filter = array(
            'page_count' => $limit,
            'page_no' => $page
        );
        $result = app::get('freeze')->rpc('select_freeze_info')->request($filter);
        /**
         * 查询冻品管家信息  - IBS2101105
         */
        if($result['status'])
        {
            $codes = array_keys(utils::array_change_key($result['result']['houseList'],'code'));
            $count = $result['result']['count'];
            $freeze_list = $model_freeze->getList('*',array('code'=>$codes));
        }else{

            $filter = array('code|noequal'=>'','account|noequal'=>'');
            $freeze_list = $model_freeze->getList('*',$filter,($page-1)*$limit,$limit);
            $count = $model_freeze->count($filter);
        }



        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'freeze',
                'ctl' => 'site_list',
                'act' => 'freeze_list',
                'args' => array(
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );
        $this->pagedata['list'] = $freeze_list;
        $this->page('site/list/freeze_list.html');
    }

    /**
     * 管家商品列表
     */
    public function freeze_goods($freeze_id,$page=1)
    {
        $this->set_tmpl('default');

        //已绑定冻品管家，查询出管家信息
        $mdl_freeze = app::get('freeze')->model('freeze');
        $mdl_freeze_member = app::get('freeze')->model('freeze_member');

        $freeze_info = $mdl_freeze->getRow('*',array('freeze_id'=>$freeze_id));
        $freeze_member = $mdl_freeze_member->getRow('*',array('freeze_id'=>$freeze_id));



        //推荐商品
        $limit  = 8;
        $filter = array();
        $mdl_goods = app::get('b2c')->model('goods');
        $goods_list = $mdl_goods->getList('*', $filter, ($page-1)*$limit, $limit);
        $goods_list = is_array($goods_list) ? $goods_list : array();
        $obj_goods_stage = vmc::singleton('b2c_goods_stage');
        $obj_goods_stage->gallery($goods_list); //引用传递
        $count = $mdl_goods->count($filter);

        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'freeze',
                'ctl' => 'site_list',
                'act' => 'freeze_goods',
                'args' => array(
                    ($token = time()),
                    'freeze_id' => $freeze_id
                ),
            ),
            'token' => $token,
        );

        $this->pagedata['goods_list'] = $goods_list;
        $this->pagedata['freeze_info'] = $freeze_info;
        $this->pagedata['freeze_member'] = $freeze_member;

        $this->page('site/list/freeze_goods.html');
    }

    public function apply_bind_1()
    {
        var_dump($GLOBALS);
        var_dump($_GET);
        die;
    }

}

?>