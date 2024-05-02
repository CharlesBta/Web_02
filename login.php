<?php
global $dbPDO;
require_once('pdo.php');
?>

<!<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jersey+15&display=swap');
        h1 {
            font-family: "Jersey 15", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
    <form action="submit_login.php" method="POST">
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="name@company.com">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="password">
        </div>
        <input type="submit" value="Login">
        <p>
            Register <a href="register.php">here</a>
        </p>
    </form>
</body>
</html>
