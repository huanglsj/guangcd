<?php
namespace app\common\model;
use think\Db;
use think\Model;
class SiteSet extends Model{

    public function select()
    {
        $site = Db::table("gc_site_set")->select();
        return $site;
    }
}
?>