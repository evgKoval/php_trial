<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <style>
        <?php include 'css/style.css'; ?>
    </style>
</head>
<body>
    <header class="mb-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand mr-auto" href="/content">Blog</a>
            <nav>
                <?php if(!isset($_SESSION['firstname'])) { ?>
                    <div class="btn-group" role="group">
                        <a href="login" class="btn btn-outline-dark">Login</a>
                        <a href="register" class="btn btn-outline-dark">Register</a>
                    </div>
                <?php } ?>

                <?php if(isset($_SESSION['firstname'])) { ?>
                    <a href="logout" class="btn btn-outline-dark">Logout</a>
                <?php } ?>
            </nav>
        </nav>
    </header>
    <div class="container">