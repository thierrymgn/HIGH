<?php

namespace App\View;

use App\Model\Post;
use App\Utils\Session;

if (null === Session::get() || null === Session::get()->getId()) {
    header('Location: /');
    exit;
}

$post_id = $params['id'];

if (!isset($post_id)) {
    header('Location: /');
}

$post = Post::getPost($post_id);

if ($post === null) {
    echo "Post not found"; die;
}

?>

<form id="edit-post" method="post" enctype="multipart/form-data" action="/posts/<?= $post->getId() ?>/edit" class="contents">
    <article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center">
            <span class="font-light text-gray-600"><?= $post->getCreatedAt() ?></span>
            <div>
                <input type="submit" name="submit" value="Save" class="text-sm font-medium text-blue-600 hover:underline cursor-pointer">
            </div>
        </div>
        <div class="mt-2 flex flex-col gap-4">
            <input type="text" name="title" value="<?= $post->getTitle() ?>" class="border border-slate-300 rounded-lg p-2" required>
            <textarea name="content" form="edit-post" placeholder="Content" class="border border-slate-300 rounded-lg p-2" required><?= $post->getContent() ?></textarea>
            <input type="file" accept="image/jpeg" name="image" id="image" class="border border-slate-300 rounded-lg p-2">
            <input type="hidden" name="id" value="<?= $post->getId() ?>">
        </div>
    </article>
    <?php if (isset($error)) : ?>
        <div class="text-red-500"><?= $error ?></div>
    <?php endif; ?>
</form>