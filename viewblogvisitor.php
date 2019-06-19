<?php

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
        Blogs
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
    </script>
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
                            <!--<li class="nav-item"><a class="nav-link" href="login.php">LogIn</a>-->
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">LogIn</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="login.php?type=0">User</a></li>
                                    <li class="nav-item"><a class="nav-link" href="login.php?type=1">Admin</a></li>
                                </ul>
                            </li>
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

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-14">
                    <div class="main_blog_details">
                        <img class="img-fluid rounded mx-auto d-block" src=<?php echo 'img/blog/blog' . $_GET['bg'] . '.png'; ?> alt="">
                        <a href="#"><br>
                            <h4><?php echo ucfirst($row3['title']); ?></h4>
                        </a>
                        <div class="user_details">
                            <div class="float-right mt-sm-0 mt-3">
                                <div class="media">
                                    <div class="media-body">
                                        <h5><?php echo ucfirst($row3['uname']); ?></h5>
                                        <p><?php echo $row3['createdat']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p><?php echo substr($row3['content'], 0, 30); ?></p>
                        <p><?php echo substr($row3['content'], 30, 60); ?></p>
                        <blockquote class="blockquote">
                            <p class="mb-0">MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training.</p>
                        </blockquote>
                        <p><?php echo substr($row3['content'], 60, 90); ?></p>
                        <p><?php echo substr($row3['content'], 90,); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="disqus_thread"></div>
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = 'https://sdblog-1.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</body>

</html>