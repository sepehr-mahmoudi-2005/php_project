<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';

global $pdo;

if (filter_has_var(INPUT_GET, 'post_id') && $_GET['post_id'] !== '') {
    // delete post image
    $query = "SELECT * FROM posts WHERE id=?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['post_id']]);
    $basePath = dirname(dirname(__DIR__));
    $post = $statement->fetch();

    if(file_exists($basePath . $post->image)){
        unlink($basePath . $post->image);
    }

    $query = "DELETE FROM posts WHERE id=?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['post_id']]);
}


redirect('panel/post');
