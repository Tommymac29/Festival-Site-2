<?php
include("connection/connect.php");
session_start();
           

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_POST["submitreview"])) {
                $reviewtitle = mysqli_real_escape_string($conn, $_POST["title"]);
                $reviewcontent = mysqli_real_escape_string($conn, $_POST["content"]);
                $reviewrating = mysqli_real_escape_string($conn, $_POST["rating"]);
                $reviewevent = mysqli_real_escape_string($conn, $_POST["id"]);
                $reviewuser = mysqli_real_escape_string($conn, $_POST["uid"]);
                
                
                $addbookingreview = "INSERT INTO `Reviews`(`title`, `content`, `rating`, `valid`, `userid`, `eventid`) VALUES ('$reviewtitle','$reviewcontent','$reviewrating','0', '$reviewuser','$reviewevent')";
                $insert_review = $conn->query($addbookingreview);
                 echo $reviewtitle;
                echo $reviewevent;
                 echo $reviewcontent;
                  echo $reviewrating;
                   echo $reviewuser;
                   echo $addbookingreview;
                   
                   header("location:useradminpannel.php");
            }
            ?>
    </body>
</html>
