 <?php
 include ("connection/connect.php");
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
<?php
 
    if (isset($_POST["sendmessage"])) {
        $usermanagerrecieved = mysqli_real_escape_string($conn, $_POST["manager"]);
        $usersentmessage = mysqli_real_escape_string($conn, $_POST["message"]);
        $usersentmessagetime= mysqli_real_escape_string($conn, $_POST["time"]);
        $usersenderid = mysqli_real_escape_string($conn, $_POST["senderid"]);
       
        

        $sendmessage = "INSERT INTO `Messages`(`sender_id`, `recieved_id`, `messagecontent`, `messagetime`) VALUES ('$usersenderid','$usermanagerrecieved','$usersentmessage','$usersentmessagetime')";

        $send_message = $conn->query($sendmessage);
        
      echo $sendmessage;
      
         header("location:useradminpanel.php");
    }
    ?>
