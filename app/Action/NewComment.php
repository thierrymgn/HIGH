<?php

namespace App\Action;

use App\Model\Comment;
use App\Entity\CommentEntity;
use App\Utils\Session;

$data = array();
parse_str(file_get_contents('php://input'), $data);

if (null === Session::get() || null === Session::get()->getId()) {
  header('Location: /');
  exit;
}

try {
  $comment = Comment::createComment(new CommentEntity([
      'content' => $data['content'],
      'user_id' => Session::get()->getId(),
      'post_id' => intval($params['id']),
      'comment_parent_id' => isset($params['commentId']) ? intval($params['commentId']) : null,
  ]));

  header('Location: /posts/' . $comment->getPostId());
} catch (\Exception $e) {
  $error = $e->getMessage();
  $show_header = false;

  ob_start();
  include 'app/View/Home.php';
  $content = ob_get_clean();

  include 'app/View/layout.php';
}