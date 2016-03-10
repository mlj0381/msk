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

class b2c_messenger_sms
{
    public $name = '手机短信'; //名称
    public $isHtml = false; //是否html消息
    public $hasTitle = false; //是否有标题

    public function __construct()
    {
        $this->net = vmc::singleton('base_httpclient');
        $this->platform_config = array(
            //平台名称
            'name' => app::get('desktop')->getConf('sms_platform_name'),
            //平台API地址
            'url' => app::get('desktop')->getConf('sms_platform_api_url'),
            //平台参数模板
            'params_tmpl' => urldecode(app::get('desktop')->getConf('sms_platform_api_params_tmpl')),
            //签名用的秘钥
            'secret' => app::get('desktop')->getConf('sms_platform_params_secret'),
            //access_token action
            'access_token_action' => app::get('desktop')->getConf('sms_platform_api_access_token_action'),
            //短信内容后缀
            'sms_sign' => app::get('desktop')->getConf('sms_sign'),
        );

        foreach ($this->platform_config as $key => &$value) {
            $value = trim($value);
        }
    }

    public function send($target, $title, $content, $config)
    {
        $tmpl_data = $config['tmpl_data'];
        $action_name = $config['action_name'];
        $action_name_alias = $config['action_name_alias'];
        $new_msg = array(
            //to
            'member_id' => $target['member_id'],
            'target' => $target['mobile'],
            'subject' => $title,
            'content' => $content.$this->platform_config['sms_sign'],
            'createtime' => time(),
            'msg_type' => 'sms',
            'status' => 'sent',
        );
        app::get('b2c')->model('member_msg')->save($new_msg);

        if (!$target['mobile']) {
            return false;
        }
        if (empty($this->platform_config['url']) || empty($this->platform_config['params_tmpl'])) {
            return false;
        }
        $args = array(
            'target' => $target['mobile'],
            'content' => $content.$this->platform_config['sms_sign'],
            'tmpl_data' => json_encode($tmpl_data),
            'time' => date('Y-m-d H:i:s'),
            'action' => $action_name,
            'action_alias' => $action_name_alias,
        );
        //需要获得access_token
        if (!empty($this->platform_config['access_token_action'])) {
            if (!$args['access_token'] = $this->get_access_token($this->platform_config['access_token_action'])) {
                logger::error($this->platform_config['name'].'access_token获得失败，无法调用短信发送API');

                return false;
            }
        }
        $params = $this->gen_params($this->platform_config['params_tmpl'], $args);
        $result = $this->net->post($this->platform_config['url'], $params);
        logger::debug(__CLASS__.$this->platform_config['url']);
        logger::debug(var_export($params, 1));
        logger::debug(var_export($result, 1));

        return true;
    }

    private function gen_params($params_tmpl, $args)
    {
        parse_str($params_tmpl, $data);
        foreach ($data as $key => $val) {
            if (preg_match_all('/\{([a-z][a-z0-9_]+)\}/i', $val, $matches)) {
                foreach ($matches[1] as $v) {
                    if (substr($v, 0, 4) == 'ENV_') {
                        $v = substr($v, 4);
                        if (is_array($args)) {
                            if (array_key_exists($v, $args)) {
                                $to_replace['{ENV_'.$v.'}'] = $args[$v];
                            } else {
                                $to_replace['{ENV_'.$v.'}'] = '';
                            }
                        }
                    } else {
                        $to_replace = '';
                    }
                }
                if (is_array($to_replace)) {
                    $data[$key] = str_replace(array_keys($to_replace), array_values($to_replace), $val);
                }
            }
        }
        if ($this->platform_config['secret']) {
            ksort($data);
            $p_str = array();
            foreach ($data as $key => $value) {
                $p_str[] = $key.'='.$value;
            }
            $data['sign'] = md5(strtolower(implode('&', $p_str).$this->platform_config['secret']));
        }

        return $data;
    }

    private function get_access_token($action_url)
    {
        if (!cacheobject::get('b2c_sms_platform_access_token_'.md5($action_url), $access_token) || !$access_token) {
            $res = $this->net->post($action_url);
            $res = json_decode($res, 1);
            $access_token = $res['access_token'];
            if ($access_token) {
                cacheobject::set('b2c_sms_platform_access_token_'.md5($action_url), $access_token, time() + $res['expires_in']);
            }
        }

        return $access_token;
    }
}
