<?php exit(); ?>a:3:{s:5:"value";a:6:{s:7:"columns";a:9:{s:6:"pmt_id";a:6:{s:4:"type";s:6:"number";s:8:"required";b:1;s:4:"pkey";b:1;s:5:"extra";s:14:"auto_increment";s:7:"comment";s:14:"促销记录ID";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:7:"rule_id";a:4:{s:4:"type";s:6:"int(8)";s:8:"required";b:1;s:5:"label";s:14:"促销规则ID";s:8:"realtype";s:6:"int(8)";}s:8:"order_id";a:4:{s:4:"type";s:12:"table:orders";s:8:"required";b:1;s:7:"comment";s:8:"订单ID";s:8:"realtype";s:19:"bigint(20) unsigned";}s:10:"product_id";a:3:{s:4:"type";s:14:"table:products";s:7:"comment";s:12:"促销类型";s:8:"realtype";s:21:"mediumint(8) unsigned";}s:8:"pmt_type";a:5:{s:4:"type";a:3:{s:5:"order";s:6:"订单";s:5:"goods";s:6:"商品";s:6:"coupon";s:9:"优惠券";}s:7:"default";s:5:"goods";s:8:"required";b:1;s:7:"comment";s:12:"促销类型";s:8:"realtype";s:30:"enum('order','goods','coupon')";}s:7:"pmt_tag";a:3:{s:4:"type";s:11:"varchar(50)";s:7:"comment";s:12:"促销标签";s:8:"realtype";s:11:"varchar(50)";}s:15:"pmt_description";a:3:{s:4:"type";s:4:"text";s:7:"comment";s:12:"促销描述";s:8:"realtype";s:4:"text";}s:12:"pmt_solution";a:3:{s:4:"type";s:4:"text";s:7:"comment";s:18:"促销兑现方案";s:8:"realtype";s:4:"text";}s:8:"pmt_save";a:5:{s:4:"type";s:5:"money";s:7:"default";s:1:"0";s:8:"required";b:1;s:7:"comment";s:18:"促销节省金额";s:8:"realtype";s:13:"decimal(20,3)";}}s:6:"engine";s:6:"innodb";s:7:"comment";s:39:"订单与商品促销规则的关联表";s:8:"idColumn";s:6:"pmt_id";s:5:"pkeys";a:1:{s:6:"pmt_id";s:6:"pmt_id";}s:10:"textColumn";s:7:"rule_id";}s:3:"ttl";i:0;s:8:"dateline";i:1447122339;}