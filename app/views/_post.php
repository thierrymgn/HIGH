<article class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center">
        <span class="font-light text-gray-600"><?= $post['created_at'] ?></span>
        <div class="flex gap-2">
            <?php if ($_SESSION['isAdmin'] == 1 || $_SESSION['username'] == $post['username']): ?>
                <a href="/edit-post.php?id=<?= $post['post_id'] ?>" class="text-sm font-medium text-blue-600 hover:underline">Edit</a>
                <a href="/action/delete-post.php?id=<?= $post['post_id'] ?>" class="text-sm font-medium text-red-600 hover:underline">Delete</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-2">
        <a href="/post.php?id=<?= $post['post_id'] ?>" class="text-2xl text-gray-700 font-bold hover:underline"><?= $post['title'] ?></a>
        <p class="mt-2 text-gray-600"><?= nl2br($post['content']) ?></p>
    </div>
</article>
