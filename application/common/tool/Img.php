<?php
namespace app\common\tool;
class Img {

    public function upload(){
        var_dump($_FILES);
        $fileInfo = $_FILES['head'];

        if($fileInfo){
        $filename = $fileInfo['name'];
        $type = $fileInfo['type'];
        $tmp_name = $fileInfo['tmp_name'];
        $size = $fileInfo['size'];

        $error = $fileInfo['error'];
            var_dump($error);
        $maxSize = 2097152;
        $allowExt = array('jpeg','png','gif','jpg');
        $flag = true;
        if($error==0){
            if($size>$maxSize){
                echo "上传文件过大";
                exit;
            }
            $ext = strtolower(end(explode('.',$filename)));//或
//    $ext = pathinfo($filename,PATHINFO_EXTENSION);
            if(!in_array($ext,$allowExt)){
                echo "非法文件类型";
                exit;
            }
            if(!is_uploaded_file($tmp_name)){
                echo "文件不是通过HTTP POST方式上传上来的";
                exit;
            }
            //是否为真实的图片类型
            if($flag){
                if(!getimagesize($tmp_name)){
                    echo "文件不是真正的图片";
                    exit;
                }
            }
            $path = ROOT_PATH .'public/static/upload/head/';
            if(file_exists($path)){
                mkdir($path,0777,true);
                chmod($path,0777);
            }
            $uniName = md5(uniqid(microtime(true),true)).'.'.$ext;
            $destination = $path.'/'.$uniName;
            if(move_uploaded_file($tmp_name,$destination)){
                echo "文件上传成功";
            }else{
                echo "文件上传失败";
            }
        }else {
            switch ($error) {
                case 1:
                    echo "上传文件超过了php配置upload_max_filesize选项的值";
                    break;
                case 2:
                    echo "上传文件超过了表单max_file_size限制的值";
                    break;
                case 3:
                    echo "文件部分上传";
                    break;
                case 4:
                    echo "没有选择上传文件";
                    break;
                case 6:
                    echo "没有找到临时目录";
                    break;
                case 7:
                case 8:
                    echo "系统错误";
                    break;
            }
        }
    }else{
            echo "不是图片文件";
        }
    }


}