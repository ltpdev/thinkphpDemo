<?php
namespace app\admin\validate;
use think\Validate;

class Links extends Validate
{
    protected $rule =   [
        'title'  => 'require|max:10',
        'url'   => 'require',
    ];

    protected $message  =   [
        'title.require' => '链接名称必须',
        'title.max'     => '链接名称最多不能超过10个字符',
        'url.require' => '链接地址必须',
    ];

    protected $scene = [
        'add'  =>  ['title','url'],
        'edit'  => ['title','url'],

    ];



}
