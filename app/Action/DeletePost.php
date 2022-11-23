<?php

namespace App\Action;

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
  Post::deletePost(intval($params['id']));

  header('Location: /');
} catch (\Exception $e) {
  $error = $e->getMessage();
  $show_header = false;

  ob_start();
  include 'app/View/Home.php';
  $content = ob_get_clean();

  include 'app/View/layout.php';
}
