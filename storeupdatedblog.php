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
        Update Blog
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

    $bid=$_REQUEST['id'];
    $title=$_REQUEST['title'];
    $content=$_REQUEST['content'];
    $sql = "update blog set title=:title, content=:content where bid=:bid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':bid', $bid);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);

    $stmt->execute();

    if ($_GET['type'] == 1) {
        echo "Blog Updated: You will be redirected to forum whrer you can see your post<br>";
        header('Refresh: 1 ; admindashboard.php');
    }
    else{
    echo "Blog Updated : You will be redirected to forum whrer you can see your post<br>";
    header('Refresh: 1 ; dashboard.php');
    }

    ?>