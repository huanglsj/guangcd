<?php
namespace app\index\controller;
use app\common\controller\IndexBase;
use think\Controller;

class Index extends IndexBase
{
    public function index()
    {
        $arr = array(
            'title' => '天津广川科技有限公司',
        );
        $this->assign($arr);
        return $this->fetch();
    }
}
