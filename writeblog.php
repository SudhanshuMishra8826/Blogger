<?php
#setcookie("name",$_POST['name'],time()+60);
session_start();

if ($_SESSION['authuser'] != 1) {
    echo " Access not granted ";
    exit();
}

?>
<html>

<head>
    <title>
        Write Blog
    </title>

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
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

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
    </script>
    <script>
        $(document).ready(function() {
            $('#myformid').on('submit', function(e) {
                //Stop the form from submitting itself to the server.
                e.preventDefault();

                var title = $('#name').val();
                var content = $('#content').val();

                $.ajax({
                    type: "POST",
                    url: 'storeblog.php',
                    data: {
                        name: name,
                        content: content
                    },
                    success: function() {
                        alert("Blog Requested");
                    }
                });
            });
        });
    </script>
</head>

<body>

    <?php
    include 'inc/userheader.php';
    ?>

    <div class="comment-form">
        <h2 style="text-align:center;">“Stories can conquer fear, you know. They can make the heart bigger.”</h2>
        </br>
        <h2>So Start Writing...........</h2>
        <form id="myformid" name="myform" method="post" action='storeblog.php' onsubmit="return validateform()">
            <div class="form-group form-inline">
                <div class="form-group col-lg-6 col-md-6 name">
                    <input type="text" class="form-control" name="title" id="name" placeholder="Enter Title">
                </div>
            </div>
            <div class="form-group">
                <textarea id="content" class="form-control mb-10" rows="5" name="content" placeholder="Write Your Story Here"></textarea>
            </div>

            <p>
                <input style="margin-left: 150px;" class="button" type="submit" name="submit" value="Submit" />
            </p>
        </form>
    </div>
</body>

</html>