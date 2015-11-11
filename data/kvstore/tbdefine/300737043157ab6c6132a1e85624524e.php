<?php exit(); ?>a:3:{s:5:"value";a:9:{s:7:"columns";a:23:{s:5:"dt_id";a:8:{s:4:"type";s:6:"number";s:8:"required";b:1;s:4:"pkey";b:1;s:5:"extra";s:14:"auto_increment";s:5:"label";s:8:"配送ID";s:5:"width";i:110;s:7:"in_list";b:0;s:8:"realtype";s:21:"mediumint(8) unsigned";}s:7:"dt_name";a:8:{s:4:"type";s:11:"varchar(50)";s:5:"label";s:12:"配送方式";s:5:"width";i:180;s:8:"editable";b:1;s:7:"in_list";b:1;s:8:"is_title";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:11:"varchar(50)";}s:7:"has_cod";a:8:{s:4:"type";s:4:"bool";s:7:"default";s:5:"false";s:8:"required";b:1;s:5:"label";s:12:"货到付款";s:5:"width";i:110;s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:20:"enum('true','false')";}s:9:"firstunit";a:5:{s:4:"type";s:6:"number";s:8:"required";b:1;s:7:"default";i:0;s:7:"comment";s:6:"首重";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:12:"continueunit";a:5:{s:4:"type";s:6:"number";s:8:"required";b:1;s:7:"default";i:0;s:7:"comment";s:6:"续重";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:12:"is_threshold";a:4:{s:4:"type";a:2:{i:0;s:9:"不启用";i:1;s:6:"启用";}s:7:"default";s:1:"0";s:7:"comment";s:9:"临界值";s:8:"realtype";s:13:"enum('0','1')";}s:9:"threshold";a:5:{s:4:"type";s:8:"longtext";s:5:"label";s:9:"临界值";s:8:"required";b:0;s:7:"comment";s:21:"临界值配置参数";s:8:"realtype";s:8:"longtext";}s:7:"protect";a:8:{s:4:"type";s:4:"bool";s:7:"default";s:5:"false";s:8:"required";b:1;s:5:"label";s:12:"物流保价";s:5:"width";i:75;s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:20:"enum('true','false')";}s:12:"protect_rate";a:3:{s:4:"type";s:10:"float(6,3)";s:7:"comment";s:12:"报价费率";s:8:"realtype";s:10:"float(6,3)";}s:8:"minprice";a:5:{s:4:"type";s:11:"float(10,2)";s:7:"default";s:4:"0.00";s:8:"required";b:1;s:7:"comment";s:18:"保价费最低值";s:8:"realtype";s:11:"float(10,2)";}s:7:"setting";a:4:{s:4:"type";a:2:{i:0;s:27:"指定配送地区和费用";i:1;s:12:"统一设置";}s:7:"default";s:1:"1";s:7:"comment";s:18:"地区费用类型";s:8:"realtype";s:13:"enum('0','1')";}s:12:"def_area_fee";a:5:{s:4:"type";s:4:"bool";s:7:"default";s:5:"false";s:5:"label";s:61:"按地区设置配送费用时,是否启用默认配送费用";s:8:"required";b:0;s:8:"realtype";s:20:"enum('true','false')";}s:10:"firstprice";a:5:{s:4:"type";s:11:"float(10,2)";s:7:"default";s:4:"0.00";s:8:"required";b:0;s:7:"comment";s:12:"首重费用";s:8:"realtype";s:11:"float(10,2)";}s:13:"continueprice";a:5:{s:4:"type";s:11:"float(10,2)";s:7:"default";s:4:"0.00";s:8:"required";b:0;s:7:"comment";s:12:"续重费用";s:8:"realtype";s:11:"float(10,2)";}s:11:"dt_discount";a:5:{s:4:"type";s:11:"float(10,2)";s:7:"default";s:4:"0.00";s:8:"required";b:0;s:7:"comment";s:9:"折扣值";s:8:"realtype";s:11:"float(10,2)";}s:14:"dt_expressions";a:3:{s:4:"type";s:8:"longtext";s:7:"comment";s:27:"配送费用计算表达式";s:8:"realtype";s:8:"longtext";}s:9:"dt_useexp";a:4:{s:4:"type";s:4:"bool";s:7:"default";s:5:"false";s:7:"comment";s:18:"是否使用公式";s:8:"realtype";s:20:"enum('true','false')";}s:7:"corp_id";a:4:{s:4:"type";s:6:"number";s:8:"required";b:0;s:7:"comment";s:14:"物流公司ID";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:9:"dt_status";a:8:{s:4:"type";a:2:{i:0;s:6:"关闭";i:1;s:6:"启用";}s:5:"label";s:6:"状态";s:5:"width";i:75;s:7:"default";s:1:"1";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:7:"comment";s:12:"是否开启";s:8:"realtype";s:13:"enum('0','1')";}s:6:"detail";a:3:{s:4:"type";s:8:"longtext";s:7:"comment";s:12:"详细描述";s:8:"realtype";s:8:"longtext";}s:13:"area_fee_conf";a:4:{s:4:"type";s:8:"longtext";s:8:"required";b:0;s:7:"comment";s:36:"指定地区配置的一系列参数";s:8:"realtype";s:8:"longtext";}s:8:"ordernum";a:8:{s:4:"type";s:11:"smallint(4)";s:7:"default";i:0;s:5:"label";s:6:"排序";s:5:"width";i:110;s:8:"editable";b:1;s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:11:"smallint(4)";}s:8:"disabled";a:3:{s:4:"type";s:4:"bool";s:7:"default";s:5:"false";s:8:"realtype";s:20:"enum('true','false')";}}s:5:"index";a:1:{s:12:"ind_disabled";a:1:{s:7:"columns";a:1:{i:0;s:8:"disabled";}}}s:7:"version";s:5:"$Rev$";s:7:"comment";s:21:"商店配送方式表";s:8:"idColumn";s:5:"dt_id";s:5:"pkeys";a:1:{s:5:"dt_id";s:5:"dt_id";}s:10:"textColumn";s:7:"dt_name";s:7:"in_list";a:5:{i:0;s:7:"dt_name";i:1;s:7:"has_cod";i:2;s:7:"protect";i:3;s:9:"dt_status";i:4;s:8:"ordernum";}s:15:"default_in_list";a:5:{i:0;s:7:"dt_name";i:1;s:7:"has_cod";i:2;s:7:"protect";i:3;s:9:"dt_status";i:4;s:8:"ordernum";}}s:3:"ttl";i:0;s:8:"dateline";i:1447122317;}