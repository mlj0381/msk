<?php exit(); ?>a:3:{s:5:"value";a:6:{s:7:"columns";a:9:{s:9:"seller_id";a:4:{s:4:"type";s:6:"number";s:4:"pkey";b:1;s:7:"comment";s:8:"商家ID";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:6:"openid";a:3:{s:4:"type";s:12:"varchar(255)";s:5:"label";s:6:"OpenId";s:8:"realtype";s:12:"varchar(255)";}s:13:"login_account";a:5:{s:4:"type";s:12:"varchar(100)";s:8:"is_title";b:1;s:8:"required";b:1;s:7:"comment";s:12:"登录账号";s:8:"realtype";s:12:"varchar(100)";}s:10:"login_type";a:5:{s:4:"pkey";b:1;s:4:"type";a:3:{s:5:"local";s:9:"用户名";s:6:"mobile";s:12:"手机号码";s:5:"email";s:6:"邮箱";}s:7:"default";s:5:"local";s:7:"comment";s:18:"登录账号类型";s:8:"realtype";s:30:"enum('local','mobile','email')";}s:14:"login_password";a:4:{s:4:"type";s:11:"varchar(32)";s:8:"required";b:1;s:7:"comment";s:12:"登录密码";s:8:"realtype";s:11:"varchar(32)";}s:16:"password_account";a:4:{s:4:"type";s:12:"varchar(100)";s:8:"required";b:1;s:7:"comment";s:30:"登录密码加密所用账号";s:8:"realtype";s:12:"varchar(100)";}s:8:"disabled";a:3:{s:4:"type";s:4:"bool";s:7:"default";s:5:"false";s:8:"realtype";s:20:"enum('true','false')";}s:4:"type";a:4:{s:4:"type";s:10:"tinyint(1)";s:7:"default";i:0;s:7:"comment";s:12:"商家类型";s:8:"realtype";s:10:"tinyint(1)";}s:10:"createtime";a:3:{s:4:"type";s:4:"time";s:7:"comment";s:12:"创建时间";s:8:"realtype";s:16:"int(10) unsigned";}}s:6:"engine";s:6:"innodb";s:7:"comment";s:15:"商家账号表";s:8:"idColumn";a:2:{s:9:"seller_id";s:9:"seller_id";s:10:"login_type";s:10:"login_type";}s:5:"pkeys";a:2:{s:9:"seller_id";s:9:"seller_id";s:10:"login_type";s:10:"login_type";}s:10:"textColumn";a:1:{s:13:"login_account";s:13:"login_account";}}s:3:"ttl";i:0;s:8:"dateline";i:1457768324;}