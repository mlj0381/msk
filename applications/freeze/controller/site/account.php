<?php
class freeze_ctl_site_account extends freeze_frontpage
{
    function __construct(&$app)
    {
        parent::__construct($app);
        $this->menuSetting = 'account';
    }

    /**
     * 冻品管家基本信息
     */
    public function index()
    {
        $user_obj = vmc::singleton('freeze_user_object');
        $info = $user_obj->get_members_data(array('account'=>'login_account','freeze'=>'*'));

        $this->pagedata['login_account'] = $info['account']['login_account'];
        $this->pagedata['info'] = $info['freeze'];
        $this->output();
    }

    /**
     * 冻品管家基本信息保存
     */
    public function basic_info()
    {
        $error_url = $this->gen_url(array(
            'app' => 'freeze',
            'ctl' => 'site_account',
            'act' => 'index',
        ));
        $url = $this->gen_url(array(
            'app' => 'freeze',
            'ctl' => 'site_account',
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

    /**
     * 买手店信息
     */
    public function buyer_info()
    {
        $this->output();
    }

    /**
     * 安全设置
     */
    public function security()
    {
        $this->output();
    }

    public function generate(&$data,&$msg)
    {
        $user_obj = vmc::singleton('freeze_user_object');
        $freeze_model = app::get('freeze')->model('freeze');
        $generate_data = array();
        $generate_data['self_image'] = $data['self_image'];
        $generate_data['mobile'] = $data['mobile'];
        $generate_data['email'] = $data['email'];
        $generate_data['name'] = $data['name'];
        $generate_data['sex'] = $data['sex'];
        $generate_data['ID'] = $data['ID'];
        $generate_data['area'] = $data['area'];
        $generate_data['address'] = $data['address'];
        $generate_data['QQ'] = $data['QQ'];
        $generate_data['WeChat'] = $data['WeChat'];
        $generate_data['head_image'] = $data['head_image'];

        //处理3种情况：管家直接更改信息，管家自己修改信息，买手管家信息更改
        if(!$data['freeze_id'])
        {
            if($freeze_id = $user_obj->get_member_id())
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
            $msg  = '无效基本信息';
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