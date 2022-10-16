<?php
session_start();

require_once './utils/pdo.php';

$postId = $_GET['id'];

$request = $pdo->prepare("SELECT * FROM `posts` INNER JOIN `users` ON `posts`.`user_id` = `users`.`user_id` WHERE `post_id` = :id LIMIT 1");
$request->execute([
    'id' => $postId
]);

if ($request->rowCount() == 0) {
    header('Location: /');
}

$post = $request->fetch(PDO::FETCH_ASSOC);

$title = 'Post ' . $postId;
$view = '_post.php';

include_once './layout.php';
