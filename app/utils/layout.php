<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php if (!isset($show_header) || $show_header): ?>
<header class="bg-blue-600 text-white p-4 mb-8">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl"><?= $title ?></h1>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="/logout.php" class="text-lg">Logout</a>
        <?php endif; ?>
    </div>
</header>
<?php endif; ?>
<main class="container mx-auto">
    <?php include_once './views/' . $view; ?>
</main>
</body>
</html>
