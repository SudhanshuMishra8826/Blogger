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
        Delete Blog
    </title>
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

    $bid = $_REQUEST['id'];

    $sql = "
    DELETE FROM blog WHERE bid=:bid ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':bid', $bid);

    $stmt->execute();
    if ($_GET['type'] == 1) {
        echo "Blog Deleted: You will be redirected to forum whrer you can see your post<br>";
        header('Refresh: 1 ; admindashboard.php');
    }
    else{
        echo "Blog Deleted: You will be redirected to forum whrer you can see your post<br>";
        header('Refresh: 1 ; dashboard.php');

    }


    ?>