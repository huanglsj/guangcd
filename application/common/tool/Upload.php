<?php
namespace app\common\tool;
class Upload {
    public function uploadHead(){
        $file = request()->file('file');
        if($file){
            $info = $file->validate(['size'=>1048576,'ext'=>'jpg,png,gif','type' => 'image/jpeg,image/gif,image/png'])->rule('uniqid')->move(ROOT_PATH .'public/static/upload/head');
            if ($info) {
                $url = '/static/upload/head/'.$info->getFilename();
                JsonParser::GenerateJsonResult('0008',$url);
            } else {
                JsonParser::GenerateJsonResult('0000',$file->getError());
            }
        }else{
            JsonParser::GenerateJsonResult('0000','上传出错');
        }


    }
}