<?php
#setcookie("name",$_POST['name'],time()+60);
session_start();

if ($_SESSION['authuser'] != 1) {
    echo " Access not granted ";
    exit();
}

?>
<html>

<head>
    <title>
        Update Password
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blogdb";
    #echo "Movie Review of ".ucfirst($_POST['name'])."<br><br>";

    $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $username, $password);

    $name = $_SESSION['user'];
    $passold = $_REQUEST['currentPassword'];

    $sql = "select pwd from users where uname=:name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $row3 = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row3['pwd'] == hash('sha256', $passold)) {
        $pass = hash("sha256", $_REQUEST['confirmPassword']);

        $sql = "update users set pwd=:pass where uname=:name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':name', $name);

        $stmt->execute();

        echo "<script>
        alert('Password Changed , Login Again with new Password');
            window.location.href='login.php?type=0';
            </script>";
        #header('Refresh: 3 ; login.php?type=0');
    }

    ?>