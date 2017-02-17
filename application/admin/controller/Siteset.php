<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\common\tool\JsonParser;
use think\Controller;
use think\Request;

//use app\common\model\SiteSet;

class Siteset extends AdminBase
{
    public function index()
    {
        $model = new \app\common\model\SiteSet();
        $model = $model->select();
        $this->assign('set', $model);
        return $this->fetch();
    }

    //修改网站设置
    public function updateData(){
        $name = Request::instance()->param("name");
        $address = Request::instance()->param("address");
        $acronym = Request::instance()->param("acronym");
        $icp = Request::instance()->param("icp");
        $tel = Request::instance()->param("tel");
        $time = Request::instance()->param("time");
        $description = Request::instance()->param("description");
        $keywords = Request::instance()->param("keywords");
        if($name && $address && $acronym && $icp && $tel && $time && $description && $keywords){
            $model = new \app\common\model\SiteSet();
            $model->amend($name,$address,$acronym,$icp,$tel,$time,$description,$keywords);
            JsonParser::GenerateJsonResult('0008','修改成功');
        }else{
            JsonParser::GenerateJsonResult('0000','修改失败');
        }
    }
}
