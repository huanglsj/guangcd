<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\tool\JsonParser;
use think\Controller;

class User extends AdminBase
{
    public function index()
    {
        $model = new \app\admin\model\User();
        $model = $model->select();
        $page = $model->render();
        $this->assign('list', $model);
        $this->assign('page', $page);
        return $this->fetch();
    }

    public function select(){
        $model = new \app\admin\model\User();
        $model = $model->select();
        JsonParser::GenerateJsonResult('0008',$model);
    }
}
