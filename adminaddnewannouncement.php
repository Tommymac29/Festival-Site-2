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
            
            if($usertypeid!==1){
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
        <?php
         $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
           $result = $conn->query($sql) or die($conn->error);
           while($rowdata = $result->fetch_assoc()){
               $adminid = $rowdata['user_id'];
               $adminusername = $rowdata['username'];
           };
       
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">ADD NEW ANNOUNCEMENT</h4>

            <form action="adminprocessannouncement.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="Announcement Title" class="col-sm-2 col-form-label">Announcement Title:</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="title"  placeholder="" value="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Announcement Information">Announcement Information:</label>
                        <input type="text" class="form-control" name="information" placeholder="" value="" required>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for='Time of Announcement'>Time of Announcement:</label>
                        <input type='time' class='form-control' name='time' value= "">
                    </div>
                    <div class="">
                        <input type='hidden' class='form-control' name='creator' value= "<?php echo "$adminid" ?>" >
                    </div>
                </div>
               
                </div>
        

        <button type='submit' name='addannouncement' class='btn btn-primary'>Add New Announcement</button>
        
    </form>
            

</body>
</html>
