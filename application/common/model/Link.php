<?php
namespace app\common\model;
use think\Db;
use think\Model;
class Link extends Model{

    //友情链接
    public function select()
    {
        $link = Db::table("gc_link")->where(array('status' => 1))->order('sort asc')->select();
        return $link;
    }
}
?>