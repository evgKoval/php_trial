<?php
require 'db/db.php';
require 'validation.php';

$errors = false;

if(isset($_POST['register'])) {

    if (!Validation::checkName($_POST['firstname'])) {
        $errors[] = 'First name doesn\'t be less 2 symbols' ;
    }

    if (!Validation::checkName($_POST['lastname'])) {
        $errors[] = 'Last name doesn\'t be less 2 symbols' ;
    }

    if (!Validation::checkEmail($_POST['email'])) {
        $errors[] = 'Email is wrong' ;
    }

    if (!Validation::checkPassword($_POST['password'])) {
        $errors[] = 'Password doesn\'t be less 3 symbols' ;
    }

    if (!Validation::confirmPassword($_POST['password'], $_POST['confirm_password'])) {
        $errors[] = 'Passwords must be equal and not empty' ;
    }

    if (Validation::checkEmailExists($db, $_POST['email'])) {
        $errors[] = 'This email is already used';
    }

    if ($errors == false) {
        $hash = hash('ripemd160', $_POST['firstname'] . $_POST['email']);

        $db = $db->getConnection();

        $sql = 'INSERT INTO users (firstname, lastname, email, password, hash) ' . 'VALUES (:firstname, :lastname, :email, :password, :hash)';

        $result = $db->prepare($sql);
        $result->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
        $result->bindParam(':lastname', $_POST['lastname'], PDO::PARAM_STR);
        $result->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $result->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
        $result->bindParam(':hash', $hash, PDO::PARAM_STR);

        $result->execute();

        if (isset($_SESSION['flash'])) {
            unset($_SESSION["flash"]);
        }

        require 'send-mail.php';
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
    <?php if (isset($errors) && is_array($errors)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </div>
    <?php } ?>
<?php include('footer.php'); ?>