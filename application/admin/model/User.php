<?php
namespace app\admin\model;
use think\Db;
use think\Model;
class User extends Model{

    public static function login($username,$password)
    {
        $user = User::where(array('status' => 1,'nick_name'=>$username,'password'=>$password))->field('id,nick_name')->find();
        return $user;
    }

    public function select($search)
    {
        $where['nick_name ']= array('like','%'.$search.'%');
        $select = User::where($where)->paginate(10,false,[
            'query' => array('search'=>$search),
        ]);
        return $select;
    }
}
?>