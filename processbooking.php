<?php
include ("connection/connect.php");
session_start();

if(empty($_GET["rowid"])){
    $url = "events.php?booking=failed";
      header("Location: $url");      
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
    </head>
    <body>
        <?php
        $userselect = $_SESSION['username'];

            $eventbooking_id = $_GET["rowid"];
            
  echo "$userselect";
            
            echo "$eventbooking_id";

 $user_booking = "INSERT INTO `Booking1` (`bookingevent`,`bookinguser`) SELECT '$eventbooking_id' , Users.user_id FROM `Users` WHERE Users.username =  '$userselect'";

            $run_booking = mysqli_query($conn, $user_booking);

            if (!$run_booking) {
                echo $conn->error;
            }
             header("Location:events.php");
        
        ?>
    </body>
</html>
