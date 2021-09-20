<?php

include_once '../vendor/autoload.php';
include_once '../config.php';

use Controller\PostController;

$postController = new PostController();
$postController->index();
