-- 创建数据库 s42_shop

CREATE DATABASE IF NOT EXISTS `s42_shop`;

-- 使用数据库 选择

USE s42_shop;

-- 创建用户表 s42_user

CREATE TABLE IF NOT EXISTS `s42_user`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE,
    password CHAR(32) NOT NULL,
    sex TINYINT NOT NULL DEFAULT 0,
    type TINYINT NOT NULL DEFAULT 0, -- 0 用户 1 普通管理员 2 admin
    display TINYINT NOT NULL DEFAULT 0 -- 0 开启 1 禁止
    )ENGINE=MyISAM DEFAULT CHARSET=utf8;

    --新增登陆次数列
    ALTER TABLE `s42_user` ADD login INT NOT NULL DEFAULT 0;
    --新增积分管理
    ALTER TABLE `s42_user` ADD points INT NOT NULL DEFAULT 0;

-- 添加超级管理员

INSERT INTO s42_user VALUES(NULL,'admin',md5('333'),0,2,0);

-- 创建用户表 s42_category

CREATE TABLE IF NOT EXISTS `s42_category`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE,
    pid INT UNSIGNED,
    path VARCHAR(255),
    display INT NOT NULL DEFAULT 0 -- 0显示 1不显示
    )ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建商品表 s42_goods

CREATE TABLE IF NOT EXISTS `s42_goods`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    cate_id INT UNSIGNED NOT NULL, -- 分类id
    price  DECIMAL(10,2) NOT NULL DEFAULT 0, -- 商品价格
    stock INT NOT NULL DEFAULT 0 , -- 商品库存
    `status` TINYINT NOT NULL DEFAULT 0, -- 商品状态 0 下架 1 上架
    is_hot TINYINT NOT NULL DEFAULT 0, -- 是否热销 0 不热 1 热
    is_new TINYINT NOT NULL DEFAULT 0, -- 是否新品 0 破烂 1 新
    is_best TINYINT NOT NULL DEFAULT 0, -- 是否精品 0 不精 1 精
    addtime INT UNSIGNED NOT NULL DEFAULT 0, -- 首次添加时间
    `describe` TEXT  -- 商品详情
    )ENGINE=MyISAM DEFAULT CHARSET=utf8;

    -- 新增访问列
    ALTER TABLE `s42_goods` ADD visit INT NOT NULL DEFAULT 0 AFTER `describe`;
    

-- 创建商品图片表 s42_image

CREATE TABLE IF NOT EXISTS `s42_image`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL DEFAULT '', -- 图片名称
    goods_id INT UNSIGNED NOT NULL DEFAULT 0, 
    is_face TINYINT NOT NULL DEFAULT 1 -- 1是脸 0 不是脸
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建订单表
CREATE TABLE IF NOT EXISTS `s42_order`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_num VARCHAR(255) NOT NULL DEFAULT 0,
    receiver VARCHAR(255) NOT NULL DEFAULT '',
    address VARCHAR(255) NOT NULL DEFAULT '',
    email VARCHAR(255) NOT NULL DEFAULT '',
    tel VARCHAR(255) NOT NULL DEFAULT '',
    zip VARCHAR(255) NOT NULL DEFAULT '',
    user_id INT NOT NULL,
    price_total INT NOT NULL DEFAULT 0,
    status TINYINT NOT NULL DEFAULT 1  -- 1 未付款 2 已付款未发货 3 已付款已发货 4 收货 5 评论
    )ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建订单商品表
CREATE TABLE IF NOT EXISTS `s42_order_goods`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    goods_id VARCHAR(255) NOT NULL DEFAULT 0,
    name VARCHAR(255) NOT NULL DEFAULT '',
    price INT NOT NULL DEFAULT 0,
    qty INT NOT NULL DEFAULT 0,
    order_id VARCHAR(255) NOT NULL DEFAULT ''
    )ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建用户头像表
CREATE TABLE IF NOT EXISTS `s42_user_image`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL, -- 图片名
    user_id INT NOT NULL    -- 用户id
    )ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建商品评论表
CREATE TABLE IF NOT EXISTS `s42_goods_comment`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(255) NOT NULL DEFAULT '',
    goods_id INT NOT NULL,
    user_id INT NOT NULL,
    user_name VARCHAR(255) NOT NULL
    )ENGINE=MyISAM DEFAULT CHARSET=utf8;
