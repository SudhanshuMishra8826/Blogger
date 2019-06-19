<?php
session_start();
session_unset();
?>

<html>

<head>
  <title>
    Please Login
  </title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    .button {
      text-decoration: none;
      display: block;

      background: #4E9CAF;
      padding: 10px;
      text-align: center;
      border-radius: 5px;
      color: white;
      font-weight: bold;
    }
  </style>
  <script>
    function validateform() {
      var name = document.myform.name.value;
      var pass = document.myform.pass.value;

      if (name == null || name == "" || pass == null || pass == "") {
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
  <!-- Login Section -->

  <div class='well' style='text-align:center; margin-top:40px; margin-bottom:30px;'>
    <form style="margin-top:130px;" name='myform' method="post" action=<?php echo (isset($_GET['type']) && $_GET['type'] == 0 ? "dashboard.php" : "admindashboard.php"); ?> onsubmit='return validateform()'>
      <p>
        Username :
        <input type="text" name="name" />
      </p>
      <p>
        Password :
        <input type="Password" name="pass" />
      </p>
      <p>
        <input class='btn btn-dark' style="margin-left:80px;" type="submit" name="submit" value="Submit" />
      </p>
    </form>
  </div>



</body>

</html>