<?php

namespace System\Common;

class IController extends \Think\Controller
{
    public function _initialize()
    {
        //批量添加配置
        $config = S('DB_CONFIG_DATA');
        if (!$config) {
            $config = D('Admin/Config')->lists();
            S('DB_CONFIG_DATA', $config);
        }
        C($config);

        // 执行类初始化方法最好不要用__construct
        $this->_init();
    }

    protected function _init()
    {
        is_login() || $this->redirect('Home/Index/index');
    }
}
