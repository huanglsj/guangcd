<?php
namespace app\index\controller;
use app\common\controller\IndexBase;
use think\Controller;

class Approach extends IndexBase
{
    public function index()
    {
        $arr = array(
            'title' => '天津广川科技有限公司_走进广川_公司介绍',
        );
        $this->assign($arr);
        return $this->fetch();
    }
}
