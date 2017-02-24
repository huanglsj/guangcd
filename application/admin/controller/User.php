<?php
namespace app\admin\controller;

use app\admin\model\Role;
use app\common\controller\AdminBase;
use app\common\tool\JsonParser;
use app\common\tool\Upload;
use think\console\Input;
use think\Controller;
use think\Request;
use think\Session;

class User extends AdminBase
{
    public function index()
    {
        $search = Request::instance()->param("search");
        $model = new \app\admin\model\User();
        $model = $model->select($search);
        $page = $model->render();
        $this->assign('list', $model);
        $this->assign('page', $page);
        return $this->fetch();
    }

    //添加用户视图
    public function add()
    {
        return $this->fetch();
    }

    //检查用户是否存在
    public function isName()
    {
        $model = new \app\admin\model\User();
        $nickname = Request::instance()->param("nickname");
        $model = $model->nameIsExist($nickname);
        if ($model) {
            echo json_encode(array(
                'valid' => false,
            ));
        } else {
            echo json_encode(array(
                'valid' => true,
            ));
        }
    }

    //添加用户请求
    public function requestAddUser()
    {
        $nickname = Request::instance()->param("nickname");
        $password = md5(Request::instance()->param("password"));
        $role = Request::instance()->param("role");
        $realname = Request::instance()->param("realname");
        $email = Request::instance()->param("email");
        $mobile = Request::instance()->param("mobile");
        $url = Request::instance()->param("url");
        $model = new \app\admin\model\User();
        $is = $model->nameIsExist($nickname);
        if ($is) {
            JsonParser::GenerateJsonResult('0000', '昵称已存在');
            return;
        }
        if (empty($nickname) || empty($password) || empty($role)) {
            JsonParser::GenerateJsonResult('0000', '不能为空');
            return;
        }
        if ($role == 1) {
            JsonParser::GenerateJsonResult('0000', '无权添加');
            return;
        }

        $roleModel = new Role();
        $roleModel = $roleModel->isExist($role);
        if (!$roleModel) {
            JsonParser::GenerateJsonResult('0000', '角色不存在');
            return;
        }

        if (empty($url)) {
            $url = '/static/upload/head/default.png';
        }
        $model->addUser($nickname, $password, $role, $realname, $email, $url, $mobile);
        JsonParser::GenerateJsonResult('0008', '添加成功');
    }

    //用户上传头像
    public function uploadImg()
    {
        $upload = new Upload();
        $file = $upload->uploadHead();
        return $file;
    }

    //更改用户状态
    public function changeStatus()
    {
        $id = Request::instance()->param("id");
        $model = new \app\admin\model\User();
        $is = $model->idIsExist($id);
        if ($is) {
            $status = $is['status'];
            $status = $status == 1 ? 0 : 1;
            $model->idChangeStatus($id, $status);
            JsonParser::GenerateJsonResult('0008', '状态修改成功');
        } else {
            JsonParser::GenerateJsonResult('0000', '用户不存在');
        }
    }

    //编辑用户页面
    public function edit()
    {
        $userRole = session('user');
        $id = Request::instance()->param("id");
        $model = new \app\admin\model\User();
        $model = $model->idIsExist($id);
        if ($model) {
            if ($model['role'] == 1 && $userRole['role'] != 1) {
                $this->error('你无权限操作这个用户');
                return;
            }else{
                $this->assign('edit', $model);
                return $this->fetch();
            }
        } else {
            $this->error('用户不存在');
        }
    }

    // 编辑用户请求
    public function requestEditUser()
    {
        $id = Request::instance()->param("id");
        $password = md5(Request::instance()->param("password"));
        $role = Request::instance()->param("role");
        $realname = Request::instance()->param("realname");
        $email = Request::instance()->param("email");
        $mobile = Request::instance()->param("mobile");
        $url = Request::instance()->param("url");
        $model = new \app\admin\model\User();
        $is = $model->idIsExist($id);

        if (empty($id) || empty($password) || empty($role)) {
            JsonParser::GenerateJsonResult('0000', '不能为空');
            return;
        }

        if (!$is) {
            JsonParser::GenerateJsonResult('0000', '用户不存在');
            return;
        }

        if ($role == 1) {
            JsonParser::GenerateJsonResult('0000', '无权添加');
            return;
        }

        $roleModel = new Role();
        $roleModel = $roleModel->isExist($role);
        if (!$roleModel) {
            JsonParser::GenerateJsonResult('0000', '角色不存在');
            return;
        }

        if (empty($url)) {
            $url = '/static/upload/head/default.png';
        }

        if($is['role']==1){
            $role = 1;
        }
        $model->editUser($id, $password, $role, $realname, $email, $url, $mobile);
        $userRole = session('user');
        if($id==$userRole['id']){
            Session::delete("user");
            JsonParser::GenerateJsonResult('0007', '编辑成功');
            return;
        }
        JsonParser::GenerateJsonResult('0008', '编辑成功');
    }

    //检测用户是否有权限编辑
    public function isEdit()
    {
        $userRole = session('user');
        $id = Request::instance()->param("id");
        $model = new \app\admin\model\User();
        $model = $model->idIsExist($id);
        if ($model) {
            if ($model['role'] == 1) {
                if ($userRole['role'] != 1) {
                    JsonParser::GenerateJsonResult('0000', '你无权限操作这个用户');
                    return;
                }
                JsonParser::GenerateJsonResult('0008', '');
            } else {
                JsonParser::GenerateJsonResult('0008', '');
            }
        } else {
            JsonParser::GenerateJsonResult('0000', '用户不存在');
        }
    }

//    public function pic()
//    {
//        return $this->fetch();
//    }
//
//    public function pic1()
//    {
//        return $this->fetch();
//    }
//
//    public function upload(){
//        $upload = new Upload1();
//
//        //设置上传文件大小
//        $upload->maxSize = 3292200;
////设置上传文件类型
//        $upload->exts = explode(',', 'jpg,gif,png,jpeg');
////设置附件上传目录
//        $upload->savePath = './static/upload/head/';
////设置需要生成缩略图，仅对图像文件有效
////        $upload->thumb = true;
//// 设置引用图片类库包路径
////        $upload->imageClassPath = '@.ORG.Image';
////设置需要生成缩略图的文件后缀
////        $upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
////设置缩略图最大宽度
////        $upload->thumbMaxWidth = '400,100';
////设置缩略图最大高度
////        $upload->thumbMaxHeight = '400,100';
////设置上传文件规则
//        $upload->saveName = 'uniqid';
////删除原图
////        $upload->thumbRemoveOrigin = true;
//        if (!$upload->upload()) {
//            //捕获上传异常
//            $this->error($upload->getError());
//        } else {
//            //取得成功上传的文件信息
//            $uploadList = $upload->upload();
//            var_dump($uploadList);
//        }
//
//    }
//
//    public function imgUpload(){
//
//        $file = $_FILES['head'];
//        $flag = true;
//        $fileName=$file['name'];
//        $error=$file['error'];
//        $arr1 = explode('.', $fileName);
//        $ext1 = $arr1[count($arr1) - 1];
//        $tmp_name = $file['tmp_name'];
//
//        if (in_array($ext1, ['gif', 'jpg', 'jpeg', 'bmp', 'png'])) {
//
//
//            if(!is_uploaded_file($tmp_name)){
//                echo "文件不是通过HTTP POST方式上传上来的";
//                exit;
//            }
//
//            //是否为真实的图片类型
//            if($flag){
//                if(!getimagesize($tmp_name)){
//                    echo "文件不是真正的图片";
//                    exit;
//                }
//            }
//
//           //$imginfo =  getimagesize($fileName);
////            var_dump($file['tmp_name']);
////           $imginfo = getimagesize($file['tmp_name']);
////
////            //if (empty($imginfo) || ('gif' == $ext1 && empty($imginfo['bits']))) {
////                JsonParser::GenerateJsonResult('_0001','非法文件');
////                return;
//            //}
//        }else{
//            JsonParser::GenerateJsonResult('_0001','格式不对');
//            return;
//        }
//
//        if($error==UPLOAD_ERR_INI_SIZE){
//            JsonParser::GenerateJsonResult('_0001','上传的文件过大，请换一个');
//            exit;
//        }
//        if($error==UPLOAD_ERR_OK) {
//            $arr = explode('.', $fileName);
//            $ext = '.' . $arr[count($arr) - 1];
//            $tmp = $_FILES["head"]["tmp_name"];
//            $path = pathinfo($tmp);
//            $path = str_replace('.tmp', $ext, $path['basename']);
////                $path=$this->resizeImage($path,$path,360,360);
////                print_r($path);
//            if (move_uploaded_file($tmp, ROOT_PATH .'public/static/upload/head/' . $path)) {
//                JsonParser::GenerateJsonResult('imgUrl', '/public/static/upload/head/' . $path);
//                exit;
//            } else {
//                JsonParser::GenerateJsonResult('_0001', '上传文件失败，请重试');
//                exit;
//            }
//        }
//        else{
//            JsonParser::GenerateJsonResult('_0001', '上传文件失败，请重试');
//            exit;
//        }
//
//    }
//
//    public function uu(){
//        $upload = new Img();
//        $upload = $upload->upload();
//        return $upload;
//    }

}
