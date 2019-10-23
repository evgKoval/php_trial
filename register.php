<?php
require 'db/db.php';

$error = '';

if(isset($_POST['register'])) {
	if ($_POST['password'] !== $_POST['confirm_password']) {
		$error = 'The passwords must be equal';
	} else {
		$db = $db->getConnection();

		$sql = 'INSERT INTO users (firstname, lastname, email, password) ' . 'VALUES (:firstname, :lastname, :email, :password)';

		$result = $db->prepare($sql);
	    $result->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
	    $result->bindParam(':lastname', $_POST['lastname'], PDO::PARAM_STR);
	    $result->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
	    $result->bindParam(':password', $_POST['password'], PDO::PARAM_STR);

	    $result->execute();

	    header("Location: /login.php");
	}
}
?>

<?php include('header.php'); ?>
	<form method="POST">
		<input type="hidden" name="register">
		<label>
			First name
			<input type="text" name="firstname">
		</label>
		<br><br>
		<label>
			Last name
			<input type="text" name="lastname">
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
		<label>
			Confirm password
			<input type="password" name="confirm_password">
		</label>
		<br><br>
		<button type="submit">Register</button>
	</form>
	<p class="error"><?php if($error) echo $error ?></p>
<?php include('footer.php'); ?>