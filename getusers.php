<?php
#setcookie("name",$_POST['name'],time()+60);
session_start();

if ($_SESSION['authuser'] != 1) {
    echo " Access not granted ";
    exit();
}
?>

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
                document.getElementById("responsetable").innerHTML = this.responseText;
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
        var pass = document.myform.pass.value;
        var email = document.myform.email.value;


        if (name == null || name == "" || pwd == null || pwd == "" || email == null || email == "") {
            alert("Any feild can't be blank");
            return false;
        }
    }
</script>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdb";
#echo "Movie Review of ".ucfirst($_POST['num'])."<br><br>";

$dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
$pdo = new PDO($dsn, $username, $password);

$sql = "SELECT * from users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
echo "<table id='responsetable' class=\"table table-borderless\">";
echo '<thead>';
echo '<tr class="text-center" style="margin-top: 0px;  border: solid; border-color:#4db8ff;">';
echo '<th>User ID</th>';
echo '<th>User Name</th>';
echo '<th>Password </th>';
echo '<th>User Email</th>';
echo '<th>Edit</th>';
echo '<th>Delete</th>';

echo '</tr></thead>';
echo '<tbody>';

while ($row3 = $stmt->fetch(PDO::FETCH_ASSOC)) {
    #var_dump($row3);
    echo '<tr>';
    echo '<td style="text-align:center">';
    echo $row3['uid'];
    echo '</td>';
    echo '<td style="text-align:center">';
    echo $row3['uname'];
    echo '</td>';
    echo '<td style="text-align:center">';
    echo $row3['pwd'];
    echo '</td>';
    echo '<td style="text-align:center">';
    echo $row3['email'];
    echo '</td>';

    echo '<td style="text-align:center">';
    echo '<a style="padding:3px 14px;" class="btn btn-primary" onclick="updateuser(' . $row3['uid'] . ')" >Edit</a>';
    echo '</td>';

    echo '<td style="text-align:center">';
    echo '<a style="padding:3px 14px;" class="btn btn-primary" href="deleteaccount.php?type=1&&id=' . $row3['uid'].'" >Delete</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';

echo '<a style="padding:3px 14px;" class="btn btn-primary" href="adduser.php?type=1" >Add User</a>';



?>