<?php
namespace app\common\model;
use think\Db;
use think\Model;
class Role extends Model{

    public function select()
    {
        $where['id'] = array('neq',1);
        $where['status'] = 1;
        $role = Db::table("gc_role")->where($where)->select();
        return $role;
    }
}
?>