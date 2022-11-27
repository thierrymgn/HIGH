<?php

namespace App\Controller;

use App\Framework\BaseController;

class UsersController extends BaseController
{
    protected bool $_show_header = true;

    protected function getTitle(): string
    {
        return "Users";
    }
}