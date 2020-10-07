<?php
include("connection/connect.php");
session_start();
if (isset($_SESSION['username'])) {

            $userselect = $_SESSION['username'];
               $userprotect = "SELECT usertypeid FROM Users WHERE UserName = '$userselect'";
$protectsession = $conn->query($userprotect) or die($mydb->error);
while($rowdata = $protectsession->fetch_assoc()){
    $usertype = $rowdata['usertypeid'];

    if ($usertype == '2') {
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
            
            if(!$usertypeid==1){
                header("location:login.php?unauthorised=1");
            }
            
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h2>USER REVIEWS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ReviewID</th>
                         <th>BookingID</th>
                        <th>UserID</th>
                        <th>Forename</th>
                        <th>Surname</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>content</th>
                        <th>Rating</th>
                        <th>Valid</th>
                        <th>Venue</th>
                        <th>Location</th>
                        <th>Event Image</th>
                    </tr>
                </thead>
                <?php
                $viewallbookings = "SELECT * FROM Users INNER JOIN Reviews ON Users.user_id=Reviews.userid INNER JOIN Booking1 ON Users.user_id=Booking1.bookinguser INNER JOIN Events ON Booking1.bookingevent=Events.event_id INNER JOIN Venue ON Events.venueid=Venue.venue_id INNER JOIN Performance ON Events.performanceid=Performance.performance_id";

                $result = $conn->query($viewallbookings);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $review_id = $row["review_id"];
                    $review_title = $row["title"];
                    $review_content = $row["content"];
                    $review_rating = $row["rating"];
                    $review_validation = $row["valid"];
                    $review_booking_id = $row["booking_id"];
                    $review_booking_user_id = $row["user_id"];
                    $review_booking_user_forename = $row["forename"];
                    $review_booking_user_surname = $row["surname"];
                    $review_booking_event_id = $row["event_id"];
                    $review_booking_event_name = $row["eventname"];
                    $review_booking_event_date = $row["date"];
                    $review_booking_event_time = $row["time"];
                    $review_booking_event_venue = $row["venuename"];
                    $review_booking_event_location = $row["location"];
                    $review_booking_event_performances = $row["performancename"];
                    $review_booking_event_image = $row["eventimage1"];
                }
                echo "<thead>
                    <tr>
                     <th>$review_id</th>
                        <th>$review_booking_id</th>
                        <th>$review_booking_user_id</th>
                        <th>$review_booking_user_forename</th>
                        <th>$review_booking_user_surname</th>
                        <th>$review_booking_event_name</th>
                        <th>$review_booking_event_date</th>
                             <th>$review_title</th>
                             <th>$review_content</th>
                                 <th>$review_rating</th>
                                     <th>$review_validation</th>
                        <th>$review_booking_event_time</th>
                        <th>$review_booking_event_venue</th>
                        <th>$review_booking_event_location</th>
                        <th>$review_booking_event_performances</th>
                        <th>$review_booking_event_image</th>
                            <td><a href='adminreviewvalidate.php?validatereview=$review_id'>Validate Review</a></td>
                                   <td><a href='adminremovereview.php?adminremovereview=$review_id'>Remove Review</a></td> 
                    </tr>
                </thead>
                
                   
          
           ";
                ?>
                </body>
                </html>
