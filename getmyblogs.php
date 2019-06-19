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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dash - Home</title>
    <link rel="icon" href="img/Fevicon.png" type="image/png">

    <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdb";
#echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

$dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
$pdo = new PDO($dsn, $username, $password);

$sql = "SELECT * from blog where uname=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION["user"]]);
$i=0;
while ($row3 = $stmt->fetch(PDO::FETCH_ASSOC)) {
    #var_dump($row3);
    $j=$i%8;

    echo "<div class=\"container\">";
    echo "<div class=\"row\">";
    echo "<div class=\"col-lg-15\">";
    echo '<div class="single-recent-blog-post" style="border:solid 4px #ff9; margin-left:0px; padding:5px 50px 5px 50px;">';
    echo '<div class="thumb">';
    echo '<img class="img-fluid" src="img/blog/blog'.$j.'.png" alt="">';
    echo '<ul class="thumb-info">';
    echo '<li><a href="#"><i class="ti-user"></i>'.$row3['uname'].'</a></li>';
    echo '<li><a href="#"><i class="ti-notepad"></i>'.$row3['createdat'].'</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '<div class="details mt-20">';
    echo '<a href="blog-single.html">';
    echo '<h3>'.$row3['title'].'</h3>';
    echo '</a>';
    echo '<p>'.ucfirst( substr($row3['content'],0,230)).'........</p>';
    echo '<a class="button" href="viewbloguser.php?bg='.$j.'&&id='.$row3["bid"].'" style="margin-left:130px;">Read More <i class="ti-arrow-right"></i></a>';
    echo '<a class="button" href="updateblog.php?id='.$row3["bid"].'" style="margin-left:150px;">Edit <i class="ti-arrow-right"></i></a>';
    echo '<a class="button" href="deleteblog.php?id='.$row3["bid"].'" style="margin-left:150px;">Delete <i class="ti-arrow-right"></i></a>';
    echo '</div>';
    echo '</div>';
    $i=$i+1;
}



?>