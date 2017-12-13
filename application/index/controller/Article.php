<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Loader;
use think\View;

class Article extends Base
{



    public function index()
    {
        $id=input('articleid');
        Db::name("article")->where(array('id'=> $id))->setInc("click");
        $article=Db::name('article')->find($id);
        $this->assign('article',$article);
        $cate=Db::name('cate')->find($article['cateid']);
        $recres=db('article')->where(array('cateid'=>$cate['id'],'state'=>1))->limit(8)->select();
        $ralateres=$this->ralat($article['keywords'],$article['id']);
        $this->assign('cate',$cate);
        $this->assign('article',$article);
        $this->assign('recres',$recres);
        $this->assign('ralateres', $ralateres);
      return $this->fetch("article");

    }

public function ralat($keywords,$id){
  $arr=explode(',',$keywords);
    static $ralateres=array();
  foreach ($arr as $k=>$v){
      $map['keywords']=['like','%'.$v.'%'];
      $map['id']=['neq',$id];
      $artres=db('article')->where($map)->order('id desc')->limit(8)->select();
      $ralateres=array_merge($ralateres,$artres);
  }
    if($ralateres){
//移除数组中重复的值：
        $ralateres= arr_unique($ralateres);
        return $ralateres;

    }


}


}
