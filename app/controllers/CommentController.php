<?php

class CommentController
{
    static function index(): void
    {
        $comments = Comment::all();
        $title = 'Comments';
        $view = '_index.php';
        include_once './utils/layout.php';
    }

    static function show(): void
    {
        $id = $_GET['id'];

        if (!isset($id)) {
            header('Location: /');
        }

        $comment = Comment::find($id);
        $title = $comment['content'];
        $view = '_show.php';
        include_once './utils/layout.php';
    }

    static function create(): void
    {
        $title = 'Create Comment';
        $view = '_create.php';
        include_once './utils/layout.php';
    }

    static function store($content, $userId, $postId): void
    {
        Comment::create($content, $userId, $postId);
        header('Location: /');
    }

    static function edit(): void
    {
        $id = $_GET['id'];

        if (!isset($id)) {
            header('Location: /');
        }

        $comment = Comment::find($id);
        $title = 'Edit Comment';
        $view = '_edit.php';
        include_once './utils/layout.php';
    }

    static function update($id, $content, $userId, $postId): void
    {
        Comment::update($id, $content, $userId, $postId);
        header('Location: /');
    }

    static function delete($id): void
    {
        Comment::delete($id, $_SESSION['userId']);
        header('Location: /');
    }
}
