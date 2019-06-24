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
    <?php include'inc/visitorheader.php' ?>


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