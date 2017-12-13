<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends Base
{
    public function index()
    {   $cate=Db::name('cate')->select();
        $id=$cate[0]['id'];
        $articles=Db::name('article')->where(array('cateid'=>$id))->paginate(3);
        $this->assign('articles',$articles);
        $this->assign('cate',$cate[0]);
        return $this->fetch();

    }



}
