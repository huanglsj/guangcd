<?php
namespace app\common\model;
use think\Db;
use think\Model;
class Site extends Model{

    public function select($type)
    {
        $site = Db::table("gc_site")->where(array('status' => 1,'type'=>$type))->order('sort asc')->select();
        return $site;
    }
}
?>