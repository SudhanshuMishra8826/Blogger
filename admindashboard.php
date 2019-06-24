<?php


ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
#setcookie("name",$_POST['name'],time()+60);
session_start();
if (isset($_POST['name']) && isset($_POST["pass"])) {
    $_SESSION["user"] = $_POST['name'];
    $_SESSION["password"] = hash('sha256', $_POST['pass']);

    $_SESSION["authuser"] = 0;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blogdb";
    #echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

    $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $username, $password);

    $sql = "SELECT * from admin where name=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["user"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (($_SESSION["password"] == $row['pwd'])) {
        $_SESSION["authuser"] = 1;
    } else if ($_SESSION["authuser"] == 1) { } else {
        echo "<script>
        alert('Incorrect user id or password');
            window.location.href='login.php?type=1';
            </script>";
        exit();
    }
} elseif ($_SESSION["authuser"] == 1) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blogdb";
    #echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

    $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $username, $password);

    $sql = "SELECT * from admin where name=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["user"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location:login.php?type=1");
}
#$_SESSION["user"]=isset($_POST["name"])?$_POST["name"]:$_SESSION["user"];
#$_SESSION["password"]=isset($_POST["pass"])?$_POST["pass"]:$_SESSION['password'];


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Dash board</title>
    <link rel="stylesheet" type="text/css" href="css/dash1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--<link rel="stylesheet" href="style.css">-->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <script type="text/javascript">

    //Function to get all the user
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
                    document.getElementById("response").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getusers.php", true);
            xmlhttp.send();
        }

    //Function to update user

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

    //Function to validate form

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
</head>

<body style="font-family:'Lora';color: #3a414e;line-height: 1.333;">

    <div class="wrapper">
        <?php include 'inc/adminheader.php'; ?>
        
            <h2>Hello <?php echo ucfirst($_SESSION["user"]); ?> !!!!</h2>
            <br>
            <div id='response'>
                <table class="table table-borderless">

                    <thead>
                        <tr class="text-center" style="margin-top: 0px;  border: solid; border-color:#4db8ff;">
                            <th colspan="2" scope="col">Your Details</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr style="margin-top: 0px; border-top: solid; border-color:#fff;">

                            <td>Username : <b><?php echo ucfirst($row['name']); ?></b></td>

                        </tr>
                        <tr style="margin-top: 0px; border-top: solid; border-color:#fff;">

                            <td>Email : <b><?php echo $row['email']; ?></b></td>

                        </tr>

                    </tbody>
                </table>
            </div>
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