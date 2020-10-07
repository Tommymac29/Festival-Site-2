 <?php
 include ("connection/connect.php");
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
 
    if (isset($_POST["replytouser"])) {
        $managersenderid = mysqli_real_escape_string($conn, $_POST["venuemanagersenderid"]);
        $managersentmessage = mysqli_real_escape_string($conn, $_POST["venuemanagermessage"]);
        $managersentmessagetime= mysqli_real_escape_string($conn, $_POST["venuemanagermessagetime"]);
        $userrecievedid = mysqli_real_escape_string($conn, $_POST["recievedbyuserid"]);
       
        

        $managerreplymessage = "INSERT INTO `Messages`(`sender_id`, `recieved_id`, `messagecontent`, `messagetime`) VALUES ('$managersenderid','$userrecievedid','$managersentmessage','$managersentmessagetime')";

        $manager_reply_message = $conn->query($managerreplymessage);
        
      echo $managerreplymessage;
      
        header("location:venuemanagerpanel.php");
    }
    ?>
