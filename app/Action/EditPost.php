<?php

namespace App\Action;

use App\Controller\EditPostController;
use App\Model\Post;
use App\Entity\PostEntity;
use App\Utils\Session;

$data = array();
parse_str(file_get_contents('php://input'), $data);

if (null === Session::get() || null === Session::get()->getId()) {
  header('Location: /');
  exit;
}

try {
  $post = Post::updatePost(intval($params['id']), new PostEntity([
      'title' => $data['title'],
      'content' => $data['content'],
      'user_id' => Post::getPost(intval($params['id']))->getUserId(),
  ]));

  header('Location: /posts/' . $post->getId());
} catch (\Exception $e) {
  $error = $e->getMessage();
  $show_header = true;
  $title = (new EditPostController())->getTitle();

  ob_start();
  include 'app/View/EditPost.php';
  $content = ob_get_clean();

  include 'app/View/layout.php';
}
