<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Loader;
use think\View;

class Base extends Controller
{
   function _initialize()
   {
       $this->right();
        $cates=Db::name('cate')->order('id asc')->select();
       $tagres=db('tags')->order('id desc')->select();
       $this->assign(array(
           'cates'=>$cates,
           'tagres'=>$tagres
       ));
   }
    public function right(){
        $clickres=db('article')->order('click desc')->limit(8)->select();
        $tjres=db('article')->where('state','=',1)->order('click desc')->limit(8)->select();
        $this->assign(array(
            'clickres'=>$clickres,
            'tjres'=>$tjres
        ));
    }


}
