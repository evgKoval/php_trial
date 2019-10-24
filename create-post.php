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

    header("Location: /content");
}
?>

<?php include('header.php'); ?>
    <h1>Create a post</h1>
    <form method="POST">
        <input type="hidden" name="create">
        <label>
            Title
            <input type="text" name="title">
        </label>
        <br><br>
        <label>
            Full text
            <textarea type="text" name="post_text" rows="6" cols="50"></textarea>
        </label>
        <br><br>
        <button type="submit">Create</button>
    </form>
<?php include('footer.php'); ?>