<?php
require 'db/db.php';

$db = $db->getConnection();

$sql = 'DELETE FROM posts WHERE id = :id';

$result = $db->prepare($sql);
$result->bindParam(':id', $_POST['id'], PDO::PARAM_STR);

$result->execute();