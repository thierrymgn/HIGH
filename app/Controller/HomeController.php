<?php

namespace App\Controller;

use App\Framework\BaseController;

class HomeController extends BaseController
{
    protected bool $_show_header = true;

    protected function getTitle(): string
    {
        return "Home";
    }
}