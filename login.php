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
<?php include'inc/visitorheader.php' ?>

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