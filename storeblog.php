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
        Dashboard
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

    if(isset($_GET['type'])&&$_GET['type']==1){

    $uname = $_SESSION['user'];
    #echo $uname;
    $sql = "SELECT uid from users where uname=:uname";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uname', $uname);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $uid=$row['uid'];
    
    #var_dump($_POST);
    $title = $_POST["title"];
    $content = $_POST["content"];
    $date = date("Y-m-d H:i:s");
    $status="published";
    $sql = "Insert into blog(uid,title,content,uname,createdat,status) values (:uid,:title,:content,:uname,:createdat,:status)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':uname', $uname);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':createdat', $date);
    $stmt->bindParam(':status', $status);


    $stmt->execute();
    
    echo "Post Published : You will be redirected to forum whrer you can see your post<br>";
    header('Refresh: 1 ; adminblogs.php?type=0');
    }else{
        $uname = $_SESSION['user'];
    #echo $uname;
    $sql = "SELECT uid from users where uname=:uname";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uname', $uname);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $uid=$row['uid'];
    
    #var_dump($_POST);
    $title = $_POST["title"];
    $content = $_POST["content"];
    $date = date("Y-m-d H:i:s");
    $status="requested";
    $sql = "Insert into blog(uid,title,content,uname,createdat,status) values (:uid,:title,:content,:uname,:createdat,:status)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':uname', $uname);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':createdat', $date);
    $stmt->bindParam(':status', $status);

    $stmt->execute();
    
    #echo "Post Requested : Your request for publishing this blog has been made,<br>";
    #header('Refresh: 1 ; dashboard.php');
    }

    ?>