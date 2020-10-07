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
 
    if (isset($_POST["venuemanageraddannouncement"])) {
        $insertannouncementtitle = mysqli_real_escape_string($conn, $_POST["title"]);
        $insertannouncementevent = mysqli_real_escape_string($conn, $_POST["announcementevent"]);
        $insertannouncementinformation= mysqli_real_escape_string($conn, $_POST["information"]);
        $insertannouncementtime = mysqli_real_escape_string($conn, $_POST["time"]);
        $insertannouncementcreator = mysqli_real_escape_string($conn, $_POST["creator"]);
        

        $insertquery = "INSERT INTO `Announcements`(`announcementtitle`, `announcementcontent`, `annoucementtime`, `announcementcreator` , `announcementevent`) VALUES ('$insertannouncementtitle','$insertannouncementinformation','$insertannouncementtime','$insertannouncementcreator','$insertannouncementevent')";

        $insert_announcement = $conn->query($insertquery);
        
      echo $insertquery;
         header("location:venuemanagerpanel.php");
    }
    ?>
