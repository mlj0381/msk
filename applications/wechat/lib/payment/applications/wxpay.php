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


final class wechat_payment_applications_wxpay extends ectools_payment_parent implements ectools_payment_interface
{
    public $name = '微信支付';
    public $version = '';
    public $intro = '微信支付是Tencent腾讯旗下微信平台的移动支付方式。';
    public $platform_allow = array(
        'pc','mobile','app',
    ); //pc,mobile,app

    /**
     * 构造方法.
     *
     * @param null
     *
     * @return bool
     */
    public function __construct($app)
    {
        parent::__construct($app);

        $this->callback_url = vmc::openapi_url('openapi.ectools_payment', 'getway_callback', array(
            'wechat_payment_applications_wxpay' => 'callback',
        ));
        $this->notify_url = vmc::openapi_url('openapi.ectools_payment', 'getway_callback', array(
            'wechat_payment_applications_wxpay' => 'notify',
        ));
    }
    /**
     * 后台配置参数设置.
     *
     * @param null
     *
     * @return array 配置参数列表
     */
    public function setting()
    {
        return array(
            'display_name' => array(
                'title' => '支付方式名称' ,
                'type' => 'text',
                'default' => '微信支付',
            ) ,
            'order_num' => array(
                'title' => '排序' ,
                'type' => 'number',
                'default' => 0,
            ) ,
            /*个性化字段开始*/
            'appid'=>array(
                'title'=>'appid',
                'type'=>'text',
            ),
            'appsecret'=>array(
                'title'=>'appsecret',
                'type'=>'text',
            ),
            'mch_id'=>array(
                'title'=>'mch_id(商户号)',
                'type'=>'text',
            ),
            'mch_key'=>array(
                'title'=>'API密钥',
                'type'=>'text'
            ),
            /*个性化字段结束*/
            'pay_fee' => array(
                'title' => '交易费率 (%)' ,
                'type' => 'text',
                'default' => 0,
            ) ,
            'description' => array(
                'title' => '支付方式描述' ,
                'type' => 'html',
                'default' => '微信支付描述',
            ) ,
            'status' => array(
                'title' => '是否开启此支付方式' ,
                'type' => 'radio',
                'options' => array(
                    'true' => '是' ,
                    'false' => '否' ,
                ) ,
                'default' => 'true',
            )
        );
    }
    /**
     * 提交支付信息的接口.
     *
     * @param array 提交信息的数组
     *
     * @return mixed false or null
     */
    public function dopay($params,&$msg)
    {
        $appid   = trim($this->getConf('appid',      __CLASS__)); // 公众号ID
        $mch_id  = trim($this->getConf('mch_id', __CLASS__)); //商户号
        $mch_key = trim($this->getConf('mch_key', __CLASS__)); //商户API秘钥

        $post_data = array(
            'appid'=>$appid,
            'mch_id'=>$mch_id,
            'nonce_str'=>$this->getNonceStr(),//随机字符串，不长于32位
            'body'=>$params['subject']?$params['subject']:'支付订单#'.$params['order_id'],
            'out_trade_no'=>$params['bill_id'],
            'total_fee'=>($params['money'] * 100),//单位(分)
            'spbill_create_ip'=>$params['ip'],
            'notify_url'=>$this->notify_url,
            'trade_type'=>'JSAPI',
            'openid'=>$params['payer_account'],//用户openid
        );
        $is_mobile = base_mobiledetect::is_mobile();
        $in_wechat = base_mobiledetect::is_wechat();
        if(!$is_mobile || !$in_wechat){
            //不在微信内，请求微信支付时，进行二维码展示支付
            $post_data['trade_type'] = 'NATIVE';
            $post_data['product_id'] = $post_data['out_trade_no'];
            unset($post_data['openid']);
        }

        foreach ($post_data as $key => $value) {
            $this->add_field($key,$value);
        }
        $sign = $this->_get_mac($mch_key);

        $this->add_field('sign',$sign);

        $res_arr = $this->unifiedorder();
        $render = app::get('wechat')->render();
        $render->pagedata['total_fee'] = $params['money'];
        $render->pagedata['order_id'] = $params['order_id'];
        $render->pagedata['bill_id'] = $params['bill_id'];
        $render->pagedata['is_mobile'] = $is_mobile?'true':'false';
        $render->pagedata['in_wechat'] = $in_wechat?'true':'false';
        $controller_ins = vmc::singleton(($is_mobile?'mobile':'site').'_controller');
        if($res_arr['return_code']!='SUCCESS'){
            $controller_ins->splash('error','','调用微信支付失败!'.$res_arr['return_msg']);
        }elseif($res_arr['result_code']!='SUCCESS'){
            $controller_ins->splash('error','','调用微信支付失败!'.$res_arr['err_code_des']);
        }
        if($res_arr['trade_type'] == 'JSAPI'){
            //微信内支付
            $jsapi_arr = array(
                'appId'=>$appid,
                'timeStamp'=>(string)time(),
                'nonceStr'=>$this->getNonceStr(),
                'package'=>'prepay_id='.$res_arr['prepay_id'],
                'signType'=>'MD5',
            );
            $jsapi_arr['paySign'] = $this->_get_mac($mch_key,$jsapi_arr);
            $render->pagedata['jsapi_object'] = json_encode($jsapi_arr);
            echo $render->fetch('wxpay/jsapi.html');exit;
        }elseif($res_arr['trade_type'] == 'NATIVE'){
            //微信外产生二维付款码
            $render->pagedata['code_url'] = $res_arr['code_url'];
            echo $render->fetch('wxpay/qrcode.html');exit;
        }

    }

    private function unifiedorder(){

        $xml = "<xml>";
    	foreach ($this->fields as $key=>$val)
    	{
    		if (is_numeric($val)){
    			$xml.="<".$key.">".$val."</".$key.">";
    		}else{
    			$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
    		}
        }
        $xml.="</xml>";
        $action_url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        $res_xml = $this->postXmlCurl($xml,$action_url);

        return $this->xml2array($res_xml);
    }

    private function xml2array($xml){
        libxml_disable_entity_loader(true);
        $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $arr;
    }

    /**
	 *
	 * 产生随机字符串，不长于32位
	 * @param int $length
	 * @return 产生的随机字符串
	 */
	public function getNonceStr($length = 32)
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {
			$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
		}
		return $str;
	}

    /**
	 * 以post方式提交xml到对应的接口url
	 *
	 * @param string $xml  需要post的xml数据
	 * @param string $url  url
	 * @param bool $useCert 是否需要证书，默认不需要
	 * @param int $second   url执行超时时间，默认30s
	 * @throws WxPayException
	 */
	private function postXmlCurl($xml, $url, $useCert = false, $second = 30)
	{
		$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, $second);

		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
		//设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		if($useCert == true){
			//设置证书
			//使用证书：cert 与 key 分别属于两个.pem文件
			curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
			curl_setopt($ch,CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH);
			curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
			curl_setopt($ch,CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH);
		}
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		//运行curl
		$data = curl_exec($ch);
		//返回结果
		if($data){
			curl_close($ch);
			return $data;
		} else {
			$error = curl_errno($ch);
			curl_close($ch);
			logger::error('微信支付CURL出错'.$error);
		}
	}

    /**
     * 支付平台同步跳转处理.
     *
     * @params array - 所有返回的参数，包括POST和GET
     */
    public function callback(&$params)
    {

        $mch_key = trim($this->getConf('mch_key', __CLASS__)); //商户API秘钥
        $callback_xml = $params['_http_raw_post_data_'];
        $callback_arr = $this->xml2array($callback_xml);
        //logger::alert('微信支付NOTIFY：'.$callback_xml.var_export($callback_arr,1));
        $ret['bill_id'] = $callback_arr['out_trade_no']; //原样返回提交的支付单据ID
        $ret['payee_account'] = $this->name; //收款者（卖家）账户
        $ret['payee_bank'] = $this->name; //收款者（卖家）银行
        $ret['payer_account'] = $callback_arr['openid']; //付款者（买家）账户
        $ret['payer_bank'] = $callback_arr['bank_type']; //付款者（买家）银行
        $ret['money'] = number_format($callback_arr['total_fee']/100,3);
        $ret['out_trade_no'] = $callback_arr['transaction_id']; //支付平台交易号

        if ($this->is_return_vaild($callback_arr, $mch_key)) {
            switch ($callback_arr['result_code']) { //交易状态
                case 'SUCCESS':
                    $ret['status'] = 'succ';
                break;
                default:
                    $ret['status'] = 'error';
            }
        } else {
            $ret['status'] = 'invalid'; //非法参数
        }

        return $ret;
    }
    /**
     * 支付平台异步处理.
     *
     * @params array - 所有返回的参数，包括POST和GET
     */
    public function notify(&$params)
    {
        $ret = $this->callback($params);
        if ($ret['status'] == 'succ') {
            echo <<<XML
            <xml>
                <return_code><![CDATA[SUCCESS]]></return_code>
                <return_msg><![CDATA[OK]]></return_msg>
            </xml>
XML;
        }

        return $ret;
    }
    /**
     * 生成签名.
     *
     * @param mixed $form 包含签名数据的数组
     * @param mixed $key  签名用到的私钥
     *
     * @return string
     */
    private function _get_mac($key,$fields = false)
    {
        $fields = $fields?$fields:$this->fields;
        ksort($fields);

        $mac = '';
        foreach ($fields as $k => $v) {
            $mac .= "&{$k}={$v}";
        }
        $mac = substr($mac, 1);

        $mac = md5($mac.'&key='.$key); //验证信息
        return strtoupper($mac);
    }

    /**
     * 检验返回数据合法性.
     *
     * @param mixed $form 包含签名数据的数组
     * @param mixed $key  签名用到的私钥
     *
     * @return bool
     */
    private function is_return_vaild($form, $key)
    {
        ksort($form);
        $signstr = '';
        foreach ($form as $k => $v) {
            if ($k != 'sign' && $k != 'sign_type') {
                $signstr .= "&{$k}={$v}";
            }
        }
        $signstr = substr($signstr, 1);
        $signstr = $signstr.'&key='.$key;
        if ($form['sign'] == strtoupper(md5($signstr))) {
            return true;
        }
        logger::error(__CLASS__.'支付返回签名失败,返回数据：'.var_export($form,1));
        return false;
    }


}
