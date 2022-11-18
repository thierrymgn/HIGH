<?php
require_once './../utils/pdo.php';

session_start();

if (!isset($_SESSION['username']) && (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1)) {
    header('Location: /');
}

CommentController::update($_POST['id'], $_POST['content'], $_SESSION['userId'], $_POST['postId']);
