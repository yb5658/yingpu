<?php
// 教务系统
namespace System\Controller;

use System\Common\IController;

class JiaowuController extends IController
{
    protected function _init()
    {
        is_login() || $this->redirect('Home/Index/index');
        $uid = is_login();
        $user_info = D('SystemUser')->getUserInfoById($uid);
        $this->assign('user_info', $user_info);
    }
    // 教务管理首页
    public function index()
    {
        $this->display();
    }
    // 基础设置
    public function settings()
    {
        $this->display();
    }
    // 帐号管理
    public function account()
    {
        $this->display();
    }
    // 班级管理
    public function banji()
    {
        $this->display();
    }
    // 学员管理
    public function student()
    {
        $this->display();
    }
    // 考勤管理
    public function kaoqin()
    {
        $this->display();
    }
    // 购买教材
    public function jiaocai()
    {
        $this->display();
    }
}
