<?php
require_once 'autoload.php';
global $pdo;

if (
    !filter_has_var(INPUT_GET, 'post_id') || $_GET['post_id'] === ''
) {
    redirect('index.php');
}

$query = "SELECT 
    p.*, 
    c.id category_id, 
    c.name category_name 
FROM posts p 
JOIN categories c
    ON p.cat_id = c.id
WHERE p.status=1 AND p.id=?;
";

$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= url('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">

        <?php require_once "layouts/top-nav.php" ?>

        <section class="container my-5">
            <!-- Example row of columns -->
            <section class="row">
                <section class="col-md-12">
                    <?php if ($post): ?>
                        <h1><?= $post->title ?></h1>
                        <h5 class="d-flex justify-content-between align-items-center">
                            <a href="<?= url('category.php?cat_id=') . $post->category_id ?>">
                                <?= $post->category_name ?>
                            </a>
                            <span class="date-time"><?= $post->created_at ?></span>
                        </h5>
                        <article class="bg-article p-3">
                            <img class="float-right mb-2 ml-2" style="width: 18rem;"
                                src="<?= asset($post->image) ?>"
                                alt="<?= $post->title ?>">
                            <?= $post->body ?>
                        </article>
                    <?php else: ?>
                        <section>post not found!</section>
                    <?php endif ?>
                </section>
            </section>
        </section>

    </section>
    <script src="<?= url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= url('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>