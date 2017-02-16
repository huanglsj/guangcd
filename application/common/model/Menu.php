<?php
namespace app\common\model;
use think\Db;
use think\Model;
class Menu extends Model{

    //前台菜单
    public function menu($type)
    {
        $menu = Db::table("gc_menu")->where(array('status' => 1,'type'=>$type,'parent_id'=>0))->order('sort asc')->select();
        $list=array();
        foreach($menu as $arr){
            $child = $this->SidType($arr['id']);
            $arr['child'] = $child;
            array_push($list,$arr);
        }
        return $list;
    }

    function SidType($id){
        $menu = Db::table("gc_menu")->where(array('status' => 1,'type'=>0,'parent_id'=>$id))->order('sort asc')->select();
        return $menu;
    }
}
?>