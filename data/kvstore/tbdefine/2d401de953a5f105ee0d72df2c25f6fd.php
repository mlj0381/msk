<?php exit(); ?>a:3:{s:5:"value";a:8:{s:7:"columns";a:10:{s:7:"task_id";a:5:{s:4:"type";s:6:"number";s:8:"required";b:1;s:4:"pkey";b:1;s:5:"extra";s:14:"auto_increment";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:4:"name";a:7:{s:4:"type";s:12:"varchar(255)";s:8:"required";b:1;s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:5:"width";i:150;s:5:"label";s:12:"任务名称";s:8:"realtype";s:12:"varchar(255)";}s:7:"message";a:6:{s:4:"type";s:12:"varchar(255)";s:5:"label";s:6:"备注";s:5:"width";i:300;s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:12:"varchar(255)";}s:8:"filetype";a:6:{s:4:"type";s:11:"varchar(20)";s:5:"width";i:100;s:15:"default_in_list";b:1;s:7:"in_list";b:1;s:5:"label";s:12:"文件类型";s:8:"realtype";s:11:"varchar(20)";}s:11:"create_date";a:6:{s:4:"type";s:4:"time";s:5:"label";s:12:"创建时间";s:5:"width";i:150;s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:16:"int(10) unsigned";}s:13:"complete_date";a:6:{s:4:"type";s:4:"time";s:5:"label";s:12:"完成时间";s:5:"width";i:150;s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:16:"int(10) unsigned";}s:4:"type";a:4:{s:4:"type";a:2:{s:6:"export";s:6:"导出";s:6:"import";s:6:"导入";}s:5:"width";i:100;s:5:"label";s:12:"任务类型";s:8:"realtype";s:23:"enum('export','import')";}s:6:"status";a:7:{s:4:"type";a:9:{i:0;s:12:"等待执行";i:1;s:12:"正在导出";i:2;s:12:"导出成功";i:3;s:12:"导出失败";i:4;s:12:"正在导入";i:5;s:12:"导入成功";i:6;s:12:"导入失败";i:7;s:6:"中断";i:8;s:12:"部分导入";}s:7:"default";s:1:"0";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:5:"width";i:100;s:5:"label";s:12:"任务状态";s:8:"realtype";s:41:"enum('0','1','2','3','4','5','6','7','8')";}s:10:"is_display";a:4:{s:4:"type";a:2:{i:0;s:6:"隐藏";i:1;s:6:"显示";}s:7:"default";s:1:"0";s:5:"label";s:12:"是否显示";s:8:"realtype";s:13:"enum('0','1')";}s:3:"key";a:5:{s:4:"type";s:12:"varchar(255)";s:5:"label";s:18:"存储文件名称";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:12:"varchar(255)";}}s:7:"comment";s:24:"导出、导入任务表";s:6:"engine";s:6:"innodb";s:8:"idColumn";s:7:"task_id";s:5:"pkeys";a:1:{s:7:"task_id";s:7:"task_id";}s:7:"in_list";a:7:{i:0;s:4:"name";i:1;s:7:"message";i:2;s:8:"filetype";i:3;s:11:"create_date";i:4;s:13:"complete_date";i:5;s:6:"status";i:6;s:3:"key";}s:15:"default_in_list";a:7:{i:0;s:4:"name";i:1;s:7:"message";i:2;s:8:"filetype";i:3;s:11:"create_date";i:4;s:13:"complete_date";i:5;s:6:"status";i:6;s:3:"key";}s:10:"textColumn";s:4:"name";}s:3:"ttl";i:0;s:8:"dateline";i:1447122452;}