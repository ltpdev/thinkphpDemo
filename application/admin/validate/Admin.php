<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule =   [
        'username'  => 'require|max:10|unique:admin',
        'password'   => 'require|max:10',
    ];

    protected $message  =   [
        'username.require' => '管理员名称必须',
        'username.max'     => '管理员名称最多不能超过10个字符',
        'username.unique'     => '管理员名称不能重复',
        'password.require' => '管理员密码必须',
        'password.max'     => '管理员密码最多不能超过10个字符',
    ];

    protected $scene = [
        'add'  =>  ['username','password'],
        'edit'  =>  ['username'],

    ];



}
