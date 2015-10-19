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



class seller_view_input
{

	function input_siteimage($params) {
        $ui = new base_component_ui($this);
        $domid = $ui->new_dom_id();
        $input_name = $params['name'];
        $input_value = $params['value'];
        if ($input_value) {
            $image_url = base_storager::image_path($input_value);
        }
        $render = app::get('seller')->render();
        $render->pagedata = $params;
        $render->pagedata['id'] = $domid;
        $render->pagedata['name'] = $input_name;
        $render->pagedata['url'] = $image_url;
        $render->pagedata['image_id'] = $input_value;
        $render->pagedata['tag'] = $params['tag'];
        return $render->fetch('ui/input_image_seller.html');
    }


	function input_producttype($params)
	{
        if(is_string($params['options'])){
            $ui = new base_component_ui($this);
            $params['remote_url'] = $params['options'];
            $params['options'] = array($params['value']=>$params['value']);
        }
        if($params['rows']){
            foreach($params['rows'] as $r){
                $step[$r[$params['valueColumn']]]=intval($r['step']);
                $options[$r[$params['valueColumn']]] = $r[$params['labelColumn']];
            }
            unset($params['valueColumn'],$params['labelColumn'],$params['rows']);
        }else{
            $options = $params['options'];
            unset($params['options']);
        }
        $params['name'] = $params['search']?'_'.$params['name'].'_search':$params['name'];
        $params['class'] .= ' form-control';
        $value = $params['value'];
        unset($params['value']);
        $html=utils::buildTag($params,'select',false);
        if(!$params['required']){
            $html.='<option></option>';
        }
        foreach((array)$options as $k=>$item){
            if($k==='0' || $k===0){
                $selected = ($value==='0' || $value===0);
            }else{
                $selected = ($value==$k);
            }
            $t_step=$step[$k]?str_repeat('&nbsp;',($step[$k]-1)*3):'';
            $html.='<option'.($params['noselect']?' disabled=true ':' ').($selected?' selected="selected"':'').' value="'.htmlspecialchars($k).'">'.$t_step.htmlspecialchars($item).'</option>';
        }
        $html.='</select>';
        return $html.$script;
    }
}
