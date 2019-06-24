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
$sql = "select * from admin where name=:name and pwd=:pass ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':pass', $pass);

$stmt->execute();

$row3 = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Profile</title>
    <link rel="stylesheet" type="text/css" href="css/dash1.css">

    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <!--<link rel="stylesheet" href="style.css">-->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <script type="text/javascript">
        //This function loads profile upload form
        function updateprofile() {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "updateprofile.php?type=1", true);
            xmlhttp.send();
        }

        //This loads password update form    
        function updatepassword() {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "updateadminpassword.php", true);
            xmlhttp.send();
        }

        //This loads profile image form 

        function updateprofileimage(id) {
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
            xmlhttp.open("GET", "updateprofileimage.php?id=" + id, true);
            xmlhttp.send();
        }
        //This calls upload image function
        function submitForm(event, id) {
            // prevent default form submission
            event.preventDefault();
            uploadImage(id);
        }

        //This function calls the php script to uploads image 

        function uploadImage(id) {

            window.previewImage = document.getElementById("preview");
            window.uploadingText = document.getElementById("uploading-text");
            var imageSelecter = document.getElementById("image-selecter"),
                file = imageSelecter.files[0];
            if (!file)
                return alert("Please select a file");
            // clear the previous image
            previewImage.removeAttribute("src");
            // show uploading text
            uploadingText.style.display = "block";
            // create form data and append the file
            var formData = new FormData();
            formData.append("image", file);
            console.log(file);
            // do the ajax part
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    var json = JSON.parse(this.responseText);
                    if (!json || json.status !== true)
                        return uploadError(json.error);

                    showImage(json.url);
                }
            }
            ajax.open("POST", "upload.php?id=" + id, true);
            ajax.send(formData); // send the form data
        }
        //error alert while image upload 
        function uploadError(error) {
            // called on error
            alert(error || 'Something went wrong');
        }
        // Displays uploaded image 
        function showImage(url) {
            previewImage.src = url;
            uploadingText.style.display = "none";
        }
        //form validation
        function validateform() {
            var name = document.myform.name.value;
            var pass = document.myform.pass.value;
            var email = document.myform.email.value;


            if (name == null || name == "" || pwd == null || pwd == "" || email == null || email == "") {
                alert("Any feild can't be blank");
                return false;
            }
        }

        function validateform2() {
            var name = document.myform.name.value;
            var email = document.myform.email.value;


            if (name == null || name == "" || email == null || email == "") {
                alert("Any feild can't be blank");
                return false;
            }
        }
        //function to get all the users
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

        //Function to load update user form

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

        //Password checking and validation

        function validatePassword() {
            var currentPassword, newPassword, confirmPassword, output = true;

            currentPassword = document.frmChange.currentPassword;
            newPassword = document.frmChange.newPassword;
            var pass = document.frmChange.newPassword.value;
            confirmPassword = document.frmChange.confirmPassword;

            if (!currentPassword.value) {
                currentPassword.focus();
                document.getElementById("currentPassword").innerHTML = "required";
                output = false;
            } else if (!newPassword.value) {
                newPassword.focus();
                document.getElementById("newPassword").innerHTML = "required";
                output = false;
            } else if (!confirmPassword.value) {
                confirmPassword.focus();
                document.getElementById("confirmPassword").innerHTML = "required";
                output = false;
            }
            if (newPassword.value != confirmPassword.value) {
                newPassword.value = "";
                confirmPassword.value = "";
                newPassword.focus();
                document.getElementById("confirmPassword").innerHTML = "not same";
                output = false;
            }

            var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            if (!pass.match(passw)) {

                output = false;
                alert("Weak Password");
            }
            return output;
        }
    </script>

</head>

<body style="font-family:'Lora';color: #3a414e;line-height: 1.333;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'inc/adminheader.php'; ?>

            <div id='response'>
                <main class="site-main">
                    <!--================Hero Banner start =================-->
                    <section class="mb-30px">
                        <div class="container">
                            <div class="hero-banner2">
                                <div class=" hero-banner__content">
                                    <?php
                                    if ($row3['imageurl'] != null || $row3['imageurl'] != '') {
                                        echo '<img src="' . $row3['imageurl'] . '" class="rounded-circle" width="200" height="250" >';
                                    } else {
                                        echo '<img src="img/fc.jpeg" class="rounded-circle">';
                                    }
                                    ?>
                                    <h1>Hello <?php echo ucfirst($_SESSION['user']); ?></h1>
                                    <h3>Email : <?php echo ucfirst($row3['email']); ?></h3>


                                    <div class="col-md-12 text-center" style=" margin-top:50px;">
                                        <button id="singlebutton" name="singlebutton" class="btn btn-light" onclick="updateprofile()">
                                            <h5 style="padding-top:5px; margin-bottom:3px;"> Update Details!</h5>
                                        </button>
                                        <button id="singlebutton" name="singlebutton" class="btn btn-light" onclick="updateprofileimage(<?php echo $row3['id']; ?>)">
                                            <h5 style="padding-top:5px; margin-bottom:3px;"> Update Profile Image!</h5>
                                        </button>

                                        <button id="singlebutton" name="singlebutton" class="btn btn-light" onclick="updatepassword()">
                                            <h5 style="padding-top:5px; margin-bottom:3px;"> Update Password!</h5>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </section>
                    <div class=container id="txtHint" style="border: solid 4px; padding:50px; text-align:center"></div>
                </main>

                <div class="col-md-12 text-center" style=" margin-top:50px;">
                    <a href=<?php echo "deleteaccount.php?type=1&&id=" . $row3['id'] ?> id="singlebutton" name="singlebutton" class="btn btn-primary">
                        <h5 style="color:white; padding-top:5px;"> Delete Account!</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>