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
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
            <img style="margin-left:35px;" src="img/Blogger-2.png" alt="">
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

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
            <form name="myform" method="post" action='storeupdatedblog.php?type=1'>

                <div class="form-group form-inline">
                    <div class="form-group col-lg-6 col-md-6 name">
                        <input type="hidden" value=<?php echo ucfirst($row3['bid']); ?> class="form-control" name="id" id="name" placeholder="BlogID" readonly>
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
    </div>









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