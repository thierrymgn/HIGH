<?php

namespace App\View;

use App\Model\Post;
use App\Utils\Session;

$post_id = $params['id'];

if (!isset($post_id)) {
    header('Location: /');
}

$post = Post::getPost($post_id);

if ($post === null) {
    echo "Post not found"; die;
}

?>

<article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center">
        <span class="font-light text-gray-600"><?= $post->getCreatedAt() ?></span>
        <span class="font-light text-gray-600"><?= $post->getUser()->getUsername() ?></span>
        <div class="flex gap-2">
            <?php if (null !== Session::get() && (Session::get()->admin() == 1 || Session::get()->getId() == $post->getUserId())): ?>
                <a href="/posts/<?= $post->getId() ?>/edit" class="text-sm font-medium text-blue-600 hover:underline">Edit</a>
                <form action="/posts/<?= $post->getId() ?>/delete" method="post" class="contents">
                    <input type="submit" value="Delete" class="text-sm font-medium text-red-600 hover:underline cursor-pointer">
                </form>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-2">
        <a href="/posts/<?= $post->getId() ?>" class="text-2xl text-gray-700 font-bold hover:underline"><?= $post->getTitle() ?></a>
        <p class="mt-2 text-gray-600"><?= nl2br($post->getContent()) ?></p>
    </div>
</article>
