<?php exit(); ?>a:3:{s:5:"value";a:10:{s:7:"columns";a:8:{s:2:"id";a:6:{s:4:"type";s:15:"bigint unsigned";s:8:"required";b:1;s:4:"pkey";b:1;s:5:"extra";s:14:"auto_increment";s:7:"comment";s:2:"ID";s:8:"realtype";s:19:"bigint(20) unsigned";}s:10:"queue_name";a:7:{s:4:"type";s:12:"varchar(100)";s:7:"comment";s:12:"队列标识";s:5:"label";s:12:"队列标识";s:8:"required";b:1;s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:12:"varchar(100)";}s:6:"worker";a:7:{s:4:"type";s:12:"varchar(100)";s:8:"required";b:1;s:7:"comment";s:15:"执行任务类";s:5:"label";s:15:"执行任务类";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:12:"varchar(100)";}s:6:"params";a:5:{s:4:"type";s:8:"longtext";s:8:"required";b:1;s:7:"comment";s:12:"任务参数";s:5:"label";s:12:"任务参数";s:8:"realtype";s:8:"longtext";}s:11:"create_time";a:7:{s:4:"type";s:4:"time";s:7:"default";i:0;s:7:"comment";s:21:"进入队列的时间";s:5:"label";s:21:"进入队列的时间";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:16:"int(10) unsigned";}s:16:"last_cosume_time";a:7:{s:4:"type";s:4:"time";s:7:"default";i:0;s:7:"comment";s:24:"任务开始执行时间";s:5:"label";s:24:"任务开始执行时间";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:16:"int(10) unsigned";}s:15:"owner_thread_id";a:7:{s:4:"type";s:3:"int";s:7:"default";i:-1;s:7:"comment";s:6:"进程";s:5:"label";s:6:"进程";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:7:"int(11)";}s:13:"exception_msg";a:6:{s:4:"type";s:8:"longtext";s:7:"comment";s:12:"异常信息";s:5:"label";s:12:"异常信息";s:7:"in_list";b:1;s:15:"default_in_list";b:1;s:8:"realtype";s:8:"longtext";}}s:5:"index";a:1:{s:7:"ind_get";a:1:{s:7:"columns";a:2:{i:0;s:10:"queue_name";i:1;s:15:"owner_thread_id";}}}s:6:"engine";s:6:"innodb";s:12:"ignore_cache";b:1;s:7:"comment";s:21:"队列-mysql实现表";s:8:"idColumn";s:2:"id";s:5:"pkeys";a:1:{s:2:"id";s:2:"id";}s:7:"in_list";a:6:{i:0;s:10:"queue_name";i:1;s:6:"worker";i:2;s:11:"create_time";i:3;s:16:"last_cosume_time";i:4;s:15:"owner_thread_id";i:5;s:13:"exception_msg";}s:15:"default_in_list";a:6:{i:0;s:10:"queue_name";i:1;s:6:"worker";i:2;s:11:"create_time";i:3;s:16:"last_cosume_time";i:4;s:15:"owner_thread_id";i:5;s:13:"exception_msg";}s:10:"textColumn";s:10:"queue_name";}s:3:"ttl";i:0;s:8:"dateline";i:1456737156;}