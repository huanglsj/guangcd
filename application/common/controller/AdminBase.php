<?php
namespace app\common\controller;

use app\common\model\Role;
use think\Controller;

class AdminBase extends Controller
{

    public function __construct()
    {
        parent::__construct();
        // 当前位置
        $user = session('user');
        if ($user && ($user['role'] == 1 || $user['role'] == 2)) {
            $this->assign('user', $user);
            $role = $this->roleselect();
            $this->assign('roleList', $role);
        } else {
            return $this->success('您未登陆！请马上登陆', '/admin/login/index');
        }

    }

    public function roleselect()
    {
        $role = new Role();
        $role = $role->select();
        return $role;
    }

}
