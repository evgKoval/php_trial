<?php
require 'db/db.php';

if(isset($_POST['create'])) {
    $db = $db->getConnection();

    $sql = 'INSERT INTO posts (title, post_text, user_id) ' . 'VALUES (:title, :post_text, :user_id)';

    $result = $db->prepare($sql);
    $result->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $result->bindParam(':post_text', $_POST['post_text'], PDO::PARAM_STR);
    $result->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_STR);

    $result->execute();

    $lastId = $db->lastInsertId();

    $sql = 'SELECT * FROM posts WHERE id = :id';

    $result = $db->prepare($sql);
    $result->bindParam(':id', $lastId, PDO::PARAM_STR);

    $result->execute();

    $post = $result->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($post);
}
?>