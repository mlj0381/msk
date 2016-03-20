<?php
class freeze_ctl_site_center extends freeze_frontpage{

    function __construct(&$app)
    {
        parent::__construct($app);
        $this->is_complete_info();
        $this->verify_member();
    }

    public function index()
    {

        $this->output();
    }

    /**
     * 订单管理
     */
    public function orders()
    {
        $this->output();
    }

    /**
     * 结算管理
     */
    public function settlement()
    {
        $this->output();
    }

    /**
     * 我的分销产品
     */
    public function goods()
    {
        $this->output();
    }

    /**
     * 我的买家列表
     */
    public function buyer_list()
    {
        $this->output();
    }

    /**
     * 退货管理
     */
    public function reship()
    {
        $this->output();
    }

    /**
     * 退款管理
     */
    public function refund()
    {
        $this->output();
    }

    /**
     * 售后管理
     */
    public function after_sale()
    {
        $this->output();
    }

    /**
     * 违规处理
     */
    public function break_rule()
    {
        $this->output();
    }

    /**
     * 举报管理
     */
    public function report()
    {
        $this->output();
    }

    /**
     * 咨询管理
     */
    public function consultation()
    {
        $this->output();
    }









}
?>