<?php
require_once '../autoload.php';

global $pdo;

if (filter_has_var(INPUT_GET, 'cat_id') && $_GET['cat_id'] !== '') {

    $query = "DELETE FROM categories WHERE id=?;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['cat_id']]);
}

redirect('panel/category/');
