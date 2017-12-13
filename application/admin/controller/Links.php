<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Loader;
use app\admin\model\Links as LinksModel;

class Links extends Base
{
    public function lst()
    {
        $list = LinksModel::paginate(3);
        $this->assign("list", $list);
        return $this->fetch("list");
    }


    public function add()
    {
        if (request()->isPost()) {
            $validate = Loader::validate("Links");

            $data = ['title' => input('title'),
                'url' => input('url'),
                'desc' => input('desc')
            ];
            if (!$validate->scene("add")->check($data)) {
                return $this->error($validate->getError());
            }

            if (Db::name("links")->insert($data)) {
                return $this->success("添加链接成功！", "lst");
            } else {
                return $this->error("添加链接失败！");
            }
            return;
        }
        return $this->fetch("add");
    }

    public function edit()
    {
        $links = db("links")->find(input("id"));
        if (request()->isPost()) {
            $data = ['id' => input('id'), 'title' => input('title'), 'url' => input('url'), 'desc' => input('desc')];
            $validate = Loader::validate("Links");
            if (!$validate->scene("edit")->check($data)) {
                return $this->error($validate->getError());
            }
            if (db('links')->update($data)) {
                return $this->success("修改链接成功！", "lst");
            } else {
                return $this->error("修改链接失败！");
            }
            return;
        }
        $this->assign("links", $links);
        return $this->fetch();
    }

    function del()
    {
        if (db("links")->delete(input('id'))) {
            return $this->success("删除链接成功！", "lst");
        } else {
            return $this->error("删除链接失败！");
        }

    }

}
