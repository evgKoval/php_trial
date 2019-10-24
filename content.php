<?php 
    require 'db/db.php';

    $db = $db->getConnection();

    $sql = 'SELECT * FROM posts WHERE user_id = :user_id';

    $result = $db->prepare($sql);
    $result->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_STR);

    $result->execute();

    $posts = $result->fetchAll();
?>

<?php include('header.php'); ?>
    <h1>Hello, <?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Guest' ?></h1> 
    <?php if(isset($_SESSION['firstname'])) { ?>
        <a href="create-post.php">Create a post</a>
        <hr>
        <?php foreach($posts as $post) { ?>
            <article class="post">
                <h2 class="title"><?php echo $post['title']; ?></h2>
                <div class="text"><?php echo $post['post_text']; ?></div>
                <div class="created"><?php echo $post['created_at']; ?></div>
                <a href="edit/<?php echo $post['id']; ?>">Edit post</a>
            </article>
        <?php } ?>
    <?php } ?>
<?php include('footer.php'); ?>