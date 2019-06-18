<?php


ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
#setcookie("name",$_POST['name'],time()+60);
session_start();
if (isset($_POST['name']) && isset($_POST["pass"])) {
    $_SESSION["user"] = $_POST['name'];
    $_SESSION["password"] = $_POST['pass'];

    $_SESSION["authuser"] = 0;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blogdb";
    #echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

    $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $username, $password);

    $sql = "SELECT pwd from users where uname=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["user"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (($_SESSION["password"] == $row['pwd'])) {
        $_SESSION["authuser"] = 1;
    } else if ($_SESSION["authuser"] == 1) { } else {
        echo " Access not granted ";
        exit();
    }
} elseif ($_SESSION["authuser"] == 1) { } else {
    header("Location:login.php?type=0");
}
#$_SESSION["user"]=isset($_POST["name"])?$_POST["name"]:$_SESSION["user"];
#$_SESSION["password"]=isset($_POST["pass"])?$_POST["pass"]:$_SESSION['password'];


?>
<html>

<head>
    <title>
        Dashboard
    </title>

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
    <script>
        function validateform() {
            var name = document.myform.name.value;
            var pass = document.myform.pass.value;

            if (name == null || name == "" || pass == null || pass == "") {
                alert("Any feild can't be blank");
                return false;
            }
        }

        function showmyblogs() {
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
                xmlhttp.open("GET", "getmyblogs.php", true);
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
                            <li class="nav-item"><a class="nav-link" href="login.php?type=0">Logout</a></li>
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
                        <div class="col-md-12 text-center" style=" margin-top:50px;">
                            <button id="singlebutton" name="singlebutton" class="button" onclick="showmyblogs()">
                                <h5 style="color:white; padding-top:5px;"> View My Blogs!</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Hero Banner end =================-->



        <section id="txtHint" class="blog-post-area section-margin mt-4">
            
        </section>
    </main>

</body>

</html>