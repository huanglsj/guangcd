<?php
namespace app\admin\controller;
use app\admin\model\User;
use app\common\tool\JsonParser;
use think\Controller;
use think\Session;

class Login extends Controller
{
    public function index()
    {
        if (session('user')) {
            $this->redirect('/admin/');
            return;
        }
        return $this->fetch();
    }

    //登录验证
    public function logining()
    {
        $username = $_POST['name'];
        $password = md5($_POST['password']);
        $captcha = $_POST['captcha'];
        if($username==''){
            JsonParser::GenerateJsonResult('0000','用户名不能为空！');
            return;
        }
        if($password==''){
            JsonParser::GenerateJsonResult('0000','密码不能为空！');
            return;
        }
        if($captcha==''){
            JsonParser::GenerateJsonResult('0000','验证码不能为空！');
            return;
        }

        if(!captcha_check($captcha)){
            JsonParser::GenerateJsonResult('0001','验证码不正确！');
            return;
        };

        $model = new User();
        $check = $model->login($username,$password);
        if($check){
            session("user", $check);
            JsonParser::GenerateJsonResult('0008','验证成功！');
        }else{
            JsonParser::GenerateJsonResult('0000','用户名或密码不正确！');
        }
    }

    // 退出登录
    public function logout(){
        Session::delete("user");
        JsonParser::GenerateJsonResult('0008','退出成功！');
    }

    function captcha_img($id = "")
    {
        return '<img src="' . captcha_src($id) . '" alt="captcha" />';
    }
}
