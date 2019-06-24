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

    <script>
        function validateform() {
            var name = document.myform.name.value;
            var pass = document.myform.pass.value;
            var email = document.myform.email.value;


            if (name == null || name == "" || pwd == null || pwd == "" || email == null || email == "") {
                alert("Any feild can't be blank");
                return false;
            }
        }

        function updateprofile() {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "updateprofile.php", true);
            xmlhttp.send();
        }
    </script>

</head>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdb";
#echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

$dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
$pdo = new PDO($dsn, $username, $password);

if (isset($_GET['type']) && $_GET['type'] == 1) {

    $name = $_SESSION['user'];
    $pass = $_SESSION['password'];
    $id;
    $sql = "select * from admin where name=:name and pwd=:pass ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':pass', $pass);

    $stmt->execute();

    while ($row3 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        #var_dump($row3);
        echo "<h1>Update Your Details</h1>";
        echo "<form name=\"myform\" method=\"post\" action='storeupdatedprofile.php?type=1' onsubmit='return validateform2()'>";

        echo "<div class=\"form-group form-inline\">";
        echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
        echo "<input type=\"hidden\" value=" . $row3['id'] . " class=\"form-control\" name=\"id\" id=\"name\" placeholder=\"BlogID\" readonly>";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"form-group form-inline\">";
        echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
        echo "<input type=\"text\" value=" . $row3['name'] . " class=\"form-control\" name=\"name\" id=\"name\" placeholder=\"Enter Title\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"form-group form-inline\">";
        echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
        echo "<input type=\"email\" value=" . $row3['email'] . " class=\"form-control\" name=\"email\" id=\"email\" placeholder=\"Enter Title\">";
        echo "</div>";
        echo "</div>";
        echo "<p>";
        echo "<input class=\"button\" type=\"submit\" name=\"submit\" value=\"Submit\" />";
        echo "</p>";
        echo "</form>";
    }
} else {
    $name = $_SESSION['user'];
    $pass = $_SESSION['password'];
    $id;
    $sql = "select * from users where uname=:name and pwd=:pass ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':pass', $pass);

    $stmt->execute();

    while ($row3 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        #var_dump($row3);
        echo "<h1>Update Your Details</h1>";
        echo "<form name=\"myform\" method=\"post\" action='storeupdatedprofile.php' onsubmit='return validateform2()'>";

        echo "Edit feilds you want to Update<br>";


        echo "<div class=\"form-group form-inline\">";
        echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
        echo "<input type=\"hidden\" value=" . $row3['uid'] . " class=\"form-control\" name=\"id\" id=\"id\" placeholder=\"BlogID\" readonly>";
        echo "</div>";
        echo "</div>";
                
        echo "<div class=\"form-group form-inline\">";
        echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
        echo "<input type=\"text\" value=" . $row3['uname'] . " class=\"form-control\" name=\"name\" id=\"name\" placeholder=\"Enter Title\">";
        echo "</div>";
        echo "</div>";

        echo "<div class=\"form-group form-inline\">";
        echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
        echo "<input type=\"email\" value=" . $row3['email'] . " class=\"form-control\" name=\"email\" id=\"email\" placeholder=\"Enter Title\">";
        echo "</div>";
        echo "</div>";
        echo "<p>";
        echo "<input class=\"button\" type=\"submit\" name=\"submit\" value=\"Submit\" />";
        echo "</p>";
        echo "</form>";
    }
}

?>