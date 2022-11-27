<?php

namespace App\View;

use App\Model\User;
use App\Utils\Session;

if (null === Session::get() || null === Session::get()->getId()) {
    header('Location: /');
    exit;
}

$user_id = intval($params['id']);

if (!isset($user_id)) {
    header('Location: /');
    exit;
}

$user = User::getUser($user_id);

if ($user === null) {
    header('Location: /');
    exit;
}

?>


<form id="edit-user" method="post" action="/users/<?= $user->getId() ?>/edit" class="contents">
    <article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center">
            <div>
                <input type="submit" name="submit" value="Save" class="text-sm font-medium text-blue-600 hover:underline cursor-pointer">
            </div>
        </div>
        <div class="mt-2 flex flex-col gap-4">
            <label for="username" class="text-sm font-medium text-gray-700">New Username</label>
            <input type="text" name="username" value="<?= $user->getUsername() ?>" class="border border-slate-300 rounded-lg p-2" required>
            <label for="password" class="text-sm font-medium text-gray-500">New Password</label>
            <input type="password" name="password" class="border border-slate-300 rounded-lg p-2">
            <label for="admin" class="text-sm font-medium text-gray-500">Admin</label>
            <input type="checkbox" name="admin" <?= $user->admin() ? 'checked' : '' ?> class="border border-slate-300 rounded-lg p-2">
        </div>
    </article>
    <?php if (isset($error)) : ?>
        <div class="text-red-500"><?= $error ?></div>
    <?php endif; ?>
</form>