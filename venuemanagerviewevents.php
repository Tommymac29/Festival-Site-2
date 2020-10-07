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
    if ($usertype == '2') {
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
            
            if(!$usertypeid==3){
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

        <h2>CURRENT EVENTS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Ticket Capacity</th>
                        <th>Event Image 1</th>
                        <th>Hosting Venue</th>
                        <th>Venue Location</th>
                        <th>Showcase Performance</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
                $result0 = $conn->query($sql) or die($conn->error);

                while ($rowdata = $result0->fetch_assoc()) {
                    $venuemanagerid = $rowdata['user_id'];
                    $venuemanagername = $rowdata['username'];
                }

                $venuemanagerevents = "SELECT * FROM Users INNER JOIN Venue ON Users.user_id=Venue.manager INNER JOIN Events ON Venue.venue_id=Events.venueid INNER JOIN Performance ON Events.performanceid=Performance.performance_id WHERE Venue.manager='$venuemanagerid'";

                $result = $conn->query($venuemanagerevents);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $event_id = $row["event_id"];
                    $event_name = $row["eventname"];
                    $event_date = $row["date"];
                    $event_time = $row["time"];
                    $event_ticket_capacity = $row["ticketcapacity"];
                    $event_image_1 = $row["eventimage1"];
                    $event_venue = $row["venuename"];
                    $event_location = $row["location"];
                    $event_performance = $row["performancename"];


                    echo "<thead>
                    <tr>
                    <th>$event_id</th>
                        <th>$event_name</th>
                        <th>$event_date</th>
                        <th>$event_time</th>
                        <th>$event_ticket_capacity</th>
                        <th>$event_image_1</th>
                        <th>$event_venue</th>  
                        <th>$event_location</th>
                        <th>$event_performance</th>
                        
                            <td><a href='venuemanagerremoveevent.php?removeevent=$event_id'>Cancel Event</a></td>
                                <td><a href='venuemanagereditevent.php?editeventdetails=$event_id'>Amend Event Details</a></td> 
                                    
                    </tr>
                </thead>
                
                   
          
           ";
                }
                ?>

                </body>
                </html>
