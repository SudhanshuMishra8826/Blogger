<?php
#setcookie("name",$_POST['name'],time()+60);
session_start();

if ($_SESSION['authuser'] != 1) {
    echo " Access not granted ";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdb";
#echo "Movie Review of ".ucfirst($_POST['name'])."<br><br>";

$dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
$pdo = new PDO($dsn, $username, $password);

$name = $_SESSION['user'];
$pass = $_SESSION['password'];
$id;
$sql = "select * from users where uname=:name and pwd=:pass ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':pass', $pass);

$stmt->execute();

$row3 = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<html>

<head>
    <title>
        Profile
    </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/Fevicon.png" type="image/png">

    <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
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

        function validateform2() {
            var name = document.myform.name.value;
            var email = document.myform.email.value;

            if (name == null || name == "" || email == null || email == "") {
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


        function changepassword() {
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
            xmlhttp.open("GET", "updatepassword.php", true);
            xmlhttp.send();
        }

        function validatePassword() {
            var currentPassword, newPassword, confirmPassword, output = true;

            currentPassword = document.frmChange.currentPassword;
            newPassword = document.frmChange.newPassword;
            var pass = document.frmChange.newPassword.value;
            confirmPassword = document.frmChange.confirmPassword;

            if (!currentPassword.value) {
                currentPassword.focus();
                document.getElementById("currentPassword").innerHTML = "required";
                output = false;
            } else if (!newPassword.value) {
                newPassword.focus();
                document.getElementById("newPassword").innerHTML = "required";
                output = false;
            } else if (!confirmPassword.value) {
                confirmPassword.focus();
                document.getElementById("confirmPassword").innerHTML = "required";
                output = false;
            }
            if (newPassword.value != confirmPassword.value) {
                newPassword.value = "";
                confirmPassword.value = "";
                newPassword.focus();
                document.getElementById("confirmPassword").innerHTML = "not same";
                output = false;
            }

            var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            if (!pass.match(passw)) {

                output = false;
                alert("Weak Password");
            }
            return output;
        }
    </script>
</head>

<body>
    <?php
    include 'inc/userheader.php';
    ?>

    <main class="site-main">
        <!--================Hero Banner start =================-->
        <section class="mb-30px">
            <div class="container">
                <div class="hero-banner">
                    <div class="hero-banner__content">
                        <h1>Hello <?php echo ucfirst($_SESSION['user']); ?></h1>
                        <h3>Email : <?php echo $row3['email']; ?></h3>


                        <div class="col-md-12 text-center" style=" margin-top:50px;">
                            <button id="singlebutton" name="singlebutton" class="button" onclick="updateprofile()">
                                <h5 style="color:white; padding-top:5px;"> Update Details!</h5>
                            </button>
                        </div>
                        <div class="col-md-12 text-center" style=" margin-top:50px;">
                            <button id="singlebutton" name="singlebutton" class="button" onclick="changepassword()">
                                <h5 style="color:white; padding-top:5px;"> Change Password</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class=container id="txtHint" style="border: solid 4px; padding:50px; text-align:center"></div>
    </main>

    <div class="col-md-12 text-center" style=" margin-top:50px;">
        <a href=<?php echo "deleteaccount.php?id=" . $row3['uid'] ?> id="singlebutton" name="singlebutton" class="button">
            <h5 style="color:white; padding-top:5px;"> Delete Account!</h5>
        </a>
    </div>
</body>

</html>