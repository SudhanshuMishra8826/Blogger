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
        Update Profile
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


    if (isset($_GET['type']) && $_GET['type'] == 1) {

        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $sql = "update admin set name=:name, email=:email where id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        echo "<script>
            alert('Account Details Updated');
           window.location.href='admindashboard.php';
           </script>";
    } 
    elseif(isset($_GET['type']) && $_GET['type'] == 2) {

        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $pass = $_REQUEST['pwd'];
        $email = $_REQUEST['email'];
        $sql = "update users set uname=:name, pwd=:pass, email=:email where uid=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        echo "<script>
            alert('Account Details Updated');
           window.location.href='admindashboard.php';
           </script>";

        #echo "Account Updated : You will be redirected to login page so you can log in with nwe credentials<br>";
    } else {

        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $sql = "update users set uname=:name, email=:email where uid=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        echo "<script>
            alert('Account Details Updated');
           window.location.href='profile.php';
           </script>";
    }

    ?>