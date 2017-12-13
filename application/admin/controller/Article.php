<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Loader;
use app\admin\model\Article as ArticleModel;

class Article extends Base
{
    public function lst()
    {
        //$list = ArticleModel::paginate(3);
        //1，数据表的链接查询,alias为别名，查询的结果作为一个数组或对象的形式返回
        //$list =db('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.pic,a.author,a.state,c.catename')->paginate(3);
        //2，多对一关联查询
        $list = ArticleModel::paginate(3);
        $this->assign("list", $list);
        return $this->fetch("list");
    }


    public function add()
    {

        if (request()->isPost()) {
            $validate = Loader::validate("Article");
            $data = [
                'title'=>input('title'),
                'author'=>input('author'),
                'desc'=>input('desc'),
                'keywords'=> str_replace('，',',',input('keywords')),
                'content'=>input('content'),
                'cateid'=>input('cateid'),
                'time'=>time(),
            ];
            if(input('state')=='on'){
                $data['state']=1;
            }
            if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                if($info){
                    $data['pic']='/uploads/'.$info->getSaveName();
                }else{
                    // 上传失败获取错误信息
                   // echo $file->getError();
                }
            }
            if (!$validate->scene("add")->check($data)) {
                return $this->error($validate->getError());
            }

            if (Db::name("article")->insert($data)) {
                return $this->success("添加文章成功！", "lst");
            } else {
                return $this->error("添加文章失败！");
            }
            return;
        }
        $cates=db('cate')->select();
        $this->assign("cates",$cates);
        return $this->fetch("add");
    }

    public function edit()
    {
        $article = db("article")->find(input("id"));
        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'title' => input('title'),
                'author' => input('author'),
                'desc' => input('desc'),
                'keywords' => str_replace('，',',',input('keywords')),
                'content' => input('content'),
                'cateid' => input('cateid'),
            ];
            if (input('state') == 'on') {
                $data['state'] = 1;
            } else {
                $data['state'] = 0;
            }
            if ($_FILES['pic']['tmp_name']) {
                $file = request()->file('pic');
                $info = $file->validate(['size' => 15678, 'ext' => 'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                if ($info) {
                    //删除原来的图片
                    if(isset($article['pic'])){
                        //删除原来的图片
                        unlink("F:/phpDemo/thinkphpDemo/public/static".$article['pic']);
                    }else{

                    }

                    $data['pic'] = '/uploads/' . $info->getSaveName();
                } else {
                    // 上传失败获取错误信息
                    // echo $file->getError();
                }

            }
            $validate = Loader::validate("Article");
            if (!$validate->scene("edit")->check($data)) {
                return $this->error($validate->getError());
            }
            if (db('article')->update($data)) {
                return $this->success("修改文章成功！", "lst");
            } else {
                return $this->error("修改文章失败！");
            }
            return;
        }
        $cates = db('cate')->select();
        $this->assign("cates", $cates);
        $this->assign("article", $article);
        return $this->fetch();
    }

    function del()
    {  $article = db("article")->find(input("id"));
    if(isset($article['pic'])){
        //删除原来的图片
        unlink("F:/phpDemo/thinkphpDemo/public/static".$article['pic']);
    }else{

    }

        if (db("article")->delete(input('id'))) {
            return $this->success("删除文章成功！", "lst");
        } else {
            return $this->error("删除文章失败！");
        }

    }

}
