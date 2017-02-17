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

    //修改数据
    public function amend($name,$address,$acronym,$icp,$tel,$time,$description,$keywords){
        $amend = SiteSet::save([
            'name' => $name,
            'address' => $address,
            'acronym' => $acronym,
            'icp' => $icp,
            'tel' => $tel,
            'time' => $time,
            'description' => $description,
            'keywords' => $keywords,
        ],['id' => 1]);

        return $amend;
    }
}
?>