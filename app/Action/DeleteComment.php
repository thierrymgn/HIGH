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
  Comment::deleteComment(intval($params['commentId']));

  header('Location: /posts/' . intval($params['id']));
} catch (\Exception $e) {
  $error = $e->getMessage();
  $show_header = false;

  ob_start();
  include 'app/View/Home.php';
  $content = ob_get_clean();

  include 'app/View/layout.php';
}