<?php
class freeze_ctl_site_passport extends freeze_frontpage{

    function __construct(&$app)
    {
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
    }
    public function index()
    {

        $this->output('');
    }

    public function signup()
    {
        $this->output();
//        $this->page('site/passport/signup.html');
    }

}

?>