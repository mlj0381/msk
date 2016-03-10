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


class base_csv
{
	
	private $_handle = Null;
	private $_output = Array();
	private $count = 0;
	private $_source = 0;

	public function import($file)
	{
		if(!file_exists($file)) return false;
		$result = Array();		
		$this->open($file);
		$row = 0;		
		while ($data = fgetcsv($this->_handle, 10000))
		{
			$num = count($data);
			for ($i = 0; $i < $num; $i++) { 
				$result[$row][$i] = iconv('gb2312', 'utf-8', $data[$i]);
			} 
			$this->count++;
			$row = $this->count;
		}
		return $result;
	}

	public function open($file)
	{
		$this->_handle = fopen($file, 'r'); 
	}

	public function export($data, $title = Array(), $file = '')
	{
		$file || $file = date('YmdHis') . '.csv';
		$result = '';
		$result = $title ? iconv('utf-8', 'gb2312', implode(',', $title)) : '';
		foreach($data as $key => $item)
		{
			array_walk($item, function(&$v, $k){
				$v = iconv('utf-8', 'gb2312',$v);
			});
			$result .= implode(',', $title) . "\n";
		}	
		header("Content-type:text/csv"); 
		header("Content-Disposition:attachment;filename=". $filename); 
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
		header('Expires:0'); 
		header('Pragma:public'); 
		echo $result;
	}

	public function __destruct()
	{
		fclose($this->_handle);
	}

}
