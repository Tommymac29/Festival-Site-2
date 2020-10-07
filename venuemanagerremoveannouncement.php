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
        if (isset($_GET['venuemanagerremoveannouncement'])){
    
    $venue_manager_remove_announcement_id=$_GET['venuemanagerremoveannouncement'];
    
    $venue_manager_remove_announcement = "DELETE FROM Announcements WHERE announcement_id='$venue_manager_remove_announcement_id'";
    
    $run_delete= mysqli_query($conn,$venue_manager_remove_announcement);
    
      header("location:venuemanagerpanel.php");
    
}
?>
       
    </body>
</html>
