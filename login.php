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
    
    if ($user) {
        if ($user['is_active'] == '0') {
            $error = 'User isn\'t active' ;
        } else {
            session_start();
            $_SESSION['firstname'] = $_POST['firstname'];
            $_SESSION['user_id'] = $user['user_id'];

            header("Location: /content");
        }
        
    }
}
?>

<?php include('header.php'); ?>
    <h1 class="mb-4">Login</h1>
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
    <?php if($error) { ?>
        <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
        </div>
    <?php } ?>
<?php include('footer.php'); ?>