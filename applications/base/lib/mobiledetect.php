<?php

class base_mobiledetect
{
    public static function is_mobile()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_agents = array('240x320','acer','acoon','acs-','abacho','ahong','airness','alcatel','amoi','android','anywhereyougo.com','applewebkit/525','applewebkit/532','asus','audio','au-mic','avantogo','becker','benq','bilbo','bird','blackberry','blazer','bleu','cdm-','compal','coolpad','danger','dbtel','dopod','elaine','eric','etouch','fly ','fly_','fly-','go.web','goodaccess','gradiente','grundig','haier','hedy','hitachi','htc','huawei','hutchison','inno','ipad','ipaq','ipod','jbrowser','kddi','kgt','kwc','lenovo','lg ','lg2','lg3','lg4','lg5','lg7','lg8','lg9','lg-','lge-','lge9','longcos','maemo','mercator','meridian','micromax','midp','mini','mitsu','mmm','mmp','mobi','mot-','moto','nec-','netfront','newgen','nexian','nf-browser','nintendo','nitro','nokia','nook','novarra','obigo','palm','panasonic','pantech','philips','phone','pg-','playstation','pocket','pt-','qc-','qtek','rover','sagem','sama','samu','sanyo','samsung','sch-','scooter','sec-','sendo','sgh-','sharp','siemens','sie-','softbank','sony','spice','sprint','spv','symbian','tablet','talkabout','tcl-','teleca','telit','tianyu','tim-','toshiba','tsm','up.browser','utec','utstar','verykool','virgin','vk-','voda','voxtel','vx','wap','wellco','wig browser','wii','windows ce','wireless','xda','xde','zte');
        $is_mobile = false;
        foreach ($mobile_agents as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }

        return $is_mobile;
    }

    public static function is_wechat()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        return strpos($user_agent, 'MicroMessenger');
    }

    //自动跳转设备
    public static function select_terminator($part, $ignore_ua_check, $url_app_map)
    {
        
        if (app::get('mobile')->getConf('select_terminator') == false || app::get('mobile')->getConf('select_terminator') == 'false') {
            return false;
        }
        //地址扩展名
        if (app::get('mobile')->getConf('enable_mobile_uri_expanded') == 'true') {
            $uri_expended_name = app::get('mobile')->getConf('mobile_uri_expanded_name');
        } else {
            $uri_expended_name == 'html';
        }
        foreach ($url_app_map as $k => $v) {
            if ($v['app'] == 'mobile') {
                $mb_map = $k;
            }
        }
        if($url_app_map[$part]['app'] == 'desktop'){
            return false;
        }
        if (($part == '/' || $part == '/index.php' || $part == '/index.'.$uri_expended_name || substr($part, 0, strlen($mb_map) + 1) != ($mb_map.'/')) && $ignore_ua_check != 1 && $part != $mb_map) {
            header('Location:'.vmc::base_url(1).(WITH_REWRITE ? '' : '/index.php').$mb_map.$part);
            exit;
        }
    }
}
