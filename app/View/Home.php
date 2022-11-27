<?php

use App\Model\Post;

$posts = Post::getPosts();

// var_dump($posts);

?>

<form action="/posts" method="post" enctype="multipart/form-data" id="new-post" class="flex flex-col w-full bg-white rounded-lg shadow-md p-6 mb-8 gap-4">
    <input type="text" name="title" placeholder="Title" class="border border-slate-300 rounded-lg p-2" required>
    <textarea name="content" form="new-post" placeholder="Content" class="border border-slate-300 rounded-lg p-2" required></textarea>
    <input type="file" accept="image/jpeg" name="image" id="image" class="border border-slate-300 rounded-lg p-2">
    <input type="submit" value="Create" class="bg-blue-500 text-white rounded-lg p-2 cursor-pointer hover:bg-blue-600">
</form>
<div>
    <?php foreach ($posts as $post) : ?>
        <a href="/posts/<?= $post->getId() ?>">
            <article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h3 class="text-xl font-bold"><?= $post->getTitle() ?> <span class="text-sm font-normal">by <span class="underline"><?= $post->getUser()->getUsername() ?></span></span></h3>
                <p class="text-base truncate" style="-webkit-line-clamp: 3; display: -webkit-box; -webkit-box-orient: vertical; white-space: normal;"><?= nl2br($post->getContent()) ?></p>
                <?php if ($post->getImage() !== '') : ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($post->getImage()) ?>" class="w-1/4 mt-4">
                <?php endif; ?>
            </article>
        </a>
    <?php endforeach; ?>
</div>