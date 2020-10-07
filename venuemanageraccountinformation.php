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
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">ACCOUNT INFORMATION</h4>

            <form action="updateaccinfo.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username:</label>
                    <div class="col-sm-10">
                        <input type="text"  readonly class="form-control" name="username"  placeholder="" value="<?php echo "$userselect" ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Forename">Forename</label>
                        <input type="text" class="form-control" name="forename" placeholder="" value="<?php echo "$userforename" ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Surname">Surname</label>
                        <input type="text" class="form-control" name="surname" placeholder="" value="<?php echo "$usersurname" ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for='Profile Picture'>Profile Picture:</label>
                        <input type='file' class='form-control-file' name='profilepicture' value= "<?php echo $userprofilepicture ?>" id='profilepicturefile'>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address"  placeholder="" value="<?php echo "$useraddress" ?>" required>
                </div>

                <div class="mb-3">
                    <label for="Date of Birth">Date of Birth</label>
                    <input type="text" class="form-control" name="dateofbirth"  placeholder="" value="<?php echo "$userdateofbirth" ?>">
                </div>
        </div>
        <h4 class="mb-3">CONTACT DETAILS</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Phone Number">Phonenumber</label>
                <input type="text" class="form-control" name="phonenumber"  placeholder="" value="<?php echo "$userphonenumber" ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email"  placeholder="" value="<?php echo "$useremail" ?>">
            </div>
        </div>
        <button type='submit' name='update' class='btn btn-primary'>Update Account Information</button>
    </form>

</body>
</html>
