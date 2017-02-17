<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Controller;

class Index extends AdminBase
{
    public function index()
    {
        return $this->fetch();
    }
}
