<?php 
require 'db/db.php';
require 'validation.php';

$errors = false;

if(isset($_POST['login'])) {
    unset($_SESSION["flash"]);

    if (!Validation::checkName($_POST['firstname'])) {
        $errors[] = 'First name doesn\'t be less 2 symbols' ;
    }

    if (!Validation::checkEmail($_POST['email'])) {
        $errors[] = 'Email is wrong';
    }

    if (!Validation::checkPassword($_POST['password'])) {
        $errors[] = 'Password doesn\'t be less 3 symbols' ;
    }

    if ($errors == false) {
        $db = $db->getConnection();

        $sql = 'SELECT * FROM users WHERE firstname = :firstname AND email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
        $result->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $result->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            if ($user['is_active'] == '0') {
                $errors[] = 'Please check your email and verificite' ;
            } else {
                session_start();
                $_SESSION['firstname'] = $_POST['firstname'];
                $_SESSION['user_id'] = $user['user_id'];

                header("Location: /content");
            }
        } else {
            $errors[] = 'First name, email or password is wrong';
        }
    }
}
?>

<?php include('header.php'); ?>
    <h1 class="mb-4">Login</h1>
    <?php if (isset($_SESSION['flash'])) { ?>
        <div class="alert alert-success" role="alert">
            Your verification is done!
        </div>
    <?php } ?>
    <form method="POST">
        <input type="hidden" name="login">
        <div class="form-group">
            <label for="firstname_input">First name</label>
            <input name="firstname" type="text" class="form-control" id="firstname_input" placeholder="Enter your first name..." value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="email_input">Email</label>
            <input name="email" type="text" class="form-control" id="email_input" placeholder="example@gmail.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="password_input">Password</label>
            <input name="password" type="password" class="form-control" id="password_input" placeholder="Enter your password...">
        </div>
        <button type="submit" class="btn btn-primary mb-4 btn-block">Login</button>
    </form>
    <?php if (isset($errors) && is_array($errors)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </div>
    <?php } ?>
<?php include('footer.php'); ?>