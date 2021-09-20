<?php

namespace Controller\Api;

use Core\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        return http_response_code(404);
    }
}
