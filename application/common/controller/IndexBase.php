<?php
namespace app\common\controller;

use app\common\model\Link;
use app\common\model\Menu;
use app\common\model\Site;
use app\common\model\SiteSet;
use think\Controller;

class IndexBase extends Controller
{

    public function __construct()
    {
        parent::__construct();
        // 当前位置
        $this->nav();//导航
        $this->link(); //友情链接
        $this->siteSet();  //网站设置
        $this->site();   //自己的网站
        $this->otherSite(); //其他网站
    }

    /**
     * 获取当前位置  面包屑导航
     * @author Zcc<2351976426@qq.com>
     * @dateTime 2016-10-18
     * @return   [type] [description]
     */
    protected function getBreadcrumb()
    {
        $breadcrumb = [];
        $request = Request::instance();
        $rule = $request->controller() . '/' . $request->action();//拼接控制器和方法

        $isHere = Db::table('rule')->field('parent_id,title,name')->where('name', $rule)->find();
        if (empty($isHere)) {
            return false;
        }
        //如果没有父类就自己存到数组，如果有再取一次存到数组
        if ($isHere['parent_id'] !== 0) {
            $breadcrumb[] = Db::table('rule')->field('parent_id,title,name')->where('id', $isHere['parent_id'])->find();
        }
        $breadcrumb[] = $isHere;
        $this->assign('breadcrumb', $breadcrumb);
    }

    //前台菜单
    protected function nav()
    {
        $model = new Menu();
        $type = 0; //前台菜单类型
        $model = $model->menu($type);
        $this->assign('menu', $model);
    }

    //友情链接
    public function link(){
        $model = new Link();
        $model = $model->select();
        $this->assign('link', $model);
    }

    //网站设置
    public  function  siteSet(){
        $model = new SiteSet();
        $model = $model->select();
        $this->assign('set', $model);
    }

    //集团旗下网站列表
    public  function  site(){
        $model = new Site();
        $type = 0;
        $model = $model->select($type);
        $this->assign('selfSite', $model);
    }

    //集团旗下网站列表
    public  function  otherSite(){
        $model = new Site();
        $type = 1;
        $model = $model->select($type);
        $this->assign('otherSite', $model);
    }

}
