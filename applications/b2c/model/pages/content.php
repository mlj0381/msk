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



class b2c_mdl_pages_content extends dbeav_model{

    public $defaultOrder = array(
        'ordernum ASC',
    );

    public function modifier_ordernum($col,$row)
    {
        $pkey = $row['content_id'];
        return "<input class='form-control edit-col input-sm input-xsmall' name=\"ordernum\" type='text' data-pkey='$pkey' value='$col'>";
    }

	public function modifier_status($col,$row)
    {
        $pkey = $row['content_id'];	
		$label = "关闭";
		$class = "green";
		$value = 0;
		if($row['status'])
		{
			$label = "启用";
			$class = "gray";
			$value = 1;
		}
        $_return = "<input class='btn btn-xs edit-bnt {$class}' name=\"status\" type='button' data-pkey='$pkey' data-value=\"{$value}\" value='{$label}' />";
        return $_return;
    }
}
?>