<?php

use App\Model\User;
use App\Utils\Session;

$users = User::getUsers();

if (null === Session::get() || null === Session::get()->getId()) {
  header('Location: /');
  exit;
}

?>

<div class="flex flex-col items-center justify-center w-full h-full">
    <div class="w-full max-w-2xl">
        <div class="flex flex-col items-center justify-center w-full h-full p-4 bg-white border border-gray-300 rounded-lg shadow">
            <h1 class="text-2xl font-bold">Users</h1>
            <div class="w-full mt-4">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td class="px-4 py-2"><?= $user->getId() ?></td>
                                <td class="px-4 py-2"><?= $user->getUsername() ?></td>
                                <?php if (Session::get()->admin() && Session::get()->getId() !== $user->getId()) : ?>
                                    <td class="px-4 py-2">
                                        <form method="post" action="/users/<?= $user->getId() ?>/delete">
                                            <input type="submit" name="submit" value="Delete"
                                                   class="text-sm font-medium text-red-600 hover:underline cursor-pointer">
                                        </form>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
