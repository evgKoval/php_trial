<?php 
    if (isset($_SESSION['user_id'])) {
        require 'db/db.php';

        $db = $db->getConnection();

        $sql = 'SELECT * FROM users WHERE user_id = :user_id';

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_STR);

        $result->execute();

        $user = $result->fetch(PDO::FETCH_ASSOC);

        if ($user['is_active'] != 1) {
            die('You have no permission');
        }
    } else {
        header("Location: /404");
    }
?>

<?php include('header.php'); ?>
    <table id="data" class="display">
        <thead>
            <tr>
                <th>First name</th>
                <th>Title</th>
                <th>Text</th>
                <th>Created at</th>
            </tr>
        </thead>
    </table>
<?php include('footer.php'); ?>