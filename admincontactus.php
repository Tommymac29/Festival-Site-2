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
         $queryread = "SELECT * FROM ContactUs ";

            $result = $conn->query($queryread);

            while ($row = $result->fetch_assoc()) {
                $contactusmessage = $row["contactusmessage"];
                $websiteemail = $row["websiteemail"];
                $websitephone = $row["websitephone"];
                
            }
        
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">CONTACT US INFORMATION</h4>

            <form action="adminupdatecontactus.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="Contact Us Message" class="col-sm-2 col-form-label">Contact Us Message:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="contactusmessage"  placeholder="" value="<?php echo "$contactusmessage" ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Email">Email:</label>
                        <input type="text" class ="form-control" name="websiteemail" placeholder="" value="<?php echo "$websiteemail" ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="Telephone">Telephone:</label>
                        <input type="text" class="form-control" name="websitephone" placeholder="" value="<?php echo "$websitephone" ?>" required>
                    </div>
                </div>
                     <button type='submit' name='update' class='btn btn-primary'>Update Contact Us Information</button>
        
    </form>

</body>
</html>
