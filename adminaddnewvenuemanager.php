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
        header('location:login.php?unauthorised=2');
    }
    if ($usertype == '3') {
        header('location:login.php?unauthorised=3');
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
                header("location:login.php?unauthorised=4");
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
            <h4 class="mb-3">CREATE NEW VENUE MANAGER ACCOUNT</h4>

            <form action="adminprocessvenuemanager.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <div class="col-md-6">
                    <label for="username">Username:</label>  
                        <input type="text"  class="form-control" name="username"  placeholder="" value="" required>
                    </div>
                     <div class="col-md-6">
                    <label for="password">Password:</label>  
                        <input type="text" class="form-control" name="password"  placeholder="" value="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Forename">Forename</label>
                        <input type="text" class="form-control" name="forename" placeholder="" value="" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Surname">Surname</label>
                        <input type="text" class="form-control" name="surname" placeholder="" value="" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for='Profile Picture'>Profile Picture:</label>
                        <input type='file' class='form-control-file' name='profilepicture' value= "" id='profilepicturefile'>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address"  placeholder="" value="" required>
                </div>

                <div class="mb-3">
                    <label for="Date of Birth">Date of Birth</label>
                    <input type="date" class="form-control" name="dateofbirth"  placeholder="" value="">
                </div>
        </div>
        <h4 class="mb-3">CONTACT DETAILS</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Phone Number">Phonenumber</label>
                <input type="text" class="form-control" name="phonenumber"  placeholder="" value="">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email"  placeholder="" value="">
            </div>
        </div>
        <button type='submit' name='addvenuemanager' class='btn btn-primary'>CREATE NEW VENUE MANAGER</button>
    </form>

</body>
</html>
