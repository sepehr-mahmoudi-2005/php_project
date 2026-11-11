<?php
require_once 'autoload.php';
global $pdo;

if (
    !filter_has_var(INPUT_GET, 'cat_id') ||
    $_GET['cat_id'] === ''
) {
    redirect('index.php');
}

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

        <?php

        $query = "SELECT *
        FROM categories 
        WHERE id=?;
        ";
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['cat_id']]);
        $category = $statement->fetch();

        ?>

        <section class="container my-5">

            <?php if ($category): ?>
                <section class="row">
                    <section class="col-12">
                        <h1><?= $category->name ?></h1>
                        <hr>
                    </section>
                </section>
                <section class="row">

                    <?php
                    $query = "SELECT *
                    FROM posts
                    WHERE status=1 AND cat_id=?;
                    ";
                    $statement = $pdo->prepare($query);
                    $statement->execute([$category->id]);
                    $posts = $statement->fetchAll();

                    ?>

                    <?php foreach ($posts as $post): ?>
                        <section class="col-md-4">
                            <section class="mb-2 overflow-hidden" style="max-height: 15rem;">
                                <img class="img-fluid"
                                    src="<?= asset($post->image) ?>"
                                    alt="<?= $post->title ?>">
                            </section>
                            <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                            <p><?= substr($post->body, 0, 50) ?>...</p>
                            <p><a class="btn btn-primary"
                                    href="<?= url('detail.php?post_id=') . $post->id ?>"
                                    role="button">View details »</a></p>
                        </section>
                    <?php endforeach ?>

                </section>
            <?php else: ?>
                <section class="row">
                    <section class="col-12">
                        <h1>Category not found</h1>
                    </section>
                </section>
            <?php endif ?>

        </section>
    </section>

    </section>
    <script src="<?= url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= url('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>