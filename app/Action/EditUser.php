<?php

namespace App\Action;

use App\Controller\EditUserController;
use App\Model\User;
use App\Entity\UserEntity;
use App\Utils\Session;

$data = array();
parse_str(file_get_contents('php://input'), $data);

if (null === Session::get() || null === Session::get()->getId()) {
    header('Location: /');
    exit;
}

try {
    $user = User::updateUser(new UserEntity([
        'id' => intval($params['id']),
        'username' => $data['username'],
        'password' => empty($data['password']) ? User::getUser(intval($params['id']))->getPassword() : password_hash($data['password'], PASSWORD_DEFAULT),
        'admin' => isset($data['admin']),
    ]));

    header('Location: /');
} catch (\Exception $e) {
    $error = $e->getMessage();
    $show_header = true;
    $title = (new EditUserController())->getTitle();

    ob_start();
    include 'app/View/EditUser.php';
    $content = ob_get_clean();

    include 'app/View/layout.php';
}
