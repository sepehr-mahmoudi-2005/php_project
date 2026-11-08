<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';

global $pdo;

if (!filter_has_var(INPUT_GET, 'post_id') || $_GET['post_id'] === '') {
    redirect('panel/post');
}

$query = "DELETE FROM posts WHERE id=?";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);

redirect('panel/post');
