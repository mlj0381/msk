<?php
class freeze_ctl_site_message extends freeze_frontpage
{
    function __construct(&$app)
    {
        parent::__construct($app);
        $this->menuSetting = 'message';
    }

    public function index()
    {
        $this->output();
    }

}

?>