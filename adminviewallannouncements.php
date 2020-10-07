<?php
include("connection/connect.php");
session_start();
if (isset($_SESSION['username'])) {

          $userselect = $_SESSION['username'];
               $userprotect = "SELECT usertypeid FROM Users WHERE UserName = '$userselect'";
$protectsession = $conn->query($userprotect) or die($mydb->error);
while($rowdata = $protectsession->fetch_assoc()){
    $usertype = $rowdata['usertypeid'];

    if ($usertype == '2') {
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
            
            if(!$usertypeid==1){
                header("location:login.php?unauthorised=1");
            }
            
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">ALL WEBSITE ANNOUNCEMENTS</h4>

           <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>AnnouncementID</th>
                        <th>Title</th>
                        <th>Announcement Information</th>
                        <th>Time of Announcement</th>
                    </tr>
                </thead>
                <?php
             
         $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
           $result0 = $conn->query($sql) or die($conn->error);
           while($rowdata = $result0->fetch_assoc()){
               $adminid = $rowdata['user_id'];
               $adminusername = $rowdata['username'];
           };
           ?>
                <?php
       
                $adminviewannouncements = "SELECT * FROM Announcements WHERE announcementcreator='$adminid' ";

                $result = $conn->query($adminviewannouncements);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $announcement_id = $row["announcement_id"];
                    $announcement_title = $row["announcementtitle"];
                    $announcement_content = $row["announcementcontent"];
                    $announcement_time = $row["annoucementtime"];
                    
                }
                echo "<thead>
                    <tr>
                        <th>$announcement_id</th>
                        <th>$announcement_title</th>
                        <th>$announcement_content</th>
                        <th>$announcement_time</th>
 
                            <td><a href='adminremoveannouncement.php?removeannouncement=$announcement_id'>Remove Announcement</a></td>
                                
                    </tr>
                </thead>
                
                   
          
           ";
                ?>

</body>
</html>
