<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
    function _initialize()
    {
        if (!session('username')){
            $this->error("请先登录",'login/index');
        }
    }



}
