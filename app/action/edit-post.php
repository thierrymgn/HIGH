<?php
require_once './../utils/pdo.php';

session_start();

if (!isset($_SESSION['username']) && (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1)) {
    header('Location: /');
}

$pdo = createPDO();

$request = $pdo->prepare("UPDATE `posts` SET `title` = :title, `content` = :content WHERE `post_id` = :id AND (`user_id` = :user_id OR :isAdmin = 1)");
$request->execute([
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'id' => $_POST['id'],
    'user_id' => $_SESSION['userId'],
    'isAdmin' => $_SESSION['isAdmin']
]);

header('Location: /post.php?id=' . $_POST['id']);
