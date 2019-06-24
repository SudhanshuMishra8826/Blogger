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
        Approve Blog
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
    $sql = "update blog set status='published' where bid=:bid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':bid', $bid);
    $stmt->execute();

    echo "<script>
            alert('Blog Approved');
           window.location.href='adminblogs.php?type=0';
           </script>";


    ?>