<?php

namespace Controller;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('main\home\index', []);
    }
}
