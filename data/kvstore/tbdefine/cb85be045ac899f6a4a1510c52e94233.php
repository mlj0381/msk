<?php exit(); ?>a:3:{s:5:"value";a:9:{s:7:"columns";a:17:{s:9:"seller_id";a:7:{s:4:"type";s:6:"number";s:8:"required";b:1;s:5:"label";s:8:"商家ID";s:4:"pkey";b:1;s:5:"extra";s:14:"auto_increment";s:7:"in_list";b:1;s:8:"realtype";s:21:"mediumint(8) unsigned";}s:10:"company_id";a:10:{s:4:"type";s:6:"number";s:8:"required";b:0;s:7:"default";i:0;s:5:"label";s:6:"公司";s:10:"searchtype";s:3:"has";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:5:"order";s:1:"1";s:7:"comment";s:6:"公司";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:4:"name";a:10:{s:4:"type";s:11:"varchar(50)";s:8:"required";b:0;s:7:"default";s:0:"";s:5:"label";s:9:"联系人";s:10:"searchtype";s:3:"has";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:5:"order";s:1:"1";s:7:"comment";s:9:"联系人";s:8:"realtype";s:11:"varchar(50)";}s:6:"avatar";a:5:{s:4:"type";s:8:"char(32)";s:5:"label";s:6:"头像";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:8:"char(32)";}s:6:"mobile";a:10:{s:4:"type";s:11:"varchar(50)";s:8:"required";b:1;s:7:"default";s:0:"";s:5:"label";s:6:"手机";s:10:"searchtype";s:3:"has";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:5:"order";s:1:"1";s:7:"comment";s:8:"商家ID";s:8:"realtype";s:11:"varchar(50)";}s:5:"email";a:10:{s:4:"type";s:12:"varchar(100)";s:8:"required";b:0;s:7:"default";s:0:"";s:5:"label";s:5:"Email";s:10:"searchtype";s:3:"has";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:5:"order";s:1:"1";s:7:"comment";s:5:"Email";s:8:"realtype";s:12:"varchar(100)";}s:3:"tel";a:10:{s:4:"type";s:11:"varchar(50)";s:5:"label";s:12:"固定电话";s:7:"sdfpath";s:23:"contact/phone/telephone";s:10:"searchtype";s:4:"head";s:8:"editable";b:1;s:10:"filtertype";s:6:"normal";s:13:"filterdefault";s:4:"true";s:7:"in_list";b:1;s:15:"default_in_list";b:0;s:8:"realtype";s:11:"varchar(50)";}s:4:"addr";a:8:{s:4:"type";s:12:"varchar(255)";s:5:"label";s:6:"地址";s:7:"sdfpath";s:12:"contact/addr";s:8:"editable";b:1;s:10:"filtertype";s:6:"normal";s:7:"in_list";b:1;s:15:"default_in_list";b:0;s:8:"realtype";s:12:"varchar(255)";}s:4:"area";a:8:{s:5:"label";s:6:"地区";s:4:"type";s:6:"region";s:7:"sdfpath";s:12:"contact/area";s:10:"filtertype";s:3:"yes";s:13:"filterdefault";s:4:"true";s:7:"in_list";b:1;s:15:"default_in_list";b:0;s:8:"realtype";s:12:"varchar(255)";}s:4:"type";a:6:{s:4:"type";a:5:{i:0;s:6:"商家";i:1;s:15:"线上分销商";i:2;s:21:"线上专营服务商";i:3;s:15:"授权销售商";i:4;s:18:"神家客自营商";}s:5:"label";s:12:"商家类型";s:10:"filtertype";s:6:"normal";s:7:"default";s:1:"1";s:7:"comment";s:12:"商家类型";s:8:"realtype";s:25:"enum('0','1','2','3','4')";}s:6:"reg_ip";a:5:{s:4:"type";s:11:"varchar(16)";s:5:"label";s:8:"注册IP";s:7:"in_list";b:1;s:7:"comment";s:17:"注册时IP地址";s:8:"realtype";s:11:"varchar(16)";}s:7:"regtime";a:7:{s:5:"label";s:12:"注册时间";s:4:"type";s:4:"time";s:10:"filtertype";s:4:"time";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:7:"comment";s:12:"注册时间";s:8:"realtype";s:16:"int(10) unsigned";}s:8:"disabled";a:3:{s:4:"type";s:4:"bool";s:7:"default";s:5:"false";s:8:"realtype";s:20:"enum('true','false')";}s:11:"login_count";a:4:{s:4:"type";s:7:"int(11)";s:7:"default";i:0;s:8:"required";b:1;s:8:"realtype";s:7:"int(11)";}s:10:"experience";a:4:{s:5:"label";s:9:"经验值";s:4:"type";s:7:"int(10)";s:7:"in_list";b:1;s:8:"realtype";s:7:"int(10)";}s:6:"status";a:6:{s:5:"label";s:12:"用户状态";s:4:"type";a:5:{i:0;s:9:"新用户";i:1;s:12:"公司信息";i:2;s:9:"联系人";i:3;s:12:"基本资料";i:4;s:12:"生产资料";}s:7:"default";s:1:"0";s:7:"in_list";b:0;s:15:"default_in_list";b:0;s:8:"realtype";s:25:"enum('0','1','2','3','4')";}s:7:"checkin";a:6:{s:5:"label";s:6:"审核";s:4:"type";a:3:{i:0;s:6:"待核";i:1;s:6:"正常";i:-1;s:9:"未通过";}s:7:"default";s:1:"0";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:18:"enum('0','1','-1')";}}s:5:"index";a:3:{s:9:"ind_email";a:1:{s:7:"columns";a:1:{i:0;s:5:"email";}}s:11:"ind_regtime";a:1:{s:7:"columns";a:1:{i:0;s:7:"regtime";}}s:12:"ind_disabled";a:1:{s:7:"columns";a:1:{i:0;s:8:"disabled";}}}s:7:"version";s:5:"$Rev$";s:7:"comment";s:9:"商家表";s:8:"idColumn";s:9:"seller_id";s:7:"in_list";a:13:{i:0;s:9:"seller_id";i:1;s:10:"company_id";i:2;s:4:"name";i:3;s:6:"avatar";i:4;s:6:"mobile";i:5;s:5:"email";i:6;s:3:"tel";i:7;s:4:"addr";i:8;s:4:"area";i:9;s:6:"reg_ip";i:10;s:7:"regtime";i:11;s:10:"experience";i:12;s:7:"checkin";}s:5:"pkeys";a:1:{s:9:"seller_id";s:9:"seller_id";}s:15:"default_in_list";a:7:{i:0;s:10:"company_id";i:1;s:4:"name";i:2;s:6:"avatar";i:3;s:6:"mobile";i:4;s:5:"email";i:5;s:7:"regtime";i:6;s:7:"checkin";}s:10:"textColumn";s:10:"company_id";}s:3:"ttl";i:0;s:8:"dateline";i:1447122495;}