<?php

namespace App\Controller;

use App\Framework\BaseController;

class PostController extends BaseController
{
    protected function getTitle(): string
    {
        return "Post";
    }
}