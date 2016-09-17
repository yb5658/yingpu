<?php

namespace Admin\Controller;

use Admin\Common\AController;

class SystemController extends AController
{
    private $title = '校区管理';
    private $fields = array(
        'name' => array('primary' => 1, 'type' => 'text', 'title' => '校区名称', 'desc' => '校区名称'),
        'tel' => array('primary' => 1, 'type' => 'text', 'title' => '校区电话', 'desc' => '校区电话'),
        'address' => array('primary' => 1, 'type' => 'textarea', 'title' => '校区地址', 'desc' => '校区地址'),
        'etime' => array('primary' => 1, 'type' => 'time', 'title' => '到期时间', 'desc' => '到期时间，新添加默认1年后到期'),
    );
    public function _init()
    {
        $this->assign('__ACT__', strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/index'));
        $this->meta_head = '<a href="'.U($this->type.'/index').'">'.$this->title.'管理</a>';
        $this->assign('type', CONTROLLER_NAME);
    }
    // 列表
    public function index()
    {
        $map = $search = array(
            'status' => 1,
        );
        $title = I('title');
        if (!empty($title)) {
            $map['name'] = array('like', '%'.$title.'%');
            $search['title'] = $title;
        }
        $list = $this->lists('SystemScholl', $map, 'sort desc, id desc');
        $this->assign('list', $list);
        $this->assign('search', $search);
        $this->meta_title = $this->title.'列表';
        $this->display('System/index');
    }
    // 新增
    public function add()
    {
        if (IS_POST) {
            $SystemScholl = D('SystemScholl');
            if (!$SystemScholl->input()) {
                $this->error($this->db->getError());
            } else {
                action_log();
                $this->updateCache();
                $this->success('新增成功', U('index'));
            }
        } else {
            $this->assign('fields', $this->fields);
            $this->meta_title = '新增'.$this->title;
            $this->display('System/add');
        }
    }
    // 修改
    public function edit($id = 0)
    {
        $SystemScholl = D('SystemScholl');
        if (IS_POST) {
            if (!$SystemScholl->update()) {
                $this->error($this->db->getError());
            } else {
                action_log();
                $this->updateCache();
                $this->success('更新成功', U('index'));
            }
        } else {
            $info = $SystemScholl->find($id);
            if (!$info) {
                $this->error('不存在！');
            }
            $this->assign('info', $info);
            $this->assign('fields', $this->fields);
            $this->meta_title = '更新'.$this->title;
            $this->display('System/add');
        }
    }
    // 删除
    public function del()
    {
        $id = array_unique((array) I('id', 0));
        //print_r($id); exit;
        if (empty($id)) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('id' => array('in', $id));
        if (D('SystemScholl')->where($map)->delete()) {
            action_log();
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
    // 用户管理列表
    public function userLists($sid)
    {
        $sid || $this->error('校区id不能为空');
        $map = $search = array(
            'status' => 1,
            'sid' => $sid,
        );
        $title = I('title');
        if (!empty($title)) {
            $map['user'] = array('like', '%'.$title.'%');
            $search['title'] = $title;
        }
        $list = $this->lists('SystemUser', $map, 'sort desc, id desc');
        $this->assign('list', $list);
        $this->assign('sid', $sid);
        $this->assign('search', $search);
        $this->meta_title = $this->title.'-用户列表';
        $this->display();
    }
    // 用户添加
    public function userAdd($sid)
    {
        $sid || $this->error('校区id不能为空');
        if (IS_POST) {
            $SystemUser = D('SystemUser');
            if (!$SystemUser->input()) {
                $this->error($SystemUser->getError());
            } else {
                $this->success('成功');
            }
        } else {
            $info['sid'] = $sid;
            $this->assign('info', $info);
            $this->display();
        }
    }
    // 用户修改
    public function userEdit($id)
    {
        $id || $this->error('用户id不能为空');
        $SystemUser = D('SystemUser');
        if (IS_POST) {
            if (!$SystemUser->update()) {
                $this->error($SystemUser->getError());
            } else {
                $this->success('成功');
            }
        } else {
            $info = $SystemUser->find($id);
            if (empty($info)) {
                $this->error('不存在');
            }
            $this->assign('info', $info);
            $this->display('System/userAdd');
        }
    }
    // 用户删除
    public function userdel($id)
    {
        $id = array_unique((array) I('id', 0));
        if (empty($id)) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('id' => array('in', $id));
        if (D('SystemUser')->where($map)->delete()) {
            action_log();
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    /* 更新缓存 */
    protected function updateCache()
    {
    }
}
