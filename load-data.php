<?php
require 'db/db.php';

$db = $db->getConnection();

$sql = 'SELECT u.firstname, p.title, p.post_text, p.created_at FROM users u INNER JOIN posts p ON u.user_id = p.user_id';

$result = $db->prepare($sql);
$result->execute();

$users = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);