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
    public function freeze_list()
    {
        $this->set_tmpl('default');
        $this->page('site/list/freeze_list.html');
    }

}

?>