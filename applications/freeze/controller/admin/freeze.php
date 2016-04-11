<?php
class freeze_ctl_admin_freeze extends desktop_controller {

    public function index() {
        $actions_base['title'] = ('冻品管家列表');
        $actions_base['use_buildin_set_tag'] = true;
//        $actions_base['use_buildin_export'] = true;
//        $actions_base['use_buildin_filter'] = true;
        $this->finder('freeze_mdl_freeze',$actions_base);
    }


}


?>