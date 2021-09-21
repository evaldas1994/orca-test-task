<?php

namespace Model;

use Core\Db;

class Post
{
    private $id = null;

    public function getId()
    {
        return $this->id;
    }

    public function find($id)
    {
        $db = new Db();
        return $db->select()->from('posts')->where('id', $id)->getOne();
    }
}
