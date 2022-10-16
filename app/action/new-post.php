<?php
require_once './../utils/pdo.php';

session_start();

if (!isset($_SESSION['username']) && (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1)) {
    header('Location: /');
}

$pdo = createPDO();

$request = $pdo->prepare("INSERT INTO `posts` (`title`, `content`, `user_id`) VALUES (:title, :content, :user_id)");
$request->execute([
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'user_id' => $_SESSION['userId']
]);
$request = $pdo->prepare("SELECT * FROM `posts` WHERE `post_id` = :id");
$request->execute([
    'id' => $pdo->lastInsertId()
]);
$post = $request->fetch(PDO::FETCH_ASSOC);

header('Location: /post.php?id=' . $post['post_id']);
