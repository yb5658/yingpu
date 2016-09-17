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

);
