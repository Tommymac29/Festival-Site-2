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

        <h2>VENUE MANAGER MESSAGES</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>From:</th>
                        <th>Message</th>
                        <th>Time</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
                $result0 = $conn->query($sql) or die($conn->error);

                while ($rowdata = $result0->fetch_assoc()) {
                    $userid = $rowdata['user_id'];
                    $userusername = $rowdata['username'];
                }
                

                $usermessages = "SELECT * FROM Messages INNER JOIN Users ON Messages.sender_id=Users.user_id WHERE Messages.recieved_id='$userid'";

                $result = $conn->query($usermessages);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $sender_id = $row["sender_id"];
                    $sentby = $row["username"];
                    $deliveredmessage = $row["messagecontent"];
                    $deliveredtime = $row["messagetime"];
                    $senderemail = $row["email"];
                    $senderphone = $row["phonenumber"];
                    


                    echo "<thead>
                    <tr>
                        <th>$sentby</th>
                        <th>$deliveredmessage</th>
                        <th>$deliveredtime</th>
                        <th>$senderemail</th>
                        <th>$senderphone</th>
                        
                        
                            <td><a href='userreplytovenuemanager.php?venuemanagerreplyid=$sender_id'>Reply</a></td>
                                
                                    
                    </tr>
                </thead>
                
                   
          
           ";
                }
                ?>

                </body>
                </html>
