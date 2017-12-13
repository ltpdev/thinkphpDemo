<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function index(){
        if (request()->isPost()){
            $admin=new Admin();
            $res=$admin->login(input("post."));
            if ($res==1){
                $this->error('用户名不存在');
            }
            else if ($res==2){
                $this->error('密码错误');
            }else if ($res==3){
                //跳转到index控制器，index方法
                $this->success('输入正确','index/index');
            }else {
                //跳转到index控制器，index方法
                $this->error('验证码错误');
            }
        }
        return $this->fetch("login");
    }
}
