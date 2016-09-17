<?php
// 上学去 控制器
namespace System\Controller;

use System\Common\IController;

class IndexController extends IController
{
    public function _init()
    {
    }

    // 首页
    public function index()
    {
        is_login() || $this->redirect('Home/Index/index');
        $this->display();
    }

    // 登录
    public function login()
    {
        if (is_login()) {
            $this->redirect('Index/index');
        } else {
            if (IS_POST) {
                $SystemUser = D('SystemUser');
                if ($SystemUser->login()) {
                    $this->success('登录成功', U('Index/index'));
                } else {
                    $this->error($SystemUser->getError());
                }
            } else {
                $this->display();
            }
        }
    }

    // 退出登录
    public function logout()
    {
        if (is_login()) {
            D('SystemUser')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('Home/Index/index'));
        } else {
            $this->redirect('Home/Index/index');
        }
    }
}
