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

    <title>Admin- Add User</title>
    <link rel="stylesheet" type="text/css" href="css/dash1.css">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <!--<link rel="stylesheet" href="style.css">-->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <script type="text/javascript">
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


        function validateform() {
            var name = document.myform.name.value;
            var email = document.myform.email.value;
            var pass = document.myform.pass.value;

            var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

            if (name == null || name == "" || email == null || email == "") {
                alert("Any feild can't be blank");
                return false;
            }
            else {
                if (pass.match(passw)) {
                    return true;
                } else {

                    alert("Try a better password with atleast One UPPERCASE CHARACTER, One LOWERCASE CHARACTER, and ONE NUMBER ");
                    return false;
                }
            }

        }
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'inc/adminheader.php'; ?>

            </nav>
            <h2>Hello <?php echo ucfirst($_SESSION["user"]); ?> !!!!</h2>
            <br>
            <div id='response'>
                <table class="table table-borderless">

                    <div class='well' style='text-align:center; margin-top:40px; margin-bottom:30px;'>
                        <form name="myform" method="post" action="createuser.php?type=1" onsubmit="return validateform()">
                            <p>
                                Create Username :
                                <input type="text" name="name" />
                            </p>
                            <p>
                                Create Password :
                                <input type="Password" name="pass" />
                            </p>
                            <p>
                                Enter Email :
                                <input type="email" name="email" />
                            </p>
                            <p>
                                <input type="submit" name="submit" value="Submit" />
                            </p>
                        </form>
                    </div>
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