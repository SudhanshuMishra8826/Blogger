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

<body>
    <!--================Header Menu Area =================-->
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
                            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="signup.php">SignUp</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">LogIn</a>
                            <li class="nav-item submenu dropdown">
                                <a href="getblogsvisitors.php" class="nav-link dropdown-toggle">Blogs</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right navbar-social">
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                            <li><a href="#"><i class="ti-skype"></i></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <section id="txtHint" class="blog-post-area section-margin mt-4">
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "blogdb";
        #echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

        $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
        $pdo = new PDO($dsn, $username, $password);

        $sql = "SELECT * from blog where status='published'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row3 = $stmt->fetch(PDO::FETCH_ASSOC)) {
            #var_dump($row3);
            echo "<div class=\"container\">";
            echo "<div class=\"row\">";
            echo "<div class=\"col-lg-15\">";
            echo '<div class="single-recent-blog-post" style="border:solid 4px #ff9; margin-left:150px; padding:5px 50px 5px 50px;">';
            echo '<div class="thumb">';
            echo '<img class="img-fluid" src="img/blog/blog2.png" alt="">';
            echo '<ul class="thumb-info">';
            echo '<li><a href="#"><i class="ti-user"></i>' . $row3['uname'] . '</a></li>';
            echo '<li><a href="#"><i class="ti-notepad"></i>' . $row3['createdat'] . '</a></li>';
            echo '</ul>';
            echo '</div>';
            echo '<div class="details mt-20">';
            echo '<a href="blog-single.html">';
            echo '<h3>' . $row3['title'] . '</h3>';
            echo '</a>';
            echo '<p>' . ucfirst(substr($row3['content'], 0, 200)) . '......</p>';
            echo '<a class="button" href="viewblogvisitor.php?id=' . $row3["bid"] . '" style="margin-left:50px;">Read More <i class="ti-arrow-right"></i></a>';
            echo '</div>';
            echo '</div>';
        }




        ?>
    </section>
</body>

</html>