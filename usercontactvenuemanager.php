<?php
include("connection/connect.php");
session_start();
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
        <?php
                $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
                $userresult = $conn->query($sql) or die($conn->error);
                while ($rowdata = $result->fetch_assoc()) {
                    $userid = $rowdata['user_id'];
                };
                ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">CONTACT VENUE MANAGER</h4>

            <form action="userprocessmessage.php" enctype="multipart/form-data" method='POST'>
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                      <label for="Venue Manager">Venue Manager:</label>
                    <select class='form-control' name='manager' required>
                        <option selected disabled></option>";

                        <?php
                        $messagemanager = "SELECT * FROM Users INNER JOIN Venue ON Users.user_id=Venue.manager INNER JOIN Events ON Venue.venue_id=Events.venueid INNER JOIN Booking1 ON Events.event_id=Booking1.bookingevent WHERE bookinguser='$userid'";
                        $result0 = $conn->query($messagemanager);
                        if (!$result0) {
                            echo $conn->error;
                        }

                        while ($row = $result0->fetch_assoc()) {
                            $managerchoiceid = $row['user_id'];
                            $managerchoicename = $row['username'];
                            echo "'<option value='$managerchoiceid'>$managerchoicename</option>'";
                        
                        echo"</select></div>";
                        
                        }
                        ?>   
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Message Content">Message:</label>
                        <input type="text" class="form-control" name="message" placeholder="" value="" required>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="Time of Event">Time Sent:</label>
                        <input type="time" class="form-control" name="time" placeholder="" value="" required>
                    </div> 
                   
                    <input type="hidden" class="form-control" name="senderid" placeholder="" value="<?php echo "$userid" ?>" required>
                    
                </div>
                 

                      
        

        <button type='submit' name='sendmessage' class='btn btn-primary'>Send Message</button>
        
    </form>

</body>
</html>
