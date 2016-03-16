<?php
class freeze_ctl_site_center extends freeze_frontpage{

    function __construct(&$app)
    {
        parent::__construct($app);
    }

    public function index()
    {
        $this->output();
    }

    /**
     * 个人信息
     */
    public function info()
    {
        $this->output();
    }

    /**
     * 买家管理
     */
    public function buyer_manage()
    {
        $this->output();
    }

    /**
     * 订单管理
     */
    public function orders_manage()
    {
        $this->output();
    }

    /**
     * 商品管理
     */
    public function goods_manage()
    {
        $this->output();
    }

    /**
     * 买手店基本信息
     */
    public function buyer_info()
    {
        $this->output();
    }





}
?>