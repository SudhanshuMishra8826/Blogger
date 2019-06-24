<?php
#setcookie("name",$_POST['name'],time()+60);
session_start();

if ($_SESSION['authuser'] != 1) {
    echo " Access not granted ";
    exit();
}
?>

<script type="text/javascript">
    function getusers() {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("responsetable").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getusers.php", true);
        xmlhttp.send();
    }

    function updateuser(id) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("response").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "updateuser.php?id=" + id, true);
        xmlhttp.send();
    }


    function validateform() {
        var name = document.myform.name.value;
        var pass = document.myform.pass.value;
        var email = document.myform.email.value;


        if (name == null || name == "" || pwd == null || pwd == "" || email == null || email == "") {
            alert("Any feild can't be blank");
            return false;
        }
    }
</script>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdb";
#echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

$dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
$pdo = new PDO($dsn, $username, $password);

$id = $_GET['id'];
$sql = "select * from users where uid=:id ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);

$stmt->execute();

while ($row3 = $stmt->fetch(PDO::FETCH_ASSOC)) {
    #var_dump($row3);
    echo "<h1>Update Your Details</h1>";
    echo "<form name=\"myform\" method=\"post\" action='storeupdatedprofile.php?type=2' onsubmit='return validateform()'>";
    echo "Edit feilds you want to Update<br>";

    echo "<div class=\"form-group form-inline\">";
    echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
    echo "<input type=\"hidden\" value=" . $row3['uid'] . " class=\"form-control\" name=\"id\" id=\"name\" placeholder=\"BlogID\" readonly>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"form-group form-inline\">";
    echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
    echo "<input type=\"text\" value=" . $row3['uname'] . " class=\"form-control\" name=\"name\" id=\"name\" placeholder=\"Enter Title\" required>";
    echo "</div>";
    echo "</div>";

    echo "<div class=\"form-group form-inline\">";
    echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
    echo "<input type=\"hidden\" value=" . $row3['pwd'] . " class=\"form-control\" name=\"pwd\" id=\"pwd\" placeholder=\"Enter Title\">";
    echo "</div>";
    echo "</div>";

    echo "<div class=\"form-group form-inline\">";
    echo "<div class=\"form-group col-lg-6 col-md-6 name\">";
    echo "<input type=\"text\" value=" . $row3['email'] . " class=\"form-control\" name=\"email\" id=\"email\" placeholder=\"Enter Title\" required>";
    echo "</div>";
    echo "</div>";
    echo "<p>";
    echo "<input class=\"button\" type=\"submit\" name=\"submit\" value=\"Submit\" />";
    echo "</p>";
    echo "</form>";
}



?>