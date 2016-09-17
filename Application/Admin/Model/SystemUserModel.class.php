<?php

namespace Admin\Model;

use Think\Model;

class SystemUserModel extends Model
{
    // 自动验证
    protected $_validate = array(
        array('group_id', 'require', '角色分组必填！'),
        array('name', 'require', '用户名必填!'),
        array('name', '', '用户名必填!', 0, 'unique', 1),
        array('pass', 'require', '用户密码必填！', 0, '', 1),
        array('mobile', 'require', '手机号必填！'),
    );
    // 自动完成
    protected $_auto = array(
        array('pass', 'callbackMd5', 3, 'callback'),
        array('ctime', NOW_TIME, 1),
        array('utime', NOW_TIME, 3),
        array('status', 1),
    );

    public function callbackMd5($data) {
        if ($data) {
            return password_md5($data);
        } else {
            return '';
        }
    }

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
        $data = $this->create($_POST, 2);
        if (!$data) {
            return false;
        } else {
            if (empty($data['pass'])) {
                unset($data['pass']);
            }
            return $this->save($data);
        }
    }
}
