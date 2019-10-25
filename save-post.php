<?php
require 'db/db.php';

$db = $db->getConnection();

$sql = 'UPDATE posts SET title = :title, post_text = :post_text WHERE id = :id';

$result = $db->prepare($sql);
$result->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
$result->bindParam(':post_text', $_POST['post_text'], PDO::PARAM_STR);
$result->bindParam(':id', $_POST['id'], PDO::PARAM_STR);

$result->execute();