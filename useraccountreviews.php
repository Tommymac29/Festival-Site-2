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
    <body><h2>LISTED EVENT REVIEWS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ReviewID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Rating</th>
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
                $userreviewdetails = "SELECT * FROM Users INNER JOIN Booking1 ON Users.user_id=Booking1.bookinguser INNER JOIN Events ON Booking1.bookingevent=Events.event_id INNER JOIN Venue ON Events.venueid=Venue.venue_id INNER JOIN Performance ON Events.performanceid=Performance.performance_id INNER JOIN Reviews ON Users.user_id=Reviews.userid WHERE Users.username='$userselect'";

                $result = $conn->query($userreviewdetails);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $review_id = $row["review_id"];
                    $review_title = $row["title"];
                    $review_content = $row["content"];
                    $review_rating= $row["rating"];
                    $review_event_id=$row["event_id"];
                    $review_event_name = $row["eventname"];
                    $review_event_date = $row["date"];
                    $review_event_time = $row["time"];
                    $review_event_venue = $row["venuename"];
                    $review_event_location = $row["location"];
                    $review_event_performances= $row["performancename"];
                    $review_event_image = $row["eventimage1"];
                
                echo "<thead>
                    <tr>
                        <th>$review_id</th>
                             <th>$review_title</th>
                                  <th>$review_content</th>
                                       <th>$review_rating</th>
                        <th>$review_event_name</th>
                        <th>$review_event_date</th>
                        <th>$review_event_time</th>
                        <th>$review_event_venue</th>
                        <th>$review_event_location</th>
                        <th>$review_event_performances</th>
                        <th>$review_event_image</th>
                            <td><a href='removereview.php?removereview=$review_id'>Remove Review</a></td>
                                
                    </tr>
                </thead>
                
                   
          
           ";
                }
                ?>
        
    </body>
</html>
