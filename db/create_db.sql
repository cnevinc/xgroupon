--
-- MySQL 5.1.63
-- Mon, 02 Jul 2012 15:42:50 +0000
--

CREATE TABLE `order_batch` (
   `batch_id` int(11) not null auto_increment,
   `batch_no` varchar(10) not null,
   `batch_bill_ntd` int(10),
   `batch_fee_ntd` int(10),
   `batch_customs_ntd` int(10),
   `batch_bill_usd` double,
   `batch_freight_usd` double,
   `batch_remark` text,
   `createion_date` datetime,
   `update_date` datetime,
   `due_date` date,
   PRIMARY KEY (`batch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;


CREATE TABLE `order_face2face` (
   `ff_id` int(50) not null auto_increment,
   `ff_date` datetime not null,
   `ff_locate` varchar(30) not null,
   `user_id` int(20),
   `ff_remark` text,
   PRIMARY KEY (`ff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=58;


CREATE TABLE `order_header` (
   `header_id` int(50) not null auto_increment,
   `order_no` varchar(50) not null,
   `order_status` varchar(1) not null,
   `user_id` int(50) not null,
   `delivery_mothod` varchar(30) not null,
   `delivery_address` varchar(50) not null,
   `delivery_time` varchar(30),
   `delivery_store_no` varchar(10),
   `delivery_store_name` varchar(20),
   `delivery_addressee` varchar(100),
   `domestic_exp` int(20) not null,
   `balance_due` int(20) not null,
   `bank_time_1` varchar(30) not null,
   `bank_name_1` varchar(10) not null,
   `bank_code_1` varchar(10) not null,
   `bank_last5_1` varchar(12) not null,
   `bank_amount_1` varchar(10),
   `bank_time_2` varchar(10),
   `bank_name_2` varchar(10),
   `bank_code_2` varchar(10),
   `bank_last5_2` varchar(10),
   `bank_amount_2` varchar(10),
   `createion_date` datetime not null,
   `update_date` timestamp not null default CURRENT_TIMESTAMP,
   `batch_id` int(11) not null,
   `admin_remark` text,
   `user_remark` text,
   PRIMARY KEY (`header_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=140;


CREATE TABLE `order_line` (
   `line_id` int(50) not null auto_increment,
   `createion_date` datetime not null,
   `update_date` timestamp not null default CURRENT_TIMESTAMP,
   `user_id` int(50) not null,
   `header_add_date` date not null,
   `header_id` int(50),
   `line_shortage` tinyint(1),
   `line_remark` text,
   `stp_item_no` varchar(50) not null,
   `stp_item_name` varchar(200) not null,
   `stp_color` varchar(100) not null,
   `stp_size` varchar(50) not null,
   `stp_spec` varchar(50) not null,
   `stp_url` text not null,
   `stp_item_count` int(2) not null,
   `quot_date` date not null,
   `quot_due_date` date not null,
   `quot_amount` double not null,
   `act_amount` double,
   `review` text,
   `batch_id` int(10),
   PRIMARY KEY (`line_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=766;


CREATE TABLE `post_header` (
   `post_id` int(50) not null auto_increment,
   `post_subject` varchar(255),
   `post_body` text,
   `creation_date` datetime,
   `update_date` datetime,
   `user_id` int(50) not null,
   `post_cat` varchar(50),
   `post_onTop` int(1) default '0',
   `post_reply_id` int(50) not null default '0',
   PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;


CREATE TABLE `sales_header` (
   `sales_id` int(20) not null auto_increment,
   `user_id` int(20) not null,
   `order_line_id` int(20) not null,
   `sales_cname` text not null,
   `sales_amount` int(10) not null,
   `sales_onShelves` int(2) not null default '-1',
   `sales_bids_url` text,
   `sales_shipping` int(20),
   `sales_delivery_method` varchar(200),
   `sales_desc` text,
   `sales_contact` varchar(200),
   `creation_date` datetime,
   `update_date` datetime,
   PRIMARY KEY (`sales_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;


CREATE TABLE `user_log` (
   `log_id` int(10) not null auto_increment,
   `log_type` set('trans','login','visit','error') not null,
   `log_desc` varchar(255) not null,
   `log_date` datetime not null,
   `user_id` int(10),
   PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3430;


CREATE TABLE `users` (
   `ID` int(50) not null auto_increment,
   `username` varchar(20) not null,
   `password` varchar(60) not null,
   `user_cname` varchar(10),
   `user_gender` varchar(1) not null,
   `user_address` varchar(100) not null,
   `user_mobile` varchar(20) not null,
   `user_phone` varchar(20),
   `user_email` varchar(100),
   `user_fb` varchar(100),
   `user_ptt` varchar(100),
   `user_gpp` varchar(100),
   `login_counts` int(20),
   `login_date` datetime not null,
   `creation_date` datetime not null,
   `update_date` datetime not null,
   PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=196;