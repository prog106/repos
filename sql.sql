﻿create table cron_data (
id int(11) not null auto_increment,
site_code varchar(20) not null,
site varchar(200) not null,
read_date datetime not null,
primary key (`id`),
key `site_code` (`site_code`),
key `read_date` (`read_date`)
) engine=innodb charset=utf8 comment='batch log';

create table rss_data (
id int(11) not null auto_increment,
site_id int(11) not null,
d_no varchar(20) not null,
d_name varchar(100) not null,
d_desc1 varchar(200) not null,
d_desc2 varchar(200) not null,
d_url varchar(100) not null,
d_murl varchar(100) not null,
d_img1 varchar(100) not null,
d_img2 varchar(100) not null,
d_img3 varchar(100) not null,
d_st_date datetime not null,
d_ed_date datetime not null,
d_use_st_date datetime not null,
d_use_ed_date datetime not null,
d_origin_price int(11) not null,
d_sale_price int(11) not null,
d_discount_rate tinyint not null,
d_max_sell_cnt int(11) not null,
d_now_sell_cnt int(11) not null,
d_min_buy_cnt int(11) not null,
d_max_buy_cnt int(11) not null,
d_area1 varchar(20) not null,
d_area2 varchar(20) not null,
d_cate1 varchar(20) not null,
d_cate2 varchar(20) not null,
d_vendor_name varchar(30) not null,
d_vendor_phone1 varchar(16) not null,
d_vendor_phone2 varchar(16) not null,
d_vendor_addr varchar(16) not null,
d_vendor_lat varchar(16) not null,
d_vendor_lng varchar(16) not null,
primary key (`id`),
key `site_id` (`site_id`),
key `d_st_date` (`d_st_date`),
key `d_ed_date` (`d_ed_date`)
) engine=innodb charset=utf8 comment='rss data';
