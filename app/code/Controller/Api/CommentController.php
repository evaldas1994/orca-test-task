<?php

namespace Controller\Api;

use Core\Controller;

class CommentController extends Controller
{
    public function index()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => 'got comment successfully']);
        return http_response_code(200);
    }

    public function store($request)
    {

        header('Content-Type: application/json; charset=utf-8');

        $entityBody = file_get_contents('php://input');
        echo $entityBody;

        // $decod = json_decode($entityBody);
        // echo $decod->title;

        return http_response_code(200);
    }
}
