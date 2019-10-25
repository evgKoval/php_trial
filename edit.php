<?php
    require 'db/db.php';

    $post_id = $segments[1];

    $db = $db->getConnection();

    $sql = 'SELECT * FROM posts WHERE id = :id';

    $result = $db->prepare($sql);
    $result->bindParam(':id', $post_id, PDO::PARAM_STR);

    $result->execute();

    $post = $result->fetch();
?>

<?php include('header.php'); ?>
    <h1>Edit post</h1>
    <form method="POST" action="/save-post/<?php if($segments[1]) echo $segments[1]; ?>">
        <input type="hidden" name="edit">
        <label>
            Title
            <input type="text" name="title" value="<?php if($post['title']) echo $post['title']; ?>">
        </label>
        <br><br>
        <label>
            Full text
            <textarea type="text" name="post_text" rows="6" cols="50"><?php if($post['post_text']) echo $post['post_text']; ?></textarea>
        </label>
        <br><br>
        <button type="submit">Edit</button>
    </form>
<?php include('footer.php'); ?>