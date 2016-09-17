<?php

namespace Admin\Model;

use Think\Model;

class SystemSchollModel extends Model
{
    // 自动验证
    protected $_validate = array(
        array('name', 'require', '校区名称必填!'),
        array('tel', 'require', '校区电话必填！'),
        array('address', 'require', '校区地址必填！'),
    );
    // 自动完成
    protected $_auto = array(
        array('etime', 'callbackEtime', 3, 'callback'),
        array('ctime', NOW_TIME, 1),
        array('utime', NOW_TIME, 3),
        array('status', 1),
    );
    // 结束时间
    public function callbackEtime($data)
    {
        if (empty($data)) {
            return strtotime('+1 year');
        } else {
            return strtotime($data);
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
        if (!$this->create($_POST, 2)) {
            return false;
        } else {
            return $this->save($data);
        }
    }
}
