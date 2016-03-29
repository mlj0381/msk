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


class ectools_mdl_regions extends dbeav_model
{
    /**
     * 得到默认包的信息.
     *
     * @params null
     *
     * @return object servicename
     */
    public function get_package_info()
    {
        return vmc::service('ectools_regions.ectools_mdl_regions');
    }

    /**
     * 得到地区名称.
     *
     * @params string regions id
     *
     * @return array local_name的数组
     */
    public function getById($regionId = '')
    {
        //return $this->db->selectrow("select local_name from ".$this->table_name(1)." where region_id=".intval($regionId));
        return $this->dump(intval($regionId), 'local_name');
    }

    /**
     * 得到指定id的地区信息.
     *
     * @params string region id
     *
     * @return array 信息数组
     */
    public function getRegionByParentId($parentId)
    {
        /*$sql="select region_id,local_name,p_region_id from ".$this->table_name(1)." where region_id=".intval($parentId);
        return $this->db->selectrow($sql);*/
        return $this->dump(intval($parentId), 'region_id,local_name,p_region_id');
    }

    /**
     * 指定region id的下级信息.
     *
     * @params int region id
     *
     * @return array - 所有地区数据数组
     */
    public function getAllChild($regionId)
    {
        /*
        $sql="select region_id from '.$this->table_name(1).' where p_region_id=".intval($regionId);
        $aTemp=$this->db->select($sql);
        if (is_array($aTemp)&&count($aTemp)>0){
            foreach($aTemp as $key => $val){
                $this->getAllChild($val['region_id']);
            }
        }
        $this->IdGroup[]=$regionId;   */
        unset($this->IdGroup);
        /*$sql = "select region_path from ".$this->table_name(1)." where region_id=".intval($regionId);
        $tmpRow=$this->db->selectrow($sql);*/
        $tmpRow = $this->dump(intval($regionId), 'region_path');
        $sql = 'select region_id from '.$this->table_name(1)." where region_path like '%".$tmpRow['region_path']."%'";
        $row = $this->db->select($sql);

        if (is_array($row) && count($row) > 0) {
            foreach ($row as $key => $val) {
                $this->IdGroup[] = $val['region_id'];
            }
        }

        return $this->IdGroup;
    }

    /**
     * 得到指定region id同级的地区信息.
     *
     * @params int region id
     *
     * @return array 地区信息
     */
    public function getGroupRegionId($regionId)
    {
        //$row = $this->db->selectrow($sql='select region_path from '.$this->table_name(1).' where region_id='.intval($regionId));
       $row = $this->dump(intval($regionId), 'region_path');
        $path = $row['region_path'];
        $idGroup = array();

        $rows = $this->db->select($sql = 'select region_id from '.$this->table_name(1)." where region_path like '%".$path."%' and region_id<>".intval($regionId));
        if ($rows) {
            foreach ($rows as $key => $val) {
                $idGroup[] = $val['region_id'];
            }
        }

        return $idGroup;
    }

    /**
     * 得到指定region id的信息及父级的local_name.
     *
     * @params int region id
     *
     * @return array
     */
    public function getDlAreaById($aRegionId)
    {
        /*return $this->db->selectrow('SELECT * FROM vmc_dly_area WHERE area_id='.intval($aAreaId));*/
        $sql = 'select c.region_id,c.local_name,c.p_region_id,c.ordernum,p.local_name as parent_name from '.$this->table_name(1).' as c LEFT JOIN '.$this->table_name(1).' as p ON p.region_id=c.p_region_id where c.region_id='.intval($aRegionId);

        return $this->db->selectrow($sql);
    }

    /**
     * 取指定region id对应的region id.
     *
     * @params string name
     * @params int region id
     */
    public function checkDlArea($name, $p_region_id, $type)
    {
        /*$aTemp = $this->db->selectrow("SELECT area_id FROM vmc_dly_area WHERE name='".$sName."' order by ordernum desc");
        return $aTemp['area_id']; */
        if ($p_region_id) {
            $aTemp = $this->dump(array('local_name' => $name, 'p_region_id' => $p_region_id, 'type' => $type), 'region_id');
        } else {
            $aTemp = $this->dump(array('local_name' => $name, 'type' => $type), 'region_id');
        }
        //$aTemp = $this->db->selectrow("SELECT region_id FROM ".$this->table_name(1)." WHERE local_name='".$name."' and p_region_id".($p_region_id?('='.intval($p_region_id)):' is null'));
        return $aTemp['region_id'];
    }

    public function is_installed()
    {
        //$row = $this->db->selectrow('select count(*) as c from '.$this->table_name(1));
        //return $row['c']>0;
        $row = $this->count();

        return $row;
    }

    /**
     * 清除指定包名下的地区信息.
     *
     * @params string 地区包名
     */
    public function clearOldData($package = '')
    {
        if ($package) {
            $sql = 'delete from '.$this->table_name(1)." where package='".$package."'";
        } else {
            $sql = 'delete from '.$this->table_name(1).' where 1';
        }

        $this->db->exec($sql);
    }

    public function change_regions_data($ship_area = '')
    {
        if (!$ship_area) {
            return '';
        }

        list($package, $region_name, $region_id) = explode(':', $ship_area);
        $arr_region_name = explode('/', $region_name);
        $arr_directory_name = array(
            '北京',
            '天津',
            '上海',
            '重庆',
        );
        if (!in_array($arr_region_name[0], $arr_directory_name)) {
            return $arr_region_name[0].$arr_region_name[1].$arr_region_name[2];
        } else {
            return $arr_region_name[1].$arr_region_name[2];
        }
    }

    /**
     * 地区格式化处理
     */
    function region_decode($area)
    {
        if(!$area)
        {
            return false;
        }
        $arr_region = explode('/',$area);
        $count = count($arr_region);

        $data = array();
        if($count > 0)
        {
            if($count == 3) {
                $province =  substr($arr_region[0],(strpos($arr_region[0],':')+1));
                $city = $arr_region[1];
                $district = substr($arr_region[2],0,strpos($arr_region[2],':'));
            }elseif($count == 2) {
                $province =  substr($arr_region[0],(strpos($arr_region[0],':')+1));
                $city = substr($arr_region[1],0,strpos($arr_region[1],':'));
            }elseif($count == 1)
            {
                $province =  substr($arr_region[0],(strpos($arr_region[0],':')+1));
                $province = substr($province,0,strpos($province,':'));
            }
            $mdl_regions = app::get('ectools')->model('regions');
            if($province) {
                $province = $mdl_regions->getRow('p_1,local_name,region_id',array('local_name'=>$province,'region_grade'=>'1'));
                $data['province']['code'] = $province['p_1'];
                $data['province']['local_name'] = $province['local_name'];
            }
            if($city) {
                $city = $mdl_regions->getRow('p_1,local_name,region_id',array('local_name'=>$city,'region_grade'=>'2','p_region_id'=>$province['region_id']));
                $data['city']['code'] = $city['p_1'];
                $data['city']['local_name'] = $city['local_name'];
            }
            if($district) {
                $district = $mdl_regions->getRow('p_1,local_name,region_id',array('local_name'=>$district,'region_grade'=>'3','p_region_id'=>$city['region_id']));
                $data['district']['code'] = $district['p_1'];
                $data['district']['local_name'] = $district['local_name'];
            }
            return $data;
        }
        return false;
    }

}
