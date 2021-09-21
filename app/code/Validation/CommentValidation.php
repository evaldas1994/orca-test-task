<?php

namespace Validation;

use Core\Db;
use Model\Post;
use Model\Comment;

class CommentValidation
{
    private $data;
    private $errors;
    private $fields = [
        'post_id',
        'root_comment_id',
        'email',
        'name',
        'content'
    ];

    public function __construct($postData)
    {
        $this->data = $postData;
    }

    public function validateForm()
    {
        $dataArr = (array)$this->data;

        for ($i=0; $i<count($this->fields); $i++) {
            if (!array_key_exists($this->fields[$i], $dataArr)) {
                $this->addError($this->fields[$i], $this->fields[$i] .' Field  is required');
                return;
            }
        }

        $this->validatePostId();
        $this->validateRootCommentId();
        $this->validateEmail();
        $this->validateName();
        $this->validateContent();

        return $this->errors;
    }

    private function addError($key, $message): void
    {
        $this->errors[$key] = $message;
    }

    private function validatePostId(): void
    {
        $post = new Post();
        $postId = trim($this->data->post_id);

        if(empty($postId)) {
            $this->addError('post_id', 'Post id is required');
        } else {
            if(!preg_match('/^[0-9]$/', $postId)) {
                $this->addError('post_id','Post id must be numeric');
                return;
            }

            if(empty($post->find($postId))) {
                $this->addError('post_id','Post id not exists');
                return;
            }
        }
    }

    private function validateRootCommentId(): void
    {
        $comment = new Comment();
        $rootCommentId = trim($this->data->root_comment_id);

        if(empty($rootCommentId)) {
            return;
        } else {
            $rootCommentObj = $comment->find($rootCommentId);

            if(empty($rootCommentObj)) {
                $this->addError('root_comment_id','Root comment id not exists');
                return;
            } else {
                if (!empty($rootCommentObj['root_comment_id'])) {
                    $this->addError('root_comment_id','Root comment id is already answer');
                    return;
                }
            }
        }
    }

    private function validateEmail(): void
    {
        $email = trim($this->data->email);

        if(empty($email)) {
            $this->addError('email', 'Email is required');
        } else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email','Email must be a valid email');
            }
        }
    }

    private function validateName(): void
    {
        $name = trim($this->data->name);

        if(empty($name)) {
            $this->addError('name', 'Name is required');
        } else {
            if(!preg_match('/^[a-zA-Z\s]{2,100}$/', $name)) {
                $this->addError('name','Name must be 2-100 chars without numbers');
            }
        }
    }

    private function validateContent(): void
    {
        $content = trim($this->data->content);

        if(empty($content)) {
            $this->addError('content', 'Content is required');
        } else {
            if(strlen($content) > 500) {
                $this->addError('content','Content must be 2-500 chars');
            }
        }
    }
}
