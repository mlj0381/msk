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
        $error_url = $this->gen_url(array(
            'app' => 'buyer',
            'ctl' => 'site_manager',
            'act' => 'aptitude',
        ));
        $url = $this->gen_url(array(
            'app' => 'buyer',
            'ctl' => 'site_manager',
            'act' => 'index',
        ));
        $data = $_POST;
        $freeze_model = app::get('freeze')->model('freeze');
        if(!$this->generate($data,$msg))
        {
            $this->splash('error',$error_url,$msg);
        };

        if(!$freeze_model->save($data))
        {
            $this->splash('error',$error_url,'信息保存失败');
        }
        $this->splash('success',$url,'信息保存成功');
    }


    public function generate(&$data,&$msg)
    {
        $freeze_model = app::get('freeze')->model('freeze');
        $generate_data = array();
        $generate_data['name'] = $data['name'];
        $generate_data['sex'] = $data['sex'];
        $generate_data['age'] = $data['age'];
        $generate_data['education'] = $data['education'];
        $generate_data['ID'] = $data['ID'];
        $generate_data['ID_image'] = $data['ID_image'];
        $generate_data['area'] = $data['area'];
        $generate_data['service'] = $data['service'];
        $generate_data['experience'] = $data['experience'];
        $generate_data['commitment'] = $data['commitment'];
        $generate_data['capacity'] = $data['capacity'];
        $generate_data['certificate'] = $data['certificate'];

        //处理3种情况：管家直接更改信息，管家自己修改信息，买手管家信息更改
        if(!$data['freeze_id'])
        {
            if($freeze_id = $this->user_obj->get_member_id())
            {
                $generate_data['freeze_id'] = $freeze_id;
            }else{
                $freeze_buyer_model = app::get('freeze')->model('freeze_buyer');
                $buyer_user_object= vmc::singleton('buyer_user_object');
                $buyer_id = $buyer_user_object->get_id();
                $freeze_id  = $freeze_buyer_model->getRow('freeze_id',array('buyer_id'=>$buyer_id));
                $generate_data['freeze_id'] = $freeze_id['freeze_id'];
            }
        }
        if(!$generate_data['freeze_id'])
        {
            $msg  = '无效管家资质信息';
            return false;
        }
        if($freeze_model->count(array('ID'=>$data['ID'],'freeze_id|notin'=>$generate_data['freeze_id'])) >0)
        {
            $msg  = '身份证已存在';
            return false;
        };
        $data  = $generate_data;
        return true;
    }



}

?>