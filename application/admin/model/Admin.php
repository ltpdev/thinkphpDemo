<?php
namespace app\admin\model;
use think\captcha\Captcha;
use think\Db;
use think\Model;

class Admin extends Model {

    public function login($data){
        $cap=new Captcha();
        if (!$cap->check($data['code'])){
            return 4;
        }
        $user=Db::name("admin")->where("username","=",$data['username'])->find();
        if ($user){
            if($user['password']==md5($data['password'])){
                session("username",$user['username']);
                session("uid",$user['id']);
                return 3;
            }else{
                return 2;
            }

        }else{
            return 1;
        }
    }


}