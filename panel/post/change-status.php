<?php
require_once '../autoload.php';

global $pdo;

if (filter_has_var(INPUT_GET, 'post_id') && $_GET['post_id'] !== '') {

    // find post
    $query = "SELECT * FROM posts WHERE id=?;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['post_id']]);
    $post = $statement->fetch();

    if ($post !== false) {

        // change found post status
        $query = "UPDATE posts SET status=:status WHERE id=:id;";
        $statement = $pdo->prepare($query);
        $status = $post->status === 1 ? 0 : 1;
        $statement->execute(['status' => $status, 'id' => $_GET['post_id']]);
    }
}

redirect('panel/post');
