<?php

namespace Controller\Api;

use Core\Controller;
use Core\Request;
use Model\Comment;
use Carbon\Carbon;
use Throwable;

class CommentController extends Controller
{
    public function index()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => 'got comment successfully']);
        return http_response_code(200);
    }

    public function store()
    {
        $comment = new Comment();

       header('Content-Type: application/json; charset=utf-8');

        $request = file_get_contents('php://input');
        $request = json_decode($request);

        $comment->setPostId($request->post_id);
        $comment->setRootPostId($request->root_post_id);
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
