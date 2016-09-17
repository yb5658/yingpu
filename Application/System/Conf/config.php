<?php
return array(

    /* URL大小写区分 */
    'URL_MODEL' => 2, //0:普通模式,1:PATHINFO模式,2:REWRITE模式,3:兼容模式
    'URL_PATHINFO_DEPR'     =>  '/',

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__COMMON__' => __ROOT__ . '/Public/Common/',
        '__HOME__'   => __ROOT__ . '/Public/Home/',
        '__IMG__'    => __ROOT__ . '/Public/Home/images/',
        '__CSS__'    => __ROOT__ . '/Public/Home/css/',
        '__JS__'     => __ROOT__ . '/Public/Home/js/',
    ),

    /* 后台错误页面模板 */
    'TMPL_ACTION_ERROR'     =>  'Public/error', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  'Public/success', // 默认成功跳转对应的模板文件
    //'TMPL_EXCEPTION_FILE'   =>  'Public/exception',// 异常页面的模板文件

    /* COOKIE参数 */
    'COOKIE_EXPIRE' => 3600,
    'COOKIE_DOMAIN' => '',
    'COOKIE_PREFIX' => 'jfsd_system_',

    /*  SESSION设置 */
    'SESSION_PREFIX'        =>  'jfsd_system_', // session 前缀
);
