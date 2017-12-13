<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Loader;
use app\admin\model\Admin as AdminModel;
class Admin extends Base
{


    public function lst()
    {
        $list=AdminModel::paginate(3);
        $this->assign("list",$list);
        return $this->fetch("list");
    }


    public function add()
    {
        if (request()->isPost()){
            $validate=Loader::validate("Admin");

            $data=['username'=>input('username'),
                'password'=>input('password')
            ];
            if(!$validate->scene("add")->check($data)){
                return $this->error($validate->getError());
            }
            $data=['username'=>input('username'),
                'password'=>md5(input('password'))
            ];
            if (Db::name("admin")->insert($data)){
                return $this->success("添加管理员成功！","lst");
            }else{
                return $this->error("添加管理员失败！");
            }
            return;
        }
        return $this->fetch("add");
    }

    public function edit()
    {
        $admins=db("admin")->find(input("id"));
        if (request()->isPost()){
            $data=['id'=>input('id'),'username'=>input('username')];
            if(input('password')){
                $data['password']=md5(input('password'));
            }else{
                $data['password']=$admins['password'];
            }
            $validate=Loader::validate("Admin");
            if(!$validate->scene("edit")->check($data)){
                return $this->error($validate->getError());
            }
            if (db('admin')->update($data)){
                return $this->success("修改管理员成功！","lst");
            }else{
                return $this->error("修改管理员失败！");
            }
            return;
        }


        $this->assign("admins",$admins);
        return $this->fetch();
    }
            function del(){
               if (db("admin")->delete(input('id'))){
                   return $this->success("删除管理员成功！","lst");
               }else{
                   return $this->error("删除管理员失败！");
               }

            }


            function logout(){
                session(null);
              $this->success("退出成功！","login/index");
            }

}
