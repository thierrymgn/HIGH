<?php

namespace App\Action;

use App\Model\User;
use App\Entity\UserEntity;
use App\Utils\Session;

$data = array();
parse_str(file_get_contents('php://input'), $data);

try {
  $user = User::createUser(new UserEntity([
      'username' => $data['username'],
      'password' => password_hash($data['password'], PASSWORD_DEFAULT),
      'admin' => count(User::getUsers()) === 0,
  ]));

  Session::save($user);

  header('Location: /');
} catch (\Exception $e) {
  $error = $e->getMessage();
  $show_header = false;

  ob_start();
  include 'app/View/Signup.php';
  $content = ob_get_clean();

  include 'app/View/layout.php';
}
