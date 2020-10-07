<?php
include("connection/connect.php");

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_GET['removebooking'])){
    
    $remove_booking_id=$_GET['removebooking'];
    
    $remove_booking = "DELETE FROM Booking1 WHERE booking_id='$remove_booking_id'";
    
    $run_delete= mysqli_query($conn,$remove_booking);
    
       header("location:useradminpanel.php");
}
?>
       
    </body>
</html>
