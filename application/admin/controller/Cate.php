<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Loader;
use app\admin\model\Cate as CateModel;
class Cate extends Base
{
    public function lst()
    {
        $list=CateModel::paginate(3);
        $this->assign("list",$list);
        return $this->fetch("list");
    }


    public function add()
    {
        if (request()->isPost()){
            $data=['catename'=>input('catename'),
            ];
            $validate=Loader::validate("Cate");
            if(!$validate->scene("add")->check($data)){
                return $this->error($validate->getError());
            }

            if (Db::name("cate")->insert($data)){
                return $this->success("添加欄目成功！","lst");
            }else{
                return $this->error("添加欄目失败！");
            }
            return;
        }
        return $this->fetch("add");
    }

    public function edit()
    {
        $cates=db("cate")->find(input("id"));
        if (request()->isPost()){
            $data=['id'=>input('id'),'catename'=>input('catename')];
            $validate=Loader::validate("Cate");
            if(!$validate->scene("edit")->check($data)){
                return $this->error($validate->getError());
            }
            if (db('cate')->update($data)){
                return $this->success("修改欄目成功！","lst");
            }else{
                return $this->error("修改欄目失败！");
            }
            return;
        }


        $this->assign("cates",$cates);
        return $this->fetch();
    }
            function del(){
               if (db("cate")->delete(input('id'))){
                   return $this->success("删除欄目成功！","lst");
               }else{
                   return $this->error("删除欄目失败！");
               }

            }

}
