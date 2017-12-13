<?php
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate
{
    protected $rule =   [
        'catename'  => 'require|max:10|unique:cate',
    ];

    protected $message  =   [
        'catename.require' => '欄目名称必须',
        'catename.max'     => '欄目名称最多不能超过10个字符',
        'catename.unique'     => '欄目名称不能重複',
    ];

    protected $scene = [
        'add'  =>  ['catename'],
        'edit'  =>  ['catename'],
    ];



}
