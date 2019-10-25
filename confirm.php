<?php
$hash = $_GET["hash"];

require 'db/db.php';

$db = $db->getConnection();

$sql = 'UPDATE users SET is_active = 1 WHERE hash = :hash';

$result = $db->prepare($sql);
$result->bindParam(':hash', $hash, PDO::PARAM_STR);

$result->execute();

if ($result->rowCount()) {
    $_SESSION['flash'] = 'Your email is verificated';
    header("Location: /login");
} else {
    echo "Verification is wrong";
}