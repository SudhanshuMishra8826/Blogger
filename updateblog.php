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
#echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

$dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
$pdo = new PDO($dsn, $username, $password);

$sql = "SELECT * from blog where bid=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET['id']]);
$row3 = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<html>

<head>
    <title>
        Update Blog
    </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Blog</title>
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
            var title = document.myform.title.value;
            var content = document.myform.content.value;

            if (title == null || title == "" || content == null || content == "") {
                alert("Any feild can't be blank");
                return false;
            }
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
                            <li class="nav-item"><a class="nav-link" href="signup.php">WriteUp</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">MyBlogs</a>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="comment-form">
        <h2 style="text-align:center;">“Stories can conquer fear, you know. They can make the heart bigger.”</h2>
        </br>
        <h2>So Start Updating...........</h2>
        <form name="myform" method="post" action='storeupdatedblog.php'>

            <div class="form-group form-inline">
                <div class="form-group col-lg-6 col-md-6 name">
                    (**** Blog Id is Not Editable*****)
                    <input type="text" value=<?php echo ucfirst($row3['bid']); ?> class="form-control" name="id" id="name" placeholder="BlogID" readonly>
                </div>
            </div>
            <div class="form-group form-inline">
                <div class="form-group col-lg-6 col-md-6 name">
                    <input type="text" value=<?php echo ucfirst($row3['title']); ?> class="form-control" name="title" id="name" placeholder="Enter Title">
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control mb-10" rows="5" name="content" placeholder="Write Your Story Here"><?php echo $row3["content"]; ?></textarea>
            </div>

            <p>
                <input style="margin-left: 150px;" class="button" type="submit" name="submit" value="Submit" />
            </p>
        </form>
    </div>
</body>

</html>