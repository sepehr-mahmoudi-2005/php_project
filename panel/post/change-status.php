<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';

global $pdo;

if (!filter_has_var(INPUT_GET, 'post_id') || $_GET['post_id'] === '') {
    redirect('panel/post');
}

// find post
$query = "SELECT * FROM posts WHERE id=?;";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();

if (!$post) {
    redirect('panel/post');
}

// change found post status
$query = "UPDATE posts SET status=:status WHERE id=:id;";
$statement = $pdo->prepare($query);

$new_status = $post->status === 1 ? 0 : 1;
$statement->execute(['status' => $new_status, 'id' => $_GET['post_id']]);

redirect('panel/post');
