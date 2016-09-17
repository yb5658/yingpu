<?php

namespace System\Model;

use Think\Model;

class SystemUserModel extends Model
{
    protected $fields = array('id', 'sid', 'user', 'mobile', 'pass', 'group_id', 'sex', 'wechat', 'avatar', 'number', 'xueke', 'alleow_print', 'ctime', 'utime', 'login', 'last_login_time', 'last_login_ip');

    /* 自动验证 */
    protected $_validate = array(
        array('user', 'require', '用户名必填!', 1, '', 4),
        array('pass', 'require', '密码必填！', 1, '', 4),
    );

    /* 自动完成 */
    protected $_auto = array(
        array('create_time', NOW_TIME, 1),
        array('update_time', NOW_TIME, 3),
        array('status', 0),
    );

    // 添加
    public function input()
    {
        if (!$this->create($_POST, 1)) {
            return false;
        } else {
            return $this->add();
        }
    }
    // 更新
    public function update()
    {
        if (!$this->create($_POST, 2)) {
            return false;
        } else {
            return $this->save($data);
        }
    }

    public function login()
    {
        if (!$this->create('', 4)) {
            return false;
        }
        $user = $this->where(array('user' => I('user')))->find();
        if (empty($user)) {
            $this->error = '用户名不存在';

            return false;
        }
        if (!$user['status']) {
            $this->error = '用户已经离校';

            return false;
        }
        if ($user['pass'] != password_md5(I('pass'))) {
            $this->error = '密码错误！';

            return false;
        }
        /* 更新登录信息 */
        $data = array(
            'id' => $user['id'],
            'login' => array('exp', '`login`+1'),
            'last_login_time' => NOW_TIME,
            'last_login_ip' => get_client_ip(1),
        );
        $this->save($data);
        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid' => $user['id'],
            'username' => $user['user'],
            'last_login_time' => $user['last_login_time'],
        );
        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));

        return true;
    }

    /* 注销当前用户 */
    public function logout()
    {
        session('user_auth', null);
        session('user_auth_sign', null);
    }
}
