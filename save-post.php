<?php
require 'db/db.php';

$post_id = $segments[1];

$db = $db->getConnection();

$sql = 'UPDATE posts SET title = :title, post_text = :post_text WHERE id = :id';

$result = $db->prepare($sql);
$result->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
$result->bindParam(':post_text', $_POST['post_text'], PDO::PARAM_STR);
$result->bindParam(':id', $post_id, PDO::PARAM_STR);

$result->execute();

header("Location: /content");