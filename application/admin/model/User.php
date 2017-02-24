<?php
namespace app\admin\model;

use think\Db;
use think\Model;

class User extends Model
{

    public static function login($username, $password)
    {
        $user = User::where(array('nick_name' => $username, 'password' => $password))->field('id,nick_name,role,status')->find();
        return $user;
    }

    public function select($search)
    {
        $where['nick_name'] = array('like', '%' . $search . '%');
        $select = User:: join("role", "gc_role.id = gc_user.role")->where($where)->field('gc_user.id,gc_user.nick_name,gc_user.email,gc_user.mobile,gc_user.create_time,gc_user.status,gc_user.role,role.id as role_id,role.name as role_name')->order('create_time', 'desc')->paginate(10, false, [
            'query' => array('search' => $search),
        ]);
        return $select;
    }

    public function role()
    {
        return $this->hasOne('role');
    }

    //根据昵称查找用户是否存在
    public function nameIsExist($name)
    {
        $where['nick_name'] = $name;
        $user = User::where($where)->find();
        return $user;
    }

    public function addUser($nickname, $password, $role, $realname, $email, $head, $mobile)
    {
        $this->nick_name = $nickname;
        $this->password = $password;
        $this->role = $role;
        $this->real_name = $realname;
        $this->email = $email;
        $this->head_url = $head;
        $this->mobile = $mobile;
        $this->save();
    }

    public function editUser($id, $password, $role, $realname, $email, $head, $mobile)
    {
        $this->save([
            'password'=>$password,
            'role'=>$role,
            'real_name'=>$realname,
            'email'=>$email,
            'head_url'=>$head,
            'mobile'=>$mobile
        ],['id'=>$id]);
    }

    //根据id查询这个用户是否存在
    public function idIsExist($id)
    {
        $where['id'] = $id;
        $select = User::where($where)->find();
        return $select;
    }

    //根据id改变用户状态
    public function idChangeStatus($id, $status)
    {
        $where['id'] = $id;
        $select = User::get($id);
        $select->status = $status;
        $select->save();
    }

}

?>