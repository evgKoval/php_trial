<?php
require 'db/db.php';

$post_id = $segments[1];

$db = $db->getConnection();

$sql = 'DELETE FROM posts WHERE id = :id';

$result = $db->prepare($sql);
$result->bindParam(':id', $post_id, PDO::PARAM_STR);

$result->execute();

header("Location: /content");