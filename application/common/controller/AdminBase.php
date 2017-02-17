<?php
namespace app\common\controller;

use think\Controller;

class AdminBase extends Controller
{

    public function __construct()
    {
        parent::__construct();
        // 当前位置
        if (!session('user')) {
            return $this->success('您未登陆！请马上登陆', '/admin/login/index');
        }
        $user = session('user');
        $this->assign('user', $user);
    }

}
