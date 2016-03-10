<?php
// +----------------------------------------------------------------------
// | VMCSHOP [V M-Commerce Shop]
// +----------------------------------------------------------------------
// | Copyright (c) vmcshop.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.vmcshop.com/licensed)
// +----------------------------------------------------------------------
// | Author: Shanghai ChenShang Software Technology Co., Ltd.
// +----------------------------------------------------------------------



class base_application_crontab extends base_application_prototype_xml{

    var $xml='crontab.xml';
    var $xsd='base_crontab';
    var $path = 'cron';

    function current(){
        $this->current = $this->iterator()->current();
        $this->key = $this->current['id'];
        return $this;
    }

    function row(){
        $row = array(
            'id' => $this->key(),
            'class' => $this->key(),
            'schedule' => $this->current['schedule'],
            'description' => $this->current['description'],
            'last' => time(),
            'type' => 'system',
            'app_id' => $this->target_app->app_id,
            'enabled' => $this->current['enabled']);
        return $row;
    }

    function install(){
        $class = new $this->key();
        if ($class instanceof base_interface_task) {
            logger::info("Installing ".$this->content_typename().' '.$this->key());
            return app::get('base')->model('crontab')->save($this->row());
        } else {
            trigger_error(sprintf('application:%s %s fail', $this->content_typename(), $this->key()), E_USER_ERROR);
        }
    }

    function clear_by_app($app_id){
        if(!$app_id){
            return false;
        }

        if ($app_id!=='base') {
            app::get('base')->model('crontab')->delete(array(
                'app_id'=>$app_id));

        }
    }
}
