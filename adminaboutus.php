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
        <?php
         $queryread = "SELECT * FROM About ";

            $result = $conn->query($queryread);

            while ($row = $result->fetch_assoc()) {
                $aboutustitle = $row["abouttitle"];
                $aboutmissionstatement = $row["aboutmissionstatement"];
                $aboutussponsors= $row["aboutsponsors"];
                 $aboutushistory = $row["abouthistory"];
                  $aboutuslocations = $row["aboutlocations"];
                
            }
        
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">ABOUT US INFORMATION</h4>

            <form action="adminupdateaboutus.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="About Us Title" class="col-sm-2 col-form-label">About Us Title:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="aboutustitle"  placeholder="" value="<?php echo "$aboutustitle" ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Mission Statement">Mission Statement:</label>
                        <input type="text" class ="form-control" name="missionstatement" placeholder="" value="<?php echo "$aboutmissionstatement" ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Sponsors">Sponsors:</label>
                        <input type="text" class="form-control" name="sponsors" placeholder="" value="<?php echo "$aboutussponsors" ?>" required>
                    </div>
                    <div class="col-md-4 mb-8">
                        <label for="History">History:</label>
                        <input type="text" class="form-control" name="history" placeholder="" value="<?php echo "$aboutushistory" ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                        <label for="Locations">Locations:</label>
                        <input type="text" class="form-control" name="locations" placeholder="" value="<?php echo "$aboutuslocations" ?>" required>
                    </div>
                     <button type='submit' name='update' class='btn btn-primary'>Update About Us Information</button>
        
    </form>

</body>
</html>
