<?php exit(); ?>a:3:{s:5:"value";a:6:{s:7:"columns";a:5:{s:7:"auth_id";a:5:{s:4:"type";s:6:"number";s:4:"pkey";b:1;s:5:"extra";s:14:"auto_increment";s:7:"comment";s:20:"验证方式序号ID";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:10:"account_id";a:3:{s:4:"type";s:13:"table:members";s:7:"comment";s:14:"账户序号ID";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:10:"module_uid";a:3:{s:4:"type";s:11:"varchar(50)";s:7:"comment";s:18:"来源的用户名";s:8:"realtype";s:11:"varchar(50)";}s:6:"module";a:3:{s:4:"type";s:11:"varchar(50)";s:7:"comment";s:18:"验证方式名称";s:8:"realtype";s:11:"varchar(50)";}s:4:"data";a:3:{s:4:"type";s:4:"text";s:7:"comment";s:21:"扩展信息序列化";s:8:"realtype";s:4:"text";}}s:5:"index";a:2:{s:10:"account_id";a:2:{s:7:"columns";a:2:{i:0;s:6:"module";i:1;s:10:"account_id";}s:6:"prefix";s:6:"UNIQUE";}s:10:"module_uid";a:2:{s:7:"columns";a:2:{i:0;s:6:"module";i:1;s:10:"module_uid";}s:6:"prefix";s:6:"UNIQUE";}}s:7:"comment";s:21:"其他登录方式表";s:8:"idColumn";s:7:"auth_id";s:5:"pkeys";a:1:{s:7:"auth_id";s:7:"auth_id";}s:10:"textColumn";s:10:"account_id";}s:3:"ttl";i:0;s:8:"dateline";i:1447122480;}