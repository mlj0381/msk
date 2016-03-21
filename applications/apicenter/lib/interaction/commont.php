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

/**
 * 其他
 */
class apicenter_interaction_commont
{
    public $req_params = array();

    public function __construct(&$app)
    {
        $this->app = $app;
        $this->request = vmc::singleton('apicenter_api');
    }

    /**
     * 编辑冻品管家信息
     * @param   siteCode    Integer        Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth    String        Y    分配给各个平台的身份识别码
     * @param   loginId    String            登陆的用户ID
     * @param   param    Object            业务参数
     * @param       slCode    String    20    Y    买手店编码
     * @param       houseAccount    String    20    Y    管家账号
     * @param       houseTel    String    20    Y    登录手机号码
     * @param       houseShowName    String    20    Y    卖家显示名称
     * @param       houseContact    String    20    Y    联系人姓名
     * @param       accountPsd    String    256    Y    登录密码
     * @param       authStatus    Integer            认证状态
     * @param       slIdcard    String    20    Y    管家身份证号
     * @param       slConFlg    String    1    Y    国籍
     * @param       areaCode    String    2        大区编码
     * @param       lgcsAreaCode    String    2        物流区编码
     * @param       provinceCode    String    2        省编码
     * @param       cityCode    String    3        地区编码
     * @param       districtCode    String    2        区编码
     * @param       houseAddress    String    100    Y    管家地址
     * @param       lat    String    100        维度
     * @param       lon    String    100        精度
     * @param       vAreaCode    String    2        虚拟大区编码
     * @param       vLgcsAreaCode    String    2        虚拟物流区编码
     * @param       vProvinceCode    String    2        虚拟省编码
     * @param       vCityCode    String    3        虚拟地区编码
     * @param       vDistrictCode    String    2        虚拟区编码
     * @param       vHouseAddress    String    100        虚拟管家地址
     * @param       vLat    String    100        虚拟维度
     * @param       vLon    String    100        虚拟精度
     * @param       buyerAsign    String    1        买手签署
     * @param       wechat    String    200        微信号码
     * @param       qq    String    200        QQ号码
     * @param       email    String    200        邮箱
     * @param       fixedTel    String    200        固定电话
     * @param       fax    String    200        传真号
     * @param       flag1    String    200        备用1
     * @param       flag2    String    200        备用2
     * @param       houseIntroduce    String    1000        管家介绍
     * @param       houseClass    String    1        级别
     * @param       houseCategory    String    1        管家分类:0基本冻品管家 1分销 2菜场 3团膳 4火锅 5中餐 6西餐 7小吃烧烤 8加工厂
     * @param       grade    Integer            等级
     * @param       loginId    String    20        创建者ID/更新者ID
     * @param       delFlg    String    1        删除标志
     * @param       ver    Integer            版本号
     * @param       slAreaList    List            经营区域List
     * @param       slAreaId    Integer            经营区域ID
     * @param       lgcsAreaCode    String    5        物流区编码
     * @param       provinceCode    String    5        省编码
     * @param       cityCode    String    5        地区编码
     * @param       districtCode    String    5        区编码
     * @param       address    String    200        经营地址
     * @param       housePdList    List
     * @param           pdId    Integer            管家管理产品ID
     * @param           pdClassesCode    String    2        产品类别
     * @param           machiningCode    String    2        产品二级分类编码
     * @param           pdBreedCode    String    2        产品品种
     * @param           pdFeatureCode    String    2        产品特征
     * @return false | array
     */
    public function slSeller_newOrUpdate($post_data = array())
    {
        $post_url = 'msk-web/api/v1/bs/slInfo/slSeller/newOrUpdate';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 编辑买手信息
     * @param    siteCode    Integer        Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台    1
     * @param    auth    String        Y    分配给各个平台的身份识别码    MSK00001
     * @param    loginId    String            登陆的用户ID    msk01
     * @param    param    Object            业务参数
     * @param       slAccount    String    20    Y    卖家账号    6-20位字符，支持中英文字母和阿拉伯数字及“-”“_”组合。
     * @param       slTel    String    11    Y    登录手机号码    11位手机号码
     * @param       slShowName    String    20        卖家显示名称
     * @param       slContact    String    20    Y    联系人姓名
     * @param       accountPsd    String    11    Y    登录密码    6-11位字符
     * @param       authStatus    Integer            认证状态    "0:未认证,1:认证中,2:已认证，（现初始：2）"
     * @param       fromFlg    String    1        注册来源    1：神农客，2：美侍客
     * @param       slCode    String    20        卖家编码
     * @param       slConFlg    String    1    Y    生产国籍
     * @param       areaCode    String    5    Y    大区编码
     * @param       lgcsAreaCode    String    5    Y    物流区编码
     * @param       provinceCode    String    5    Y    省编码
     * @param       cityCode    String    5    Y    地区编码
     * @param       districtCode    String    5    Y    区编码
     * @param       slIdcard    String    20    Y    买手身份证号
     * @param       slSort    int        Y    合营优先顺方式    1:设定方式，2：随机
     * @param       slAddress    String    200    Y    买手地址
     * @param       slMainClass    Integer        Y    卖家主分类    "1.自产型,2:代理型,3:OEM型，4：买手型"
     * @param       snkFlg    String    1    Y    神农客标志    1.是
     * @param       selfFlg    String    1    Y    自产型卖家标志    1.是
     * @param       agentFlg    String    1    Y    代理型卖家标志    1.是
     * @param       oemFlg    String    1    Y    OEM型卖家标志    1.是
     * @param       buyerFlg    String    1    Y    买手型卖家标志    1.是
     * @param       loginId    String    20    Y    创建者ID/更新者ID
     * @param       delFlg    String    1        删除标志    0：有效，1：删除
     * @param       ver    Integer            版本号
     * @return false | array
     */
    public function slAccount_newOrUpdate($post_data = array())
    {
        $post_url = 'msk-web/api/v1/bs/slInfo/slAccount/newOrUpdate';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 编辑买手冻品管家的买家信息
     * @param    siteCode    Integer        Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台    1
     * @param    auth    String        Y    分配给各个平台的身份识别码    MSK00001
     * @param    loginId    String            登陆的用户ID    msk01
     * @param    param                业务参数
     * @param       buyerFlag    String    1    Y    1:专属买家、2：抢单买家
     * @param       slCode    String    20    Y    买手店编码
     * @param       houseAccount    String    20    Y    管家账号
     * @param       buyerid    String    20    Y    买家编码
     * @param       startTime    datetime            开始日时    为空时，将设置为当前日期
     * @param       applyTime    datetime            申请日时    为空时，将设置为当前日期
     * @param       applyStatus    String    1    Y    申请状态    1：申请中、2：专属会员
     * @param       applySide    String    1    Y    认证方式    A：冻品管家发展专属会员买家 B：买家选择专属冻品管家
     * @param       loginId    String    20          创建者ID/更新者ID
     * @param       delFlg    String    1          删除标志    0：有效，1：删除
     * @param       ver    Integer              版本号
     * @return false | array
     */
    public function slExclusive_newOrUpdate($post_data = array())
    {
        $post_url = 'msk-web/api/v1/bs/slInfo/slExclusive/newOrUpdate';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 所有供应计划尚未入库的供应量获取
     * @param    disMonth    String        N    分销月度
     * @param    areaCode    String        N    物流区编号
     * @param    supCode    String        N    供应商编号
     * @return false | array
     */
    public function undonum($post_data = array())
    {
        $post_url = 'msk-web/api/v1/sc/undonum';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品批次信息查询
     * @param    SiteCode    数字    Y    平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param    Auth    文本 20    Y    分配给各个平台的身份识别码
     * @param    loginId    String            登陆的用户ID
     * @param    param Object            业务参数
     * @param       actTime    Date    N    生效日期，没有的话，查询全部产品，有的话，查询该日期以后有更新新增的产品信息
     * @return false | array
     */
    public function ds_pdLotInfo($post_data = array())
    {
        $post_url = 'msk-web/api/v1/ds/ds_pdLotInfo';
        $data = $this->request->api_post($post_url, $post_data);
//        var_dump($post_data,$data);exit;
        return $data;
    }

}