<?php
namespace app\admin\model;
use think\Model;

class Article extends Model {
 public function cate(){
     //多对一关联查询，参数一为关联的表名，参数二为主表的外键
     return $this->belongsTo('cate','cateid');
 }


}