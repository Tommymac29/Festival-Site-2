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
        <?php
         $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
           $result0 = $conn->query($sql) or die($conn->error);
           while($rowdata = $result0->fetch_assoc()){
               $venuemanagerid = $rowdata['user_id'];
               $venuemanagerusername = $rowdata['username'];
           };
       
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">ADD NEW ANNOUNCEMENT</h4>

            <form action="venuemanagerprocessannouncement.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="Announcement Title" class="col-sm-2 col-form-label">Announcement Title:</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="title"  placeholder="" value="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for='Event'>Event:</label>
                        <select class='form-control' name='announcementevent' required>
                        <option selected disabled></option>";

                        <?php
                        $eventchoiceoptions = "SELECT * FROM Events INNER JOIN Venue ON Events.venueid=Venue.venue_id INNER JOIN Users ON Venue.manager=Users.user_id WHERE Venue.manager='$venuemanagerid'";
                        $result = $conn->query($eventchoiceoptions);
                        if (!$result) {
                            echo $conn->error;
                        }

                        while ($row = $result->fetch_assoc()) {
                            $eventchoiceid = $row['event_id'];
                            $eventchoicename = $row['eventname'];
                            echo "'<option value='$eventchoiceid'>$eventchoicename</option>'";
                        };
                        echo"</select></div>"
                        ?>
                    
                    <div class="col-md-4 mb-3">
                        <label for="Announcement Information">Announcement Information:</label>
                        <input type="text" class="form-control" name="information" placeholder="" value="" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for='Time of Announcement'>Time of Announcement:</label>
                        <input type='time' class='form-control' name='time' value= "">
                    </div>
                    <div class="">
                        <input type='hidden' class='form-control' name='creator' value= "<?php echo "$venuemanagerid" ?>" >
                    </div>
                </div>
               
                </div>
        

        <button type='submit' name='venuemanageraddannouncement' class='btn btn-primary'>Add New Announcement</button>
        
    </form>
            

</body>
</html>
