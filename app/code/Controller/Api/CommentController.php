<?php

namespace Controller\Api;

use Core\Controller;
use Core\Request;
use Model\Comment;
use Carbon\Carbon;
use Throwable;
use Validation\CommentValidation;

class CommentController extends Controller
{
    public function index()
    {
        $comment = new Comment();
        $comments = $comment->all();

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(['data' => $comments]);

        return http_response_code(200);
    }

    public function store()
    {
        $comment = new Comment();

       header('Content-Type: application/json; charset=utf-8');

        $request = file_get_contents('php://input');
        $request = json_decode($request);

        $commentValidation = new CommentValidation($request);
        $errors = $commentValidation->validateForm();

        if (!empty($errors)) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['errors' => $errors]);
            return http_response_code(422);
        } else {
            $comment->setPostId($request->post_id);
            $comment->setRootCommentId($request->root_comment_id);
            $comment->setEmail($request->email);
            $comment->setName($request->name);
            $comment->setContent($request->content);
            $comment->setCreatedAt(Carbon::now());
            $comment->setUpdatedAt(Carbon::now());

            try
            {
                $comment->create();

                return http_response_code(201);
            }
            catch(Throwable $throwable)
            {
                echo json_encode(['errors' => $throwable->getMessage()]);
                return http_response_code(500);
            }
        }
    }

    public function getCommentsByPostId($id)
    {
        $comment = new Comment();
        $comments = $comment->allByPostId($id);

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(['data' => $comments]);

        return http_response_code(200);
    }
}
