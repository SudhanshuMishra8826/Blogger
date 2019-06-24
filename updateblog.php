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
<html>

<head>
    <title>
        Update Blog
    </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Blog</title>
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
            $('#my_form_id').on('submit', function(e) {
                //Stop the form from submitting itself to the server.
                e.preventDefault();
                var id = $('#id').val();
                var name = $('#title').val();
                var content = $('#content').val();

                $.ajax({
                    type: "POST",
                    url: 'storeupdatedblog.php',
                    data: {
                        id: id,
                        name: name,
                        content: content
                    },
                    success: function() {
                        alert("Blog Updated");
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
        <h2>So Start Updating...........</h2>
        <form id="my_form_id" name="myform" method="post" action='storeupdatedblog.php'>

            <div class="form-group form-inline">
                <div class="form-group col-lg-6 col-md-6 name">

                    <input type="hidden" value=<?php echo ucfirst($row3['bid']); ?> class="form-control" name="id" id="id" placeholder="BlogID" readonly>
                </div>
            </div>
            <div class="form-group form-inline">
                <div class="form-group col-lg-6 col-md-6 name">
                    <input type="text" value=<?php echo ucfirst($row3['title']); ?> class="form-control" name="title" id="title" placeholder="Enter Title">
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control mb-10" id="content" rows="5" name="content" placeholder="Write Your Story Here"><?php echo $row3["content"]; ?></textarea>
            </div>

            <p>
                <input style="margin-left: 150px;" class="button" type="submit" name="submit" value="Submit" />
            </p>
        </form>
    </div>
</body>

</html>