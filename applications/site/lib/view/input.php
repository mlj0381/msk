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




class site_view_input{

    function input_checkbox($params){
        $params['type'] = 'checkbox';
        $params['class'] = 'x-check'.($params['class'] ? ' '.$params['class'] : '');
        $params['autocomplete'] = 'off';
        return utils::buildTag($params,'input');
    }
    function input_radio($params){
        $params['type'] = 'radio';
        $params['class'] = 'x-check'.($params['class'] ? ' '.$params['class'] : '');
        $params['autocomplete'] = 'off';
        return utils::buildTag($params,'input');
    }

    function input_datepicker($params){
        if(!$params['type']){
            $params['type'] = 'date';
        }
        if(!$params['vtype']){
            $params['vtype'] = 'date';
        }else if ($params['vtype'] != 'date'){
          $params['vtype'] = $params['vtype'].'&&date';
        }
        if(is_numeric($params['value'])){
            $params['value'] = date('Y-n-j',$params['value']);
        }
        if(isset($params['concat'])){
            $params['name'] .= $params['concat'];
            unset($params['concat']);
        }
        // if(!$params['format'] || $params['format']=='timestamp'){
        //     $prefix = '<input type="hidden" name="_DTYPE_'.strtoupper($params['type']).'[]" value="'.htmlspecialchars($params['name']).'" />';
        // }else{
        //     $prefix = '';
        // }

        $params['type'] = 'text';
        $return = utils::buildTag($params,'input class="x-input calendar'.($params['class'] && $params['class'] != 'cal' ? ' '.$params['class'] : '').'" maxlength="10" readonly="readonly"');
        return $prefix.$return;
    }

    public function input_siteimagearray($params)
    {
        $ui = new base_component_ui($this);
        $domid = $ui->new_dom_id();
        $input_name = $params['name'];
        $input_value = $params['value'];
        $input_default = $params['default'];
        $input_default_val = $params['default_val'];
        if ($input_value) {
            $image_url = base_storager::image_path($input_value);
        }
        $render = app::get('site')->render();
        $render->pagedata = $params;
        $render->pagedata['id'] = $domid;
        $render->pagedata['name'] = $input_name;
        $render->pagedata['url'] = $image_url;
        $render->pagedata['imageList'] = $input_value;
        $render->pagedata['default'] = $input_default;
        $render->pagedata['default_val'] = $input_default_val;
        $render->pagedata['tag'] = $params['tag'];
        return $render->fetch('ui/input_siteimagearray.html');
    }

}//End Class
