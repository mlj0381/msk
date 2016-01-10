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



class b2c_mdl_pages_position extends dbeav_model{

    

    public function modifier_ordernum($col,$row)
    {
        $pkey = $row['position_id'];

        $_return = <<<HTML
            <input class='form-control edit-col input-sm input-xsmall' name="ordernum" type='text' data-pkey='$pkey' value='$col'>
HTML;
        return $_return;
    }
}
?>