<?php
namespace Admin\Controller;
use Admin\Common\AController;
class IndexController extends AController {
    public function _init () {
        $this->assign('__ACT__', strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/index'));
        $this->meta_head = '<a href="'.U('Index/index').'">网站首页</a>';
    }

    /* 空操作 */
    public function _empty(){
        $this->meta_title = '空操作';
        $this->display('index');
    }

    /* 网站首页 */
    public function index(){
        $this->meta_title = '网站首页';
        $this->display();
    }

    /* 帮助中心 */
    public function help(){

        $this->meta_title = '帮助中心';
        $this->display();
    }

    /* 修改个人密码 */
    public function editPassword(){
        if (IS_POST) {
            $password = I('post.password', '', 'password_md5');
            if ($password) {
                $data = array(
                    'user_id' => UID,
                    'password' => $password,
                    'utime' => NOW_TIME
                );

                $result = D('Admin')->save($data);
                if ($result) {
                    $this->success('密码修改成功');
                } else {
                    $this->error('失败');
                }
            } else {
                $this->error('密码不能为空');
            }
        } else {
            $this->meta_title = '修改密码';
            $this->display();
        }
    }

    /* 更新全站缓存 */
    public function deleteCache() {
        delete_dir(RUNTIME_PATH);
        $this->success('更新成功');
    }
}
