<?php
class freeze_ctl_site_passport extends freeze_frontpage{

    function __construct(&$app)
    {
        parent::__construct($app);
        $this->passport_obj = vmc::singleton('freeze_user_passport');
        $this->user_obj = vmc::singleton('freeze_user_object');
    }

    /**
     * 注册冻品管家信息
     */
    public function signup()
    {
        $params = $_POST;
        $next = $this->gen_url(array(
            'app' => 'buyer',
            'ctl' => 'site_manager',
            'act' => 'aptitude',
        )); //PC首页

        $signup_url = $this->gen_url(array(
            'app' => 'buyer',
            'ctl' => 'site_manager',
            'act' => 'manager_signup',
        ));
        $member_sdf_data = $this->passport_obj->pre_signup_process($params);

        //开启事务
        $db = vmc::database();
        $this->transaction_status = $db->beginTransaction();

        if ($member_id = $this->passport_obj->save_members($member_sdf_data, $msg)) {
            $this->user_obj->set_member_session($member_id);
            $this->bind_freeze($member_id);

            $db->commit($this->transaction_status); //事务提交
            $this->splash('success', $next, '注册成功');
        } else {
            $db->rollback(); //事务回滚
            $this->splash('error', $signup_url, '注册失败,会员数据保存异常');
        }
    }

    /**
     * 冻品管家资质信息
     */
    public function freeze_aptitude()
    {

        vmc::dump($_POST);
        die;
    }



}

?>