<?php
#setcookie("name",$_POST['name'],time()+60);
session_start();

if ($_SESSION['authuser'] != 1) {
    echo " Access not granted ";
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Dash board</title>
    <link rel="stylesheet" type="text/css" href="css/dash1.css">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <!--<link rel="stylesheet" href="style.css">-->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

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
                    document.getElementById("txtHint").innerHTML = this.responseText;
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
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "updateuser.php?id=" + id, true);
            xmlhttp.send();
        }
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 style="color: #3a414e;" class="brand"> Sensive</h4>
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="admindashboard.php">Home</a>

                </li>
                <li class='dropdown-submenu'>
                    <a href="#">Blogs</a>
                    <ul class='list-unstyled components'>
                        <li>
                            <a tabindex="-1" href="adminblogs.php?type=3">New Blog</a></li>
                        <li><a tabindex="-1" href="adminblogs.php?type=0">Published</a></li>
                        <li><a tabindex="-1" href="adminblogs.php?type=1">Requested</a></li>
                    </ul>
                </li>
                <li>
                    <a onclick="getusers()">Users</a>
                </li>
                <li>
                    <a href="#">Help</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>

            </ul>



        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:0px;">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>

                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active btn btn-light">
                                <a class="nav-link" href='adminprofile.php'>
                                    <span class="fas fa-cog"></span> Profile
                                </a>
                            </li>
                            <li class="nav-item active btn btn-light" style="margin-left:4px;">
                                <a class="nav-link" href="login.php?type=1">
                                    <span class="fas fa-power-off"></span> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <section id="txtHint" class="blog-post-area section-margin mt-4">


                <?php

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "blogdb";
                #echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

                $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
                $pdo = new PDO($dsn, $username, $password);
                if ($_GET['type'] == 0) {
                    $sql = "SELECT * from blog where status='published'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $i = 0;

                    while ($row3 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        #var_dump($row3);
                        $j = $i % 8;

                        echo "<div class=\"container\">";
                        echo "<div class=\"row\">";
                        echo "<div class=\"col-lg-15\">";
                        echo '<div class="single-recent-blog-post" style="border:solid 4px lightblue; margin-left:0px; padding:5px 50px 5px 50px;">';
                        echo '<div class="thumb">';
                        echo '<img class="img-fluid" src="img/blog/blog' . $j . '.png" alt="">';
                        echo '<ul class="thumb-info">';
                        echo '<li><a href="#"><i class="ti-user"></i>' . $row3['uname'] . '</a></li>';
                        echo '<li><a href="#"><i class="ti-notepad"></i>' . $row3['createdat'] . '</a></li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '<div class="details mt-20">';
                        echo '<a href="blog-single.html">';
                        echo '<h3>' . $row3['title'] . '</h3>';
                        echo '</a>';
                        echo '<p>' . ucfirst(substr($row3['content'], 0, 150)) . '........</p>';

                        echo '<a class="button" href="adminblogs.php?bg=' . $j . '&&type=2&&action=0&&id=' . $row3["bid"] . '" style="margin-left:0px;">Read More <i class="ti-arrow-right"></i></a>';

                        echo '<a class="button" href="updateblogadmin.php?id=' . $row3["bid"] . '" style="margin-left:130px;">Edit <i class="ti-arrow-right"></i></a>';

                        echo '<a class="button" href="deleteblog.php?type=1&&id=' . $row3['bid'] . '" style="margin-left:130px;">Delete <i class="ti-arrow-right"></i></a>';

                        echo '</div>';
                        echo '</div>';
                        $i = $i + 1;
                    }
                } elseif ($_GET['type'] == 1) {
                    $sql = "SELECT * from blog where status='requested'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $i = 0;

                    while ($row3 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        #var_dump($row3);
                        $j = $i % 8;

                        echo "<div class=\"container\">";
                        echo "<div class=\"row\">";
                        echo "<div class=\"col-lg-15\">";
                        echo '<div class="single-recent-blog-post" style="border:solid 4px lightblue; margin-left:0px; padding:5px 50px 5px 50px;">';
                        echo '<div class="thumb">';
                        echo '<img class="img-fluid" src="img/blog/blog' . $j . '.png" alt="">';
                        echo '<ul class="thumb-info">';
                        echo '<li><a href="#"><i class="ti-user"></i>' . $row3['uname'] . '</a></li>';
                        echo '<li><a href="#"><i class="ti-notepad"></i>' . $row3['createdat'] . '</a></li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '<div class="details mt-20">';
                        echo '<a href="blog-single.html">';
                        echo '<h3>' . $row3['title'] . '</h3>';
                        echo '</a>';
                        echo '<p>' . ucfirst(substr($row3['content'], 0, 150)) . '........</p>';

                        echo '<a class="button" href="adminblogs.php?bg=' . $j . '&&type=2&&action=0&&id=' . $row3["bid"] . '" style="margin-left:0px;">Read More <i class="ti-arrow-right"></i></a>';

                        echo '<a class="button" href="updateblogadmin.php?id=' . $row3["bid"] . '" style="margin-left:90px;">Edit <i class="ti-arrow-right"></i></a>';

                        echo '<a class="button" href="deleteblog.php?type=1&&id=' . $row3["bid"] . '" style="margin-left:90px;">Delete <i class="ti-arrow-right"></i></a>';

                        echo '<a class="button" href="approveblog.php?id=' . $row3["bid"] . '" style="margin-left:90px;">Approve <i class="ti-arrow-right"></i></a>';

                        echo '</div>';
                        echo '</div>';
                        $i = $i + 1;
                    }
                } elseif ($_GET['type'] == 2) {
                    if ($_GET['action'] == 0) {

                        $sql = "SELECT * from blog where bid=?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$_GET['id']]);
                        $row3 = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo '<section class="blog-post-area section-margin">';
                        echo '<div class="container">';
                        echo '<div class="row">';
                        echo '<div class="col-lg-14">';
                        echo '<div class="main_blog_details">';
                        echo '<img class="img-fluid rounded mx-auto d-block" src="img/blog/blog' . $_GET['bg'] . '.png" alt="">';
                        echo '<a href="#">';
                        echo '<h4>' . ucfirst($row3['title']) . '</h4>';
                        echo '</a>';
                        echo '<div class="user_details">';
                        echo '<div class="float-right mt-sm-0 mt-3">';
                        echo '<div class="media">';
                        echo '<div class="media-body">';
                        echo '<h5>' . ucfirst($row3['uname']) . '</h5>';
                        echo '<p>' . $row3['createdat'] . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                        echo '<p>' . substr($row3['content'], 0, 30) . '</p>';
                        echo '<p>' . substr($row3['content'], 30, 60) . '</p>';
                        echo '<blockquote class="blockquote">
                                            <p class="mb-0">MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training.</p>
                                        </blockquote>';
                        echo '<p>' . substr($row3['content'], 60, 90) . '</p>';
                        echo '<p>' . substr($row3['content'], 90,) . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>';
                        echo '<div id="disqus_thread"></div>
                    <script>
                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page\'s canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page\'s unique identifier variable
                        };
                        */
                        (function() { // DON\'T EDIT BELOW THIS LINE
                            var d = document,
                                s = d.createElement("script");
                            s.src = "https://sdblog-1.disqus.com/embed.js";
                            s.setAttribute("data-timestamp", +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>';
                    }
                } elseif ($_GET['type'] == 3) {
                    echo '<div class="comment-form">';
                    echo '<h2 style="text-align:center;">“Stories can conquer fear, you know. They can make the heart bigger.”</h2>';
                    echo '</br>';
                    echo '<h2>So Start Writing...........</h2>';
                    echo '<form name="myform" method="post" action=\'storeblog.php?type=1\' onsubmit="return validateform()">';
                    echo '<div class="form-group form-inline">';
                    echo '<div class="form-group col-lg-6 col-md-6 name">';
                    echo '<input type="text" class="form-control" name="title" id="name" placeholder="Enter Title">';
                    echo '</div></div>';
                    echo '<div class="form-group">';
                    echo '<textarea class="form-control mb-10" rows="5" name="content" placeholder="Write Your Story Here"></textarea>';
                    echo '</div>';

                    echo '<p>';
                    echo '<input style="margin-left: 150px;" class="button" type="submit" name="submit" value="Submit" />';
                    echo '</p>';
                    echo '</form>';
                    echo '</div>';
                }
                ?>
            </section>









            <!-- jQuery CDN - Slim version (=without AJAX) -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <!-- Popper.JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                        $('#sidebar').toggleClass('active');
                    });
                });
            </script>
</body>

</html>