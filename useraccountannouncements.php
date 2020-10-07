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

        <h2>ADMIN ANNOUNCEMENTS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Announcement ID</th>
                        <th>Announcement Title</th>
                        <th>Announcement Information</th>
                        <th>Announcement Time</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
                $userresult = $conn->query($sql) or die($conn->error);
                while ($rowdata = $result->fetch_assoc()) {
                    $userid = $rowdata['user_id'];
                };
                ?>
                <?php
                $useradminannouncements = "SELECT * FROM Announcements INNER JOIN Users ON Announcements.announcementcreator=Users.user_id WHERE Users.usertypeid=1";

                $result0 = $conn->query($useradminannouncements);

                if (!$result0) {
                    echo $conn->error;
                }

                while ($row = $result0->fetch_assoc()) {
                    $admin_announcement_id = $row["announcement_id"];
                    $admin_announcement_title = $row["announcementtitle"];
                    $admin_announcement_content = $row["announcementcontent"];
                    $admin_announcement_time = $row["annoucementtime"];
                }
                echo "<thead>
                    <tr>
                        <th>$admin_announcement_id</th>
                        <th>$admin_announcement_title</th>
                        <th>$admin_announcement_content</th>
                        <th>$admin_announcement_time</th>     
                    </tr>
                </thead>
                
                   
          
           ";
                ?>
        </div>
                <h2>BOOKED EVENT ANNOUNCEMENTS</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Announcement ID</th>
                                <th>Event Announcement</th>
                                <th>Announcement Title</th>
                                <th>Announcement Information</th>
                                <th>Announcement Time</th>
                            </tr>
                        </thead>
                        <?php
                        $usereventannouncements = "SELECT Announcements.announcement_id,Announcements.announcementtitle,Announcements.announcementcontent,Announcements.annoucementtime, Events.eventname FROM Announcements INNER JOIN Events ON Announcements.announcementevent=Events.event_id INNER JOIN Booking1 ON Events.event_id=Booking1.bookingevent WHERE Booking1.bookinguser='$userid'";

                        $result = $conn->query($usereventannouncements);

                        if (!$result) {
                            echo $conn->error;
                        }

                        while ($row = $result->fetch_assoc()) {
                            $event_announcement_id = $row["announcement_id"];
                            $event_announcement_title = $row["announcementtitle"];
                            $event_announcement = $row["eventname"];
                            $event_announcement_content = $row["announcementcontent"];
                            $event_announcement_time = $row["annoucementtime"];

                            echo "<thead>
                    <tr>
                        <th>$admin_announcement_id</th>
                        <th>$event_announcement</th>
                        <th>$admin_announcement_title</th>
                        <th>$admin_announcement_content</th>
                        <th>$admin_announcement_time</th>     
                    </tr>
                </thead>
                
                   
          
           ";
                        }
                        ?>
                
                        </body>
                        </html>
