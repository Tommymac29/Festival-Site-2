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

        <h2>ALL LISTED VENUES</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>VenueID</th>
                        <th>Venue Name</th>
                        <th>Venue Opening Time</th>
                        <th>Venue Content</th>
                        <th>Bio</th>
                        <th>Location</th>
                        <th>Seat Capacity</th>
                        <th>Venue Image</th>

                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
                $result0 = $conn->query($sql) or die($conn->error);
                
                while ($rowdata = $result0->fetch_assoc()) {
                    $venuemanagerid = $rowdata['user_id'];
                    $venuemanagername = $rowdata['username'];
                }


                $venuemanagervenues = "SELECT * FROM Users INNER JOIN Venue ON Users.user_id=Venue.manager WHERE Venue.manager='$venuemanagerid'";

                $result=$conn->query($venuemanagervenues);

                if (!$result) {
                    echo $conn->error;
                }
                

                while ($row = $result->fetch_assoc()) {
                    $managervenueid = $row["venue_id"];
                    $managervenuename = $row["venuename"];
                    $managervenuetimes = $row["venuetimes"];
                    $managervenuecontents = $row["venuecontents"];
                    $managervenuebio = $row["bio"];
                    $managervenuelocation = $row["location"];
                    $managerseatcapacity = $row["seatcapacity"];
                    $managervenueimage = $row["venueimage"];
                
                echo "<thead>
                    <tr>
                        <th>$managervenueid</th>
                        <th>$managervenuename</th>
                            <th>$managervenuetimes</th>
                                <th>$managervenuecontents</th>
                                    <th>$managervenuebio</th>
                                        <th>$managervenuelocation</th>
                                        <th>$managerseatcapacity</th>
                                            <th>$managervenueimage</th>
                                                
                            <td><a href='venuemanagerremovevenue.php?removevenue=$managervenueid'>Remove Venue</a></td>
                                <td><a href='venuemanagereditvenue.php?editvenuedetails=$managervenueid'>Amend Venue Details</a></td> 
                                    
                    </tr>
                </thead>
                
                   
          
                ";
                
                }
                ?>
                </body>
                </html>
