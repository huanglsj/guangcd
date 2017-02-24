<?php
namespace app\admin\model;
use think\Db;
use think\Model;
class Role extends Model{

 //检测是否存在这个用户组
    public function isExist($id){
        $where['id'] = $id;
        $role = Role::where($where)->find();
        return $role;
    }

}
?>