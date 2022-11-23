<?php

namespace App\Action;

use App\Model\User;
use App\Utils\Session;

$data = array();
parse_str(file_get_contents('php://input'), $data);

try {
  $users = User::getUsersByUsername($data['username']);

  if (count($users) == 0) {
    throw new \Exception('Username not found');
  }

  $user = $users[0];

  if (password_verify($data['password'], $user->getPassword())) {
    Session::save($user);

    header('Location: /');
  } else {
    throw new \Exception('Wrong password');
  }

  header('Location: /');
} catch (\Exception $e) {
  $error = $e->getMessage();
  $show_header = false;

  ob_start();
  include 'app/View/Login.php';
  $content = ob_get_clean();

  include 'app/View/layout.php';
}
