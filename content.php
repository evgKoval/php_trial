<?php 
	session_start();
?>

<?php include('header.php'); ?>
	<h1>Hello, <?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Guest' ?></h1>
<?php include('footer.php'); ?>