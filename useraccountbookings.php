<?php
include("connection/connect.php");
session_start();
$userselect = $_SESSION['username'];

             $userprotect = "SELECT usertypeid FROM Users WHERE UserName = '$userselect'";
$protectsession = $conn->query($userprotect) or die($mydb->error);
while($rowdata = $protectsession->fetch_assoc()){
    $usertype = $rowdata['usertypeid'];

    if ($usertype == '1') {
        header('location:login.php?unauthorised=1');
    }
    if ($usertype == '3') {
        header('location:login.php?unauthorised=1');
    }
    
}

      $userread = "SELECT * FROM Users WHERE username='$userselect'";

            $userresult = $conn->query($userread);
            

            while ($row = $userresult->fetch_assoc()) {
                $userid = $row["user_id"];
                $username = $row["username"];
                $userprofilepicture = $row["profilepicture"];
                $userforename = $row["forename"];
                $usersurname = $row["surname"];
                $userdateofbirth = $row["dateofbirth"];
                $useraddress = $row["address"];
                $userphonenumber = $row["phonenumber"];
                $useremail = $row["email"];
                $userauthorised=$row["authorised"];
                $usertypeid=$row["usertypeid"];
                
                
            }
            
            if(!$usertypeid==2){
                header("location:login.php?unauthorised=1");
            }
            if(!$userauthorised==1){
                header("location:login.php?unauthorised=1");
            
              }
            

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h2>CURRENT BOOKINGS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>BookingID</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Location</th>
                        <th>Performing</th>
                        <th>Event Image</th>
                    </tr>
                </thead>
                <?php
                $userbookingdetails = "SELECT * FROM Users INNER JOIN Booking1 ON Users.user_id=Booking1.bookinguser INNER JOIN Events ON Booking1.bookingevent=Events.event_id INNER JOIN Venue ON Events.venueid=Venue.venue_id INNER JOIN Performance ON Events.performanceid=Performance.performance_id WHERE Users.username='$userselect'";

                $result = $conn->query($userbookingdetails);

                if (!$result) {
                    echo $conn->error;
                 
                }

                while ($row = $result->fetch_assoc()) {
                    $booking_id = $row["booking_id"];
                    $booking_event_id=$row["event_id"];
                    $booking_event_name = $row["eventname"];
                    $booking_event_date = $row["date"];
                    $booking_event_time = $row["time"];
                    $booking_event_venue = $row["venuename"];
                    $booking_event_location = $row["location"];
                    $booking_event_performances= $row["performancename"];
                    $booking_event_image = $row["eventimage1"];
                }
                echo "<thead>
                    <tr>
                        <th>$booking_id</th>
                        <th>$booking_event_name</th>
                        <th>$booking_event_date</th>
                        <th>$booking_event_time</th>
                        <th>$booking_event_venue</th>
                        <th>$booking_event_location</th>
                        <th>$booking_event_performances</th>
                        <th>$booking_event_image</th>
                            <td><a href='removebooking.php?removebooking=$booking_id'>Cancel Booking</a></td>
                                <td><a href='reviewevent.php?reviewevent=$booking_id'>Write a review</a></td> 
                                    <td><a href='viewallbookingdetails.php?viewallbookingdetails=$booking_id'>View all details</a></td> 
                    </tr>
                </thead>
                
                   
          
           ";
                ?>
                </body>
                </html>
