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


class b2c_ctl_admin_member_msgbox extends desktop_controller{



    function index(){
          $member_comments = $this->app->model('member_comments');
          $member_comments->set_type('msgtoadmin');
          $this->finder('b2c_mdl_member_comments',array(
          'title'=>('站内消息'),
            'use_buildin_recycle'=>true,
            'use_buildin_filter'=>true,
            'base_filter' =>array('for_comment_id' => 0,'has_sent'=>'true'),//增加过滤，只显示已经发送的站内信@lujy
            'finder_aliasname'=>'msgbox',
            'finder_cols'=>'author,title,comment,time',
            'delete_confirm_tip'=>('删除后会员发件箱中也会删除,确定删除吗?')
          ));

    }

   function to_reply(){
      $this->begin("javascript:finderGroup["."'".$_GET["finder_id"]."'"."].refresh()");
      $comment_id = $_POST['comment_id'];
      $comment = $_POST['reply_content'];
      if($comment_id&&$comment){
         $member_comments = vmc::singleton('b2c_message_msg');
         if($member_comments->to_reply($_POST)){
             #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录管理员操作日志@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
             if($obj_operatorlogs = vmc::service('operatorlog.members')){
                 if(method_exists($obj_operatorlogs,'reply_comment')){
                    $sdf['comment'] = $comment_id;
                    $sdf['title'] = $comment;
                    $sdf['object_type'] = 'msg';
                    $obj_operatorlogs->reply_comment($sdf);
                 }
            }
            #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录管理员操作日志@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
            $this->end(true,('回复成功'));
         }
         else{
             $this->end(false,('回复失败'));
         }
      }
      else{
         $this->end(false,('内容不能为空'));
      }
  }


}
