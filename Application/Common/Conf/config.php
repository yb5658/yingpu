<?php

return array(
	/* 数据库 */
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '139.129.212.220',
    'DB_PORT' => 3306,
    'DB_USER' => 'yingpu',
    'DB_PWD' => 'yingpu',
    'DB_PREFIX' => 'jfsd_',
    'DB_NAME' => 'jfsd_yingpu',

	/* 默认模块 */
    'DEFAULT_MODULE'    => 'Home',
    'MODULE_ALLOW_LIST' => array('Home','Admin', 'System'),
    'MODULE_DENY_LIST'  => array('Common','Runtime'),

	/* 缓存 */
    'DATA_CACHE_COMPRESS' => true,
    'DATA_CACHE_PREFIX' => 'jfsd_',

	/* COOKIE参数 */
    'COOKIE_EXPIRE' => 3600,
    'COOKIE_DOMAIN' => '',
    'COOKIE_PREFIX' => 'jfsd_',

	/*  SESSION设置 */
    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
    'SESSION_OPTIONS'       =>  array(), // session 配置数组 支持type name id path expire domain 等参数
    'SESSION_TYPE'          =>  '', // session hander类型 默认无需设置 除非扩展了session hander驱动
    'SESSION_PREFIX'        =>  'jfsd_', // session 前缀
);
