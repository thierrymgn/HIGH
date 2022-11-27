<?php

use App\Utils\Session;
use App\Model\User;

if (null !== Session::get() && null !== Session::get()->getId()) {
    $user = User::getUser(Session::get()->getId());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php if (!isset($show_header) || $show_header) : ?>
        <header class="bg-blue-600 text-white p-4 mb-8">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl"><?= $title ?></h1>
                <div class="flex gap-4">
                    <?php if (null !== Session::get() && null !== Session::get()->getId()) : ?>
                        <a href="/users/<?= Session::get()->getId() ?>/edit" class="text-lg">Edit user <span class="text-purple-700 uppercase"><?= $user->getUsername() ?></span></a>
                    <?php endif; ?>
                    <?php if (null !== Session::get() && null !== Session::get()->getUsername()) : ?>
                        <a href="/logout" class="text-lg">Logout</a>
                    <?php else : ?>
                        <a href="/login" class="text-lg">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>
    <?php endif; ?>
    <main class="container mx-auto">
        <?= $content ?>
    </main>
</body>

</html>