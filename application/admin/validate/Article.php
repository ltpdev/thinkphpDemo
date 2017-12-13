<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
    protected $rule =   [
        'title'  => 'require|max:10',
        'cateid'   => 'require',
    ];

    protected $message  =   [
        'title.require' => '文章標題必须',
        'title.max'     => '文章標題最多不能超过10个字符',
        'cateid.require' => '文章所屬欄目必须',
    ];

    protected $scene = [
        'add'  =>  ['title','cateid'],
        'edit'  => ['title','cateid'],

    ];



}
