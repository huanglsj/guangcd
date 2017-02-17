<?php
namespace app\admin\model;
use think\Db;
use think\Model;
class User extends Model{

    public static function login($username,$password)
    {
        $user = User::where(array('status' => 1,'nick_name'=>$username,'password'=>$password))->field('id,nick_name')->find()->toArray();
        return $user;
    }

    public function select()
    {
        $select = User::paginate(10);
        return $select;
    }
}
?>