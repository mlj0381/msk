<?php


class base_service_queue extends base_openapi
{

    public function worker(){
        set_time_limit(0);
        ignore_user_abort(true);
        $task_id = intval($_POST['task_id']);
        $now = time();
        $queueModel = app::get('base')->model('queue');
        if($_POST['runkey']){
            $runkey = $_POST['runkey'];
            $exec_count = $queueModel->db->exec('update vmc_base_queue set status="running",worker_active='.$now.'
                where queue_id='.intval($task_id).' and runkey='.$queueModel->db->quote($runkey),true);
        }else{
            $runkey = md5(microtime().rand(0,9999));
            $exec_count = $queueModel->db->exec($sql='update vmc_base_queue set status="running",runkey="'.$runkey.'",worker_active='.$now.'
                where queue_id='.intval($task_id).' and status="hibernate"
                or (status="running" and worker_active<'.($now-$queueModel->task_timeout).')',true);

        }
        if($exec_count){
            $task_info = $queueModel->dump($task_id);
            list($worker,$method) = explode('.',$task_info['worker']);
            $errmsg = null;
			$obj_work = vmc::singleton($worker);
            //$remaining = call_user_func_array( array(  $worker ,$method),array(&$task_info['cursor_id'],$task_info['params'], &$errmsg));
			$remaining = call_user_func_array( array(  $obj_work ,$method),array(&$task_info['cursor_id'],$task_info['params'], &$errmsg));
            //$remaining = vmc::singleton($worker)->$method(&$task_info['cursor_id'] , $task_info['params'] , &$errmsg);
            if($remaining){
                $queueModel->db->exec('update vmc_base_queue set status="hibernate",cursor_id='.$queueModel->db->quote($task_info['cursor_id']).' where queue_id='.intval($task_id),true);
                $queueModel->runtask($task_id,$remaining);
            }else{
                if(is_null($errmsg)){
                    $queueModel->db->exec('delete from vmc_base_queue where queue_id='.intval($task_id),true);
                }else{
                    $queueModel->db->exec('update vmc_base_queue set status="failure",errmsg='.$queueModel->db->quote($errmsg).' where queue_id='.intval($task_id),true);    //todo:如果有错误信息
                }
                exit;
            }
        }
    }

}//End Class
