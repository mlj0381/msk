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



class b2c_finder_pages_content
{	
	public $column_editbutton = '操作';
    public $column_editbutton_order = 0;
    public $detail_basic = '编辑';

	public $column_content_pic = '缩略图';
	public $column_content_pic_order_field = 'image_id';	
	
	public $column_content_status = "状态";

    public function __construct($app)
    {
        $this->app = $app;
        $this->column_editbutton = ('操作');
    }
   
    public function column_editbutton($row)
    {
        //$btn = '<a href="index.php?app=b2c&ctl=admin_pages_content&act=index&content_id='.$row['content_id'].'" class="btn btn-default btn-xs"><i class="fa  fa fa-external-link"></i>查看</a>';
		$btn = '<a href="index.php?app=b2c&ctl=admin_pages_content&act=edit&p[0]='.$row['content_id'].'" class="btn btn-default btn-xs"><i class="fa  fa-edit"></i>编辑</a>';
        return $btn;
    }

	public function column_content_pic($row)
    {	
        $img_src = base_storager::image_path($row['@row']['image_id'], 'xs');
        if (!$img_src) {
            return '';
        }
        return "<img class='img-thumbnail' src='$img_src' style='height:30px;'>";
    }

	function row_style($row){
        $row = $row['@row'];
    }

}
