<?php


class importexport_ctl_admin_import extends importexport_controller
{
    /**
     *后台显示队列.
     */
    public function queue_import()
    {
        $params = array(
            'title' => '导入任务队列',
            'use_buildin_recycle' => true,
            'orderBy' => 'create_date desc',
            'base_filter' => array('type' => 'import'),
        );
        $this->finder('importexport_mdl_task', $params);
    }

    /**
     * 下载模板文件.
     */
    public function export_template()
    {

        //实例化导出数据类
        $dataObj = vmc::singleton('importexport_data_object', $_POST['mdl']);
        //实例化导出文件类型类
        $filetypeObj = vmc::singleton('importexport_type_'.$_POST['filetype']);

        $filetypeObj->set_queue_header($_POST['name'].'.'.$_POST['filetype']);

        $data = $dataObj->get_template($_POST['group_col']);

        $rs = $filetypeObj->fileHeader();
        $rs .= $filetypeObj->arrToExportType(array($data));
        $rs .= $filetypeObj->fileFoot();

        if (method_exists($filetypeObj, 'setBom')) {
            $bom = $filetypeObj->setBom();
            echo $bom;
        }
        echo $rs;
    }

    /*
     * 导入页面
     * */
    public function import_view()
    {
        $this->pagedata['check_policy'] = $this->check_policy();
        $this->pagedata['params'] = $_GET['_params'];
        //支持导出类型
        $this->pagedata['import_type'] = $this->import_support_filetype();
        $this->display('admin/import/import.html');
    }

    /*
     * 导入数据
     * */
    public function create_import()
    {
        #检查导入文件是否合法
        $this->check_import_file();

        #将导入文件上传到服务器
        $data = $this->push_file($_POST);

        $queue_params = array(
            'model' => $_POST['mdl'],
            'filetype' => $data['filetype'],
            'policy' => $this->queue_policy(),
            'key' => $data['key'],
        );
        app::get('importexport')->model('task')->create_task('import', $data);
        system_queue::instance()->publish('importexport_tasks_runimport', 'importexport_tasks_runimport', $queue_params);
        $echoMsg = '上传成功,已加入队列';
        $this->import_message(true, $echoMsg);
        #vmc::singleton('importexport_tasks_runimport')->exec($queue_params);
    }

    /**
     * 检查导入文件是否合法.
     */
    private function check_import_file()
    {
        if (!$_FILES['import_file']['name']) {
            $echoMsg = '未上传文件';
            $this->import_message(false, $echoMsg);
        }
        $filetype = strrchr($_FILES['import_file']['name'], '.');
        if ('.'.$_POST['filetype'] != $filetype) {
            $echoMsg = '请上传当前选中的文件类型';
            $this->import_message(false, $echoMsg);
        }
        $import_support_filetype = $this->import_support_filetype();
        if (!in_array($filetype, $import_support_filetype)) {
            $echoMsg = '导入格式不支持';
            $this->import_message(false, $echoMsg);
        }
    }

    /**
     * 将导入文件上传到服务器.
     *
     * @param array $data
     */
    private function push_file($params)
    {
        $file_handle = fopen($_FILES['import_file']['tmp_name'], 'r');

        $filetype = substr(strrchr($_FILES['import_file']['name'], '.'), 1);

        //连接导入文件上传的服务器
        $FTP_policy = vmc::singleton('importexport_policy');
        $ret = $FTP_policy->connect();
        if ($ret !== true) {
            $this->import_message(false, $ret);
        }

        //创建本地文件
        if (!$FTP_policy->local_io()) {
            $msg = '本地文件创建失败，请检查'.TMP_DIR.'文件夹权限';
            $this->import_message(false, $msg);
        }

        //实例化导入文件类型类
        $file_type_obj = vmc::singleton('importexport_type_'.$filetype);

        //实例化数据类
        $date_getter = vmc::singleton('importexport_data_object', $params['mdl']);

        $params = array(
            'key' => $this->gen_key('import'),
            'filetype' => $filetype,
            'name' => '导入:'.$_FILES['import_file']['name'],
            'status' => 0,
        );

        $line = 0;
        $ftell = 0;
        while (feof($file_handle) === false) {
            $contents = array();
            $msg = null;
            fseek($file_handle, $ftell);
            while ($date_getter->check_continue($contents, $line)) {
                $ftell = ftell($file_handle);

                //从上传文件中以每行读取数据
                if (!$file_type_obj->fgethandle($file_handle, $contents, $line)) {
                    break;
                }

                //处理读取出的数据，格式化数据,将数据中的值对应到字段中
                $contents = $date_getter->pre_import_data($contents, $line);
                if ($contents === false) {
                    $msg = '数据格式不正确';
                    $this->import_message(false, $msg);
                }
            }

            if ($contents) {
                $is_file = true;

                $rs = serialize($contents);
                $rs = implode("\n", array($rs))."\n";

                if (!$FTP_policy->local_io($rs)) {
                    $msg = '本地写入文件失败';
                    $this->import_message(false, $msg);
                }

                //本地文件上传到远程
                if (!$FTP_policy->push($params['key'], $FTP_policy->local_file, $FTP_policy->size($params['key']), $msg)) {
                    $msg .= '|文件上传失败';
                    $this->import_message(false, $msg);
                }
            }
        }

        if (!$is_file) {
            $echoMsg = '导入文件中需导入的数据为空或不识别文件,请下载模板再编辑导入';
            $this->import_message(false, $echoMsg);
        }

        $FTP_policy->local_clean();

        return $params;
    }

    public function queue_download()
    {
        $this->file_download();
        exit;
    }
}
