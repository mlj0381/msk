<?php exit(); ?>a:3:{s:5:"value";a:8:{s:7:"columns";a:14:{s:6:"app_id";a:9:{s:4:"type";s:11:"varchar(32)";s:8:"required";b:1;s:7:"default";s:0:"";s:4:"pkey";b:1;s:5:"label";s:16:"程序ID(目录)";s:6:"hidden";i:1;s:7:"in_list";b:1;s:15:"default_in_list";b:0;s:8:"realtype";s:11:"varchar(32)";}s:8:"app_name";a:6:{s:4:"type";s:11:"varchar(50)";s:5:"label";s:18:"应用程序名称";s:8:"is_title";i:1;s:7:"in_list";b:1;s:15:"default_in_list";i:1;s:8:"realtype";s:11:"varchar(50)";}s:10:"debug_mode";a:6:{s:4:"type";s:4:"bool";s:7:"default";s:5:"false";s:5:"label";s:12:"调试模式";s:7:"in_list";b:1;s:15:"default_in_list";b:0;s:8:"realtype";s:20:"enum('true','false')";}s:10:"app_config";a:2:{s:4:"type";s:4:"text";s:8:"realtype";s:4:"text";}s:6:"status";a:6:{s:5:"label";s:6:"状态";s:7:"default";s:11:"uninstalled";s:4:"type";a:9:{s:9:"installed";s:20:"已安装, 未启动";s:8:"resolved";s:9:"已配置";s:8:"starting";s:12:"正在启动";s:6:"active";s:9:"运行中";s:8:"stopping";s:12:"正在关闭";s:11:"uninstalled";s:12:"尚未安装";s:10:"installing";s:12:"正在安装";s:6:"broken";s:9:"已损坏";s:6:"paused";s:9:"已暂停";}s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:104:"enum('installed','resolved','starting','active','stopping','uninstalled','installing','broken','paused')";}s:7:"webpath";a:3:{s:4:"type";s:11:"varchar(20)";s:7:"comment";s:12:"远程地址";s:8:"realtype";s:11:"varchar(20)";}s:11:"description";a:6:{s:4:"type";s:12:"varchar(255)";s:5:"width";i:300;s:5:"label";s:6:"说明";s:7:"in_list";b:1;s:15:"default_in_list";i:1;s:8:"realtype";s:12:"varchar(255)";}s:9:"local_ver";a:6:{s:4:"type";s:11:"varchar(20)";s:5:"width";i:100;s:5:"label";s:12:"当前版本";s:7:"in_list";b:1;s:15:"default_in_list";i:1;s:8:"realtype";s:11:"varchar(20)";}s:10:"remote_ver";a:6:{s:4:"type";s:11:"varchar(20)";s:5:"width";i:100;s:5:"label";s:12:"最新版本";s:7:"in_list";b:1;s:15:"default_in_list";b:0;s:8:"realtype";s:11:"varchar(20)";}s:11:"author_name";a:3:{s:4:"type";s:12:"varchar(100)";s:7:"comment";s:9:"作者名";s:8:"realtype";s:12:"varchar(100)";}s:10:"author_url";a:3:{s:4:"type";s:12:"varchar(100)";s:7:"comment";s:9:"作者url";s:8:"realtype";s:12:"varchar(100)";}s:12:"author_email";a:3:{s:4:"type";s:12:"varchar(100)";s:7:"comment";s:12:"作者邮件";s:8:"realtype";s:12:"varchar(100)";}s:5:"dbver";a:3:{s:4:"type";s:11:"varchar(32)";s:7:"comment";s:18:"目前安装版本";s:8:"realtype";s:11:"varchar(32)";}s:13:"remote_config";a:3:{s:4:"type";s:9:"serialize";s:7:"comment";s:18:"远程配置信息";s:8:"realtype";s:8:"longtext";}}s:8:"unbackup";b:1;s:7:"comment";s:15:"系统应用表";s:8:"idColumn";s:6:"app_id";s:7:"in_list";a:7:{i:0;s:6:"app_id";i:1;s:8:"app_name";i:2;s:10:"debug_mode";i:3;s:6:"status";i:4;s:11:"description";i:5;s:9:"local_ver";i:6;s:10:"remote_ver";}s:5:"pkeys";a:1:{s:6:"app_id";s:6:"app_id";}s:10:"textColumn";s:8:"app_name";s:15:"default_in_list";a:4:{i:0;s:8:"app_name";i:1;s:6:"status";i:2;s:11:"description";i:3;s:9:"local_ver";}}s:3:"ttl";i:0;s:8:"dateline";i:1447122311;}