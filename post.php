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
	<a href="/content"> <- Back</a>
	<hr>
	<small><?php if($post['created_at']) echo $post['created_at']; ?></small>
	<h1><?php if($post['title']) echo $post['title']; ?></h1>
	<p><?php if($post['post_text']) echo $post['post_text']; ?></p>
<?php include('footer.php'); ?>