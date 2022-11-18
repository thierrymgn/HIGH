<?php

class PostController {
    static function index(): void
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /login.php');
        }

        $posts = Post::all();
        $title = 'Home';
        $view = '_index.php';
        include_once './utils/layout.php';
    }

    static function show(): void
    {
        $id = $_GET['id'];

        if (!isset($id)) {
            header('Location: /');
        }

        $post = Post::find($id);
        $title = $post['title'];
        $view = '_show.php';
        include_once './utils/layout.php';
    }

    static function create(): void
    {
        $title = 'Create Post';
        $view = '_create.php';
        include_once './utils/layout.php';
    }

    static function store($title, $content): void
    {
        $postId = Post::create($title, $content, $_SESSION['userId']);
        header('Location: /post.php?id=' . $postId);
    }

    static function edit(): void
    {
        $id = $_GET['id'];

        if (!isset($id)) {
            header('Location: /');
        }

        $post = Post::find($id);
        $title = 'Edit Post';
        $view = '_edit.php';
        include_once './utils/layout.php';
    }

    static function update($id, $title, $content): void
    {
        Post::update($id, $title, $content, $_SESSION['userId']);
        header('Location: /post.php?id=' . $_POST['id']);
    }

    static function delete($id): void
    {
        Post::delete($id, $_SESSION['userId']);
        header('Location: /');
    }
}
