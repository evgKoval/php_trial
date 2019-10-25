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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
            Create a post
        </button>
        <hr>
        <?php foreach($posts as $post) { ?>
            <div class="card mb-4">
                <div class="card-body" id="<?php if($post['id']) echo $post['id']; ?>">
                    <h5 class="card-title"><?php if($post['title']) echo $post['title']; ?></h5>
                    <p class="card-text">
                        <?php if($post['post_text']) echo $post['post_text']; ?>
                    </p>
                    <p>
                        <small>
                            <?php if($post['created_at']) echo $post['created_at']; ?>
                        </small>
                    </p>
                    <button type="button" class="btn btn-primary btnEditModal" id="<?php echo $post['id']; ?>">
                        Edit
                    </button>
                    <button type="button" id="<?php if($post['id']) echo $post['id']; ?>" class="btn btn-danger btnDelete">Delete</button>
                </div>
            </div>
        <?php } ?>

        <?php include('modal.php'); ?>

    <?php } ?>
<?php include('footer.php'); ?>