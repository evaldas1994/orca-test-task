<?php

namespace Controller;

use Core\Controller;

class PostController extends Controller
{
    public function index()
    {
        $this->render('main\post\index', []);
    }
}
