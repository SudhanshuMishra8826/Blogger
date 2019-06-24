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
    $title=$_REQUEST['name'];
    $content=$_REQUEST['content'];
    $sql = "update blog set title=:title, content=:content, status='requested' where bid=:bid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':bid', $bid);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);

    $stmt->execute();

    if (isset($_GET['type'])&&$_GET['type'] == 1) {
        echo "<script>
            alert('Blog Updated');
           window.location.href='adminblogs.php?type=0';
           </script>";
        #echo "Blog Updated: You will be redirected to forum whrer you can see your post<br>";
        #header('Refresh: 1 ; admindashboard.php');
    }
    else{
    #echo "Blog Updated : You will be redirected to forum whrer you can see your post<br>";
    #header('Refresh: 1 ; dashboard.php');
    }

    ?>