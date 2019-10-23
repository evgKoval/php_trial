<?php 
require 'db/db.php';
$error = '';

if(isset($_POST['login'])) {
	$db = $db->getConnection();

	$sql = 'SELECT * FROM users WHERE firstname = :firstname AND email = :email AND password = :password';

    $result = $db->prepare($sql);
    $result->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
    $result->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $result->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
    $result->execute();

    $user = $result->fetch(PDO::FETCH_ASSOC);
    
    //var_dump($user['is_active']);
    if ($user) {
    	if ($user['is_active'] == '0') {
    		$error = 'User isn\'t active' ;
    	} else {
    		session_start();
	        $_SESSION['firstname'] = $_POST['firstname'];

	        header("Location: /content.php");
    	}
    	
    }
}
?>

<?php include('header.php'); ?>
	<form method="POST">
		<input type="hidden" name="login">
		<label>
			First name
			<input type="text" name="firstname">
		</label>
		<br><br>
		<label>
			Email
			<input type="text" name="email">
		</label>
		<br><br>
		<label>
			Password
			<input type="password" name="password">
		</label>
		<br><br>
		<button type="submit">Login</button>
	</form>
	<p class="error"><?php if($error) echo $error ?></p>
<?php include('footer.php'); ?>