<html>

<head>
    <title>
        Dashboard
    </title>
</head>

<body>
    <?php

    #include 'header.php';
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blogdb";
    echo "Movie Review of " . ucfirst($_POST['name']) . "<br><br>";

    $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $username, $password);

    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $email = $_POST['email'];

    $sql = "Insert into users(uname,pwd,email) values (:name,:pass,:email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if(isset($_GET["type"])&&$_GET["type"]==1){
        header('location: admindashboard.php');
    }else{
    header('location: login.php');
    }

    ?>