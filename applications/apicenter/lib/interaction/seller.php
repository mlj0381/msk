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
 * 销售相关
 */
class apicenter_interaction_seller
{
    private $URL;
    private $request;
    public function __construct()
    {
        header("Content-type:text/html;charset=utf-8");
        $this->URL = 'msk-web/api/v1/ms/';
        $this->request = vmc::singleton('apicenter_api');
    }

    /**
     * 根据增量时间戳取得卖家信息数据------------------ISL231101
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   incrementalTime   String      Y    YYYY-MM-DD HH24:mi:ss
     * @return  false | array
     */
    public function slInfo($post_data=array()){
        $post_url = $this->URL.'slInfo';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 编辑一个卖家产品和标准质量标准数据------------------ISL231106
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param    slPdList     List             卖家能销售的产品信息
     * @param       slCode    String      Y    卖家编码
     * @param       prodEpId  Integer     Y    生产商企业ID
     * @param       brandEpId  Integer     Y    品牌商企业ID
     * @param       brandId    Integer     Y    产品品牌ID
     * @param       pdClassesCode     String      Y    产品类别
     * @param       machiningCode     String      Y    产品二级分类编码
     * @param       pdBreedCode       String      Y    产品品种
     * @param       pdFeatureCode     String      Y    产品特征
     * @param       weightCode        String      Y    净重编码
     * @param       distFlg           String      Y    是否参与神农客分销，0:否，1:是
     * @param       diskmskFlg        String      Y    是否参与美侍客分销，0:否，1:是
     * @param       loginId    String      Y      创建者ID/更新者ID
     * @param       delFlg    String              删除标志
     * @param       ver       Integer            版本号
     卖家产品加工技术标准指标
     * @param   slPdMctList  List                卖家产品加工技术标准信息List
     * @param       slCode    String     Y       卖家编码
     * @param       slPdId    Integer            卖家产品ID
     * @param       slQltStd   String            卖家产品加工技术标准指标
     * @param       slQltGradeCode    Integer    产品加工技术标准定级
     * @param       loginId   String             创建者ID/更新者ID
     * @param       delFlg    String             删除标志
     * @param       ver       Integer            版本号
     * @param       slPdMctStdList    List       卖家产品加工技术标准指标值信息List
     * @param           slCode         String      Y    卖家编码
     * @param           standardId    Integer     Y     产品标准ID
     * @param           stdItemId     String      Y    质量标准项目ID
     * @param           agreeFlg     String            卖家同意标志
     * @param           stdVal      String            卖家质量标准
     * @param           loginId     String      Y     创建者ID/更新者ID
     * @param           delFlg     String             删除标志
     * @param           ver        Integer           版本号
     卖家产品加工质量标准指标
     * @param   slPdTncList    List            卖家产品加工质量标准指标
     * @param       slCode    String     Y       卖家编码
     * @param       slPdId    Integer            卖家产品ID
     * @param       slTncStd    String            卖家产品技术标准
     * @param       slTncGradeCode    Integer            产品技术标准定级
     * @param       loginId    String    Y        创建者ID/更新者ID
     * @param       delFlg    String            删除标志
     * @param       ver    Integer            版本号
     * @param       slPdTncStdList    List            卖家产品加工质量标准指标值
     * @param           slCode    String       Y     卖家编码
     * @param           standardId    Integer      Y     产品标准ID
     * @param           stdItemId    String        Y    技术标准项目ID
     * @param           agreeFlg    String            卖家同意标志
     * @param           stdVal    String            卖家技术标准
     * @param           loginId    String       Y      创建者ID/更新者ID
     * @param           delFlg    String            删除标志
     * @param   slPdPkgList    List            卖家产品包装标准信息
     * @param       slCode    String       Y     卖家编码
     * @param       slPdId    Integer            卖家产品ID
     * @param       slPdPkgId    Integer    Y        卖家产品包装ID
     * @param       standardId    Integer       Y     产品标准ID
     * @param       pkgCode    String        Y    包装编码
     卖家原种种源标准
     * @param   slPdOrgStdList    List         卖家原种种源标准
     * @param   slCode       String      Y    卖家编码
     * @param   slPdId       Integer          卖家产品ID
     * @param   standardId   Integer    Y    产品标准ID
     * @param   tdItemId     String    Y     技术标准项目ID
     * @param   agreeFlg     String          卖家同意标志
    卖家产品饲养标准
     * @param   slPdOrgStdList    List         卖家原种种源标准
     * @param   slCode       String      Y    卖家编码
     * @param   slPdId       Integer          卖家产品ID
     * @param   standardId   Integer    Y    产品标准ID
     * @param   tdItemId     String    Y     技术标准项目ID
     * @param   agreeFlg     String          卖家同意标志
    卖家产品通用质量标准
     * @param   slPdOrgStdList    List         卖家原种种源标准
     * @param   slCode       String      Y    卖家编码
     * @param   slPdId       Integer          卖家产品ID
     * @param   standardId   Integer    Y    产品标准ID
     * @param   tdItemId     String    Y     技术标准项目ID
     * @param   agreeFlg     String          卖家同意标志
    卖家产品储存运输标准
     * @param   slPdOrgStdList    List         卖家原种种源标准
     * @param   slCode       String      Y    卖家编码
     * @param   slPdId       Integer          卖家产品ID
     * @param   standardId   Integer    Y    产品标准ID
     * @param   tdItemId     String    Y     技术标准项目ID
     * @param   agreeFlg     String          卖家同意标志
    卖家产品安全标准
     * @param   slPdOrgStdList    List         卖家原种种源标准
     * @param   slCode       String      Y    卖家编码
     * @param   slPdId       Integer          卖家产品ID
     * @param   standardId   Integer    Y    产品标准ID
     * @param   tdItemId     String    Y     技术标准项目ID
     * @param   agreeFlg     String          卖家同意标志
     * @return  false | array
     */
    public function slQlt_newOrUpdate($post_data=array()){
        $post_url = $this->URL.'slQlt/newOrUpdate';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询证照基础信息------------------ISL231126
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   certId       Integer     Y    证照ID
     * @param   certName     String      Y    证照名称
     * @return  false | array
     */
    public function slInfo_slMstCertInfo_search($post_data=array()){
        $post_url = $this->URL.'slInfo/slMstCertInfo/search';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 增加生产商------------------ISL231134
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   flag          String     Y     1：卖家代理及分销授权:2：卖家OEM委托授权标志
     * @param   slCode        String     Y     卖家编码
     * @param   producerEpId  Integer    Y     生产商_企业ID
     * @param   contractNo    String     Y     授权经销合同号
     * @param   authEpName    String     Y     授权单位
     * @param   authTermBegin   Datetime      Y    授权期限开始
     * @param   authTermEnd     Datetime      Y    授权期限结束
     * @param   authTermUnliimited   String        授权期限长期标志
     * @param   crtId                String  Y    创建者ID
     * @return  false | array
     */
    public function slInfo_slProducer_new($post_data=array()){
        $post_url = $this->URL.'slInfo/slProducer/new';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 增加企业产品品牌------------------ISL231146
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   epId          Integer     Y    企业ID
     * @param   brandId       Integer     Y    品牌ID
     * @param   brandName     String    Y     品牌名称
     * @param   brandNo    String       Y     商标注册证
     * @param   brandTermBegin  Datetime         有效期限开始
     * @param   brandTermEnd    Datetime   Y    有效期限截止
     * @param   crtId           String    Y     创建者ID
     * @return  false | array
     */
    public function slInfo_slEpBrandcTeam_new($post_data=array()){
        $post_url = $this->URL.'slInfo/slEpBrandcTeam/new';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 增加卖家产品品牌------------------ISL231150
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   slCode        String     Y    卖家编码
     * @param   brandEpId     Integer    Y   品牌所属企业ID
     * @param   brandName     String    Y    品牌名称
     * @param   brandType    Integer    Y    品牌类型
     * @param   contractNo   String         代理及分销授权合同号
     * @param   termBegin    Datetime       有效期开始
     * @param   termEnd     Datetime       有效期截止
     * @param   crtId       String     Y   创建者ID
     * @return  false | array
     */
    public function slInfo_slPdBrandcTeam_new($post_data=array()){
        $post_url = $this->URL.'slInfo/slPdBrandcTeam/new';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 编辑一个卖家增加卖家信息All数据------------------ISL231180
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * 卖家账号信息
     * @param   slAccount     String   Y    卖家账号
     * @param   slTel         String   Y    登录手机号码
     * @param   slShowName    String   Y    卖家显示名称
     * @param   slContact     String   Y    联系人姓名
     * @param   accountPsd    String   Y    登录密码
     * @param   authStatus   Integer   Y    认证状态
     * @param   fromFlg      String    Y    注册来源
     * @param   crtId        String    Y    创建者ID
     * 卖家基本信息
     * @param   slAccount     String   Y    卖家账号
     * @param   slCode        String        卖家编码
     * @param   slConFlg      String   Y    生产国籍
     * @param   areaCode      String   Y    大区编码
     * @param   lgcsAreaCode  String   Y    物流区编码
     * @param   authStatus    String   Y    省编码
     * @param   cityCode      String   Y   地区编码
     * @param   districtCode  String   Y   区编码
     * @param   epId         Integer       企业ID
     * @param   slMainClass  Integer  Y  卖家主分类
     * @param   snkFlg     String    Y    神农客标志
     * @param   selfFlg    String    Y    自产型卖家标志
     * @param   agentFlg  String    Y    代理型卖家标志
     * @param   oemFlg    String    Y    OEM型卖家标志
     * @param   buyerFlg  String    Y   买手型卖家标志
     * @param   sqaStatus Integer      神农客贯标审核
     * @param   distQua   Integer      卖家分销资格
     * @param   shopQua   String       卖家开店资格
     * @param   memo1     String       微信号码
     * @param   memo2     String       QQ号码
     * @param   memo3     String       邮箱
     * @param   memo4     String       固定电话
     * @param   memo5     String       传真号
     * @param   memo6     String       买手类型
     * @param   memo7     String       备用字段7
     * @param   memo8     String       备用字段8
     * @param   memo9     String       备用字段9
     * @param   memo10    String       备用字段10
     * @param   memo11    String       备用字段11
     * @param   memo12    String       备用字段12
     * @param   memo13    String       备用字段13
     * @param   memo14    String       备用字段14
     * @param   memo15    String       备用字段15
     * @param   memo16    String       备用字段16
     * @param   memo17    String       备用字段17
     * @param   memo18    String       备用字段18
     * @param   memo19    String       备用字段19
     * @param   memo20    String       备用字段20
     * 卖家产品类别
     * @param   pdClassesCodeList   List        产品类别List
     * @param   pdClassesCode      String   Y   产品类别
     * @param   pdMachiningCode    String   Y   产品加工程度编码
     * @param   slCode             String       卖家编码
     * 企业基本资质
     * @param   epId             String         企业ID
     * @param   epName           String     Y   企业名称
     * @param   licType          String    Y    三证合一营业执照标志
     * @param   licName          String    Y    营业执照_名称
     * @param   licNo            String         营业执照_注册号
     * @param   licAddr          String         营业执照_住所
     * @param   licBusiType      String         营业执照_经营类型
     * @param   licBusiScope     String         营业执照_经营范围
     * @param   licLegalPerson   String         营业执照_法人代表
     * @param   licRegCapital    BigDecimal     营业执照_注册资本
     * @param   licPaidinCapital BigDecimal     营业执照_实收资本
     * @param   licCrtDate      Datetime        营业执照_成立日期
     * @param 	licTermBegin	 Datetime		营业执照_营业期限开始
     * @param	licTermEnd	     Datetime		营业执照_营业期限截止
     * @param	licTermUnliimited	String		营业执照_营业期限长期标志
     * @param	axNo	        String		Y	税务登记证_税务登记证号
     * @param	taxVatNo	    String	     	税务登记证_一般增值税纳税人资格认定编号
     * @param	orgNo	        String		Y	组织机构代码证_代码
     * @param	orgTermBegin	Datetime	    组织机构代码证_有效期开始
     * @param	orgTermEnd	    Datetime	    组织机构代码证_有效期截止
     * @param	balLegalPerson	String		    银行开户许可证_法定代表人
     * @param	balBank	        String			银行开户许可证_开户银行
     * @param	balAccount	    String			银行开户许可证_帐号
     * @param	fdlNo	        String		    食品流通许可证_许可证编号
     * @param	fdlTermBegin	Datetime	    食品流通许可证_有效期开始
     * @param	fdlTermEnd	    Datetime	    食品流通许可证_有效期截止
     * 企业专业资质
     * @param	certInfoList	List			企业证照信息List
     * @param	epId	       Integer			企业ID
     * @param	certId	       Integer		Y	证照ID
     * @param	certName	   String		Y	证照名称
     * @param	certItemList   List			    企业证照项目信息List
     * @param	certId	       Integer			证照ID
     * @param	certItemId	   Integer		Y	证照项目ID
     * @param	certItemName   Integer		Y	证照项目名称
     * @param	certItemValue  String		Y	证照项目内容
     * 企业荣誉
     * @param	slEpHonorList	List			企业荣誉信息List
     * @param	epId	       Integer			企业ID
     * @param	honorId	       Integer			荣誉ID
     * @param	honorDesc	   String		Y	荣誉描述
     * @param	certDate	   Datetime			发证日期
     * @param	certIssuer	   String			发证单位
     * 企业产品品牌
     * @param	slEpBrandList	List
     * @param	epId	        Integer			企业ID
     * @param	brandId	        Integer			品牌ID
     * @param	brandClass	    String		Y	品牌分类
     * @param	brandName	    String		Y	品牌名称
     * @param	brandNo	        String		Y	商标注册证
     * @param	brandTermBegin	Datetime	    有效期限开始
     * @param	brandTermEnd	Datetime	    有效期限截止
     * 企业产品品牌荣誉
     * @param	slEpBrandHonorList	List		企业产品品牌荣誉信息List
     * @param	epId	        Integer			企业ID
     * @param	brandId	        Integer			品牌ID
     * @param	honorId	        Integer			荣誉ID
     * @param	honorDes	    String		Y	荣誉描述
     * @param	honorNo	        String			证书编号
     * @param	certDate	    Datetime	    发证日期
     * @param	certIssuer	    String			发证单位
     * 卖家产品品牌
     * @param	slPdBrandList	List
     * @param	slCode	       String			卖家编码
     * @param	brandEpId	   Integer		Y	品牌所属企业ID
     * @param	brandId	       Integer		Y	品牌ID
     * @param	brandName	   String			品牌名称
     * @param	brandType	   Integer			品牌类型
     * @param  brandClass	   String		Y	品牌分类
     * @param	contractNo	   String			代理及分销授权合同号
     * @param	termBegin	   Datetime			有效期开始
     * @param	termEnd	       Datetime			有效期截止
     * 企业车间
     * @param	slEpWorkshopList   List		企业车间List
     * @param	epId	        Integer			企业ID
     * @param	workshopId	    Integer			车间ID
     * @param	workshopName	String		Y	车间名称
     * @param	product	        String			生产产品
     * @param	process	        String			工艺流程特点
     * 企业生产能力
     * @param	slEpList	    List			企业生产能力信息列表
     * @param	epId	        Integer			企业ID
     * @param	ftyAsset	    BigDecimal	Y	厂区_总资产
     * @param	ftyRegCapital   BigDecimal	Y	厂区_注册资本
     * @param	ftyLandArea	    BigDecimal	Y	厂区_占地面积
     * @param	ftyFloorArea    BigDecimal	Y	厂区_厂房面积
     * @param	ftyEquipment	String		Y	厂区_主要设备
     * @param	ftyDesignCap	String		Y	厂区_设计产能
     * @param	ftyActualCap	String		Y	厂区_实际产能
     * @param	ftyFtRate	    BigDecimal	Y	厂区_外贸销售占比
     * @param	ftyDsRate	    BigDecimal	Y	厂区_直销占比
     * @param	ftyAsRate	    BigDecimal	Y	厂区_代理销售占比
     * @param	scapMaterial	BigDecimal	Y	库容概括_原料库容
     * @param	scapProduct	    BigDecimal	Y	库容概括_成品库容
     * @param	labArea	        BigDecimal			实验室_面积
     * @param	labFunction	    String			实验室_功能
     * @param	labInvestment	BigDecimal			实验室_投资
     * @param	labMember	    Integer			实验室_人员
     * @param	ddEquipment	    String			检测设备_主要设备及用途
     * 生产商
     * @param	slEpAuthList	    List
     * @param	flag	            String		Y	1：卖家代理及分销授权:2：卖家OEM委托授权标志
     * @param	slCode	            String			卖家编码
     * @param	producerEpId	    Integer		Y	生产商_企业ID
     * @param	contractNo	        String		Y	授权经销合同号
     * @param	authEpName	        String			授权单位
     * @param	authTermBegin	    Datetime	    授权期限开始
     * @param	authTermEnd	        Datetime	    授权期限结束
     * @param	authTermUnliimited	String			授权期限长期标志
     * 企业管理团队
     * @param	slEpManagerList	List
     * @param	epId	        Integer			企业ID
     * @param	memberId	    Integer			管理成员ID
     * @param	memberDuties	String			职务
     * @param	memberName	    String			姓名
     * @param	memberAge	    Integer			年龄
     * @param	memberEduc	    String			文化程度
     * @param	memberTel	    String			联系电话
     * 卖家电商团队
     * @param	slEcTeamList	List
     * @param	slCode	        String			卖家编码
     * @param	memberId	    Integer			成员ID
     * @param	leaderFlg	    String			是否负责人
     * @param	memberName	    String			姓名
     * @param	memberAge	    Integer			年龄
     * @param	birthday	    Datetime		出生日期
     * @param	memberEduc	    String			文化程度
     * @param	memberTel	    String			联系电话
     * @param	loginId	        String			创建者ID/更新者ID
     * @param	delFlg	        String			删除标志
     * @param	ver	            Integer			版本号
     * @return  false | array
     */
    public function slInfo_newOrUpdateAll($post_data=array()){
        $post_url = $this->URL.'slInfo/newOrUpdateAll';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 卖家申请新产品品种/特征/净重------------------ISL231172
     * @param   siteCode       Integer   Y     例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth           String    Y     分配给各个平台的身份识别码
     * @param   loginId        String          登陆的用户ID
     * @param   param          Object          业务参数
     * @param   newPdBFWList   List      Y     卖家申请新产品品种 特征 净重List
     * @param   newFlag        String    Y     1品种 2特征 3净重
     * @param   classesCode    String    Y     产品一级分类CODE
     * @param   classesName    String    Y     产品一级分类名称
     * @param   machiningCode  String    Y    产品二级分类CODE
     * @param   machiningName  String    Y    产品二级分类名称
     * @param   breedCode      String         品种编码
     * @param   breedName      String         品种名称
     * @param   featureCode    String         产品特征编码
     * @param   featureName    String    Y    产品特征名称
     * @param   weightName     String         净重名称
     * @param   weightVal      BigDecimal     净重数值
     * @param   crtId          String    Y    创建者ID
     * @return  false | array
     */
    public function slInfo_slPd_newPdBFW($post_data=array()){
        $post_url = $this->URL.'slInfo/slPd/newPdBFW';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 卖家申请新产品包装------------------ISL231173
     * @param	siteCode	    Integer		Y	例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param	auth	        String		Y	分配给各个平台的身份识别码
     * @param	loginId	        String			登陆的用户ID
     * @param	param	        Object			业务参数
     * @param	newPdPkgList	List			卖家申请新产品包装List
     * @param	classesCode	    String		Y	产品一级分类CODE
     * @param	classesName	    String		Y	产品一级分类名称
     * @param	machiningCode	String		Y	产品二级分类CODE
     * @param	machiningName	String		Y	产品二级分类名称
     * @param	breedCode	    String		Y	品种编码
     * @param	breedName	    String		Y	品种名称
     * @param	featureCode	    tring		Y	产品特征编码
     * @param	featureName	    String		Y	产品特征名称
     * @param	weightCode	    String		Y	净重编码
     * @param	weightName	    String		Y	净重名称
     * @param	weightVal	    decimal		Y	净重数值
     * @param	normsCode	    String		Y	包装编码
     * @param	normsName	    String		Y	包装名称
     * @param	normsSuttle	    String		Y	单个产品净重
     * @param	normsError	    String		Y	单个产品规格净重误差范围
     * @param	normsNumber	    String		Y	内包装净重/个数
     * @param	normsSize	    String		Y	内包装尺寸
     * @param	normsTexture	String		Y	内包装材质及技术标准
     * @param	normsOut	    String		Y	外包装规格
     * @param	normsKg	        String		Y	外包装净重/毛重
     * @param	normsOutSize	String		Y	外包装尺寸
     * @param	normsOutTexture	String		Y	外包装材质及技术标准
     * @param	normsTen	    String		Y	其他包装信息
     * @param	normsLength	    BigDecimal	Y	外包装长
     * @param	normsWidth	    BigDecimal	Y	外包装宽
     * @param	normsHeight	    BigDecimal	Y	外包装高
     * @param	normsVolume	    BigDecimal	Y	外包装体积
     * @param	netweightInner	BigDecimal	Y	内包装净重数值
     * @param	netweightOut	BigDecimal	Y	外包装净重数值
     * @param	crtId	        String		Y	创建者ID
     * @return  false | array
     */
    public function slInfo_slPd_newPdPkg($post_data=array()){
        $post_url = $this->URL.'slInfo/slPd/newPdPkg';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询一个卖家账号数据------------------ISL231105
     * @param	siteCode	Integer		Y	例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param	auth	    String		Y	分配给各个平台的身份识别码
     * @param	loginId	    String			登陆的用户ID
     * @param	param	    Object			业务参数
     * @param	slAccount	String		Y	卖家账号
     * @param	accountPsd	String			登录密码
     * @return false | array
     */
    public function slInfo_slAccount_search($post_data=array()){
        $post_url = $this->URL.'slInfo/slAccount/search';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 删除卖家产品------------------ISL231171
     * @param	siteCode	Integer		Y	例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param	auth	    String		Y	分配给各个平台的身份识别码
     * @param	loginId	    String			登陆的用户ID
     * @param	param	    Object			业务参数
     * @param	 slPdList   List			卖家能销售的产品信息
     * @param	  slPdId    Integer			卖家产品ID
     * @param	loginId	    String		Y	删除者ID
     * @return false | array
     */
    public function slInfo_slProduct_delete($post_data=array()){
        $post_url = $this->URL.'slInfo/slProduct/delete';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

}