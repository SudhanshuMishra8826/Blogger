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

    <link rel="stylesheet" href="css/style.css">
    <script>
        function validateform() {
            var name = document.myform.name.value;
            var pass = document.myform.pass.value;
            var email= document.myform.email.value;

            if (name == null || name == "" || pwd == null || pwd == ""|| email == null || email == "") {
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

<body>

    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container box_1620">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-center">
                            <li class="nav-item active"><a class="nav-link" href="dashboard.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="writeblog.php">WriteUp</a></li>
                            <li class="nav-item"><a class="nav-link" href="getbloguser.php">All Blogs</a>
                            <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="site-main">
        <!--================Hero Banner start =================-->
        <section class="mb-30px">
            <div class="container">
                <div class="hero-banner">
                    <div class="hero-banner__content">
                        <h1>Hello <?php echo ucfirst($_SESSION['user']); ?></h1>
                        <h3>User ID : <?php echo ucfirst($row3['uid']); ?></h3>
                        <h3>Password : <?php echo ucfirst($row3['pwd']); ?></h3>
                        <h3>Email : <?php echo ucfirst($row3['email']); ?></h3>


                        <div class="col-md-12 text-center" style=" margin-top:50px;">
                            <button id="singlebutton" name="singlebutton" class="button" onclick="updateprofile()">
                                <h5 style="color:white; padding-top:5px;"> Update Details!</h5>
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