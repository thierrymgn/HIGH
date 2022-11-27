<?php

namespace App\Action;

use App\Model\User;
use App\Utils\Session;

if (null === Session::get() || null === Session::get()->getId()) {
  header('Location: /');
  exit;
}

try {
  User::deleteUser(intval($params['id']));

  header('Location: ' . $_SERVER['HTTP_REFERER']);
} catch (\Exception $e) {
  $error = $e->getMessage();
  $show_header = false;

  ob_start();
  include 'app/View/Home.php';
  $content = ob_get_clean();

  include 'app/View/layout.php';
}
