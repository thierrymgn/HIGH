<?php

class UserController
{
    static function index(): void
    {
        $title = 'Users';
        $view = '_index.php';
        include_once './utils/layout.php';
    }

    static function show(): void
    {
        $id = $_GET['id'];

        if (!isset($id)) {
            header('Location: /');
        }

        $user = User::find($id);
        $title = $user['username'];
        $view = '_show.php';
        include_once './utils/layout.php';
    }

    static function create(): void
    {
        $title = 'Create User';
        $view = '_create.php';
        include_once './utils/layout.php';
    }

    static function store($username, $password): void
    {
        User::create($username, $password);
        header('Location: /');
    }
}
