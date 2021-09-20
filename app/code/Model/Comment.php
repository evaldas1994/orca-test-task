<?php

namespace Model;

use Core\Db;

class Comment
{
    private $id = null;
    private $post_id;
    private $root_post_id;
    private $email;
    private $name;
    private $content;
    private $created_at;
    private $updated_at;

    public function getId()
    {
        return $this->id;
    }

    public function setPostId($postId)
    {
        $this->post_id = $postId;
    }

    public function getPostId()
    {
        return $this->post_id;
    }

    public function setRootPostId($rootPostId)
    {
        $this->root_post_id = $rootPostId;
    }

    public function getRootPostId()
    {
        return $this->root_post_id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function create()
    {
        $db = new Db();

        $comment = [
            'post_id' => $this->post_id,
            'root_post_id' => $this->root_post_id,
            'email' => $this->email,
            'name' => $this->name,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        $db->insert('comments')->values($comment)->exec();
    }
}
