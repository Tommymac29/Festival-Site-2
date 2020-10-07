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
                $userresult = $conn->query($sql) or die($conn->error);
                while ($rowdata = $userresult->fetch_assoc()) {
                    $userid = $rowdata['user_id'];
                };
                ?>
        <?php
        if(isset($_GET['userreplyid'])) {
        $user_reply_id=$_GET['userreplyid'];
        $replyuserdetails = "SELECT * FROM `Users` WHERE `user_id` = '$user_reply_id'";
                $result0 = $conn->query($replyuserdetails) or die($conn->error);

                while ($rowdata = $result0->fetch_assoc()) {
                    $userreplyid = $rowdata['user_id'];
                    $userreplyusername = $rowdata['username'];
                }
        }
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">REPLY TO USER</h4>
            <form action="venuemanagerprocessreply.php" enctype="multipart/form-data" method='POST'>
                    <input type="hidden" class="form-control" name="venuemanagersenderid" placeholder="" value="<?php echo "$userid" ?>" required>
                    <input type="hidden" class="form-control" name="recievedbyuserid" placeholder="" value="<?php echo "$userreplyid" ?>" required>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Message Content">Message:</label>
                        <input type="text" class="form-control" name="venuemanagermessage" placeholder="" value="" required>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="Time of Event">Time Sent:</label>
                        <input type="time" class="form-control" name="venuemanagermessagetime" placeholder="" value="" required>
                    </div> 
                </div>
                 

                      
        

        <button type='submit' name='replytouser' class='btn btn-primary'>Reply to user</button>
        
    </form>

</body>
</html>
