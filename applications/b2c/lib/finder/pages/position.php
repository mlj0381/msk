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



class b2c_finder_pages_position
{	
	public $column_editbutton = '操作';
   
    public function column_editbutton($row)
    {
        $btn = '<a href="index.php?app=b2c&ctl=admin_pages_content&act=index&filter[position_id]='.$row['position_id'].'" class="btn btn-default btn-xs"><i class="fa  fa fa-external-link"></i>查看</a>';
		$btn.= '<a href="index.php?app=b2c&ctl=admin_pages_position&act=edit&p[0]='.$row['position_id'].'" class="btn btn-default btn-xs" data-target="#pages_dialog" data-toggle="modal"><i class="fa  fa-edit"></i>编辑</a>';
        return $btn;
    }
}
