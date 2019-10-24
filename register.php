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

        header("Location: /login");
    }
}
?>

<?php include('header.php'); ?>
    <h1 class="mb-4">Register</h1>
    <form method="POST">
        <input type="hidden" name="register">
        <div class="form-group">
            <label for="firstname_input">First name</label>
            <input name="firstname" type="text" class="form-control" id="firstname_input" placeholder="Enter your first name..." value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="lastname_input">Last name</label>
            <input name="lastname" type="text" class="form-control" id="lastname_input" placeholder="Enter your last name..." value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="email_input">Email</label>
            <input name="email" type="text" class="form-control" id="email_input" placeholder="example@gmail.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="password_input">Password</label>
            <input name="password" type="password" class="form-control" id="password_input" placeholder="Enter your password...">
        </div>
        <div class="form-group">
            <label for="confirm_password_input">Confirm password</label>
            <input name="confirm_password" type="password" class="form-control" id="confirm_password_input" placeholder="Confirm your password...">
        </div>
        <button type="submit" class="btn btn-primary mb-4 btn-block">Register</button>
    </form>
    <?php if($error) { ?>
        <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
        </div>
    <?php } ?>
<?php include('footer.php'); ?>