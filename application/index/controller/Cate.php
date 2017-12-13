<?php
namespace app\index\controller;
use app\index\model\ImoocUser;
use think\Controller;
use think\Db;
use think\Loader;
use think\View;

class Cate extends Base
{



    public function index()
    {

        $id=input('cateid');
        $cate=Db::name('cate')->find($id);
        $articles=Db::name('article')->where(array('cateid'=>$id))->paginate(3);
        $this->assign('articles',$articles);
        $this->assign('cate',$cate);
      return $this->fetch("list");

    }



}
