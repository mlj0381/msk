<?php
class freeze_ctl_site_message extends freeze_frontpage
{
    function __construct(&$app)
    {
        parent::__construct($app);
        $this->menuSetting = 'message';
        $this->is_complete_info();
    }

    public function index()
    {
        $this->output();
    }

}

?>