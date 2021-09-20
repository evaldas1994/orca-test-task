<?php

namespace Controller;

use Core\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        $this->render('main\error\index', []);
    }
}
