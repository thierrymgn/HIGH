<?php

use App\Model\Post;

$posts = Post::getPosts();

?>

<form action="/posts" method="post" id="new-post" class="flex flex-col w-full bg-white rounded-lg shadow-md p-6 mb-8 gap-4">
    <input type="text" name="title" placeholder="Title" class="border border-slate-300 rounded-lg p-2" required>
    <textarea name="content" form="new-post" placeholder="Content"
              class="border border-slate-300 rounded-lg p-2" required></textarea>
    <input type="submit" value="Create" class="bg-blue-500 text-white rounded-lg p-2 cursor-pointer hover:bg-blue-600">
</form>
<div>
    <?php foreach ($posts as $post): ?>
        <a href="/posts/<?= $post->getId() ?>">
            <article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h3 class="text-xl font-bold"><?= $post->getTitle() ?> <span class="text-sm font-normal">by <span
                                class="underline"><?= $post->getUser()->getUsername() ?></span></span></h3>
                <p class="text-base truncate" style="-webkit-line-clamp: 3; display: -webkit-box; -webkit-box-orient: vertical; white-space: normal;"><?= nl2br($post->getContent()) ?></p>
            </article>
        </a>
    <?php endforeach; ?>
</div>
