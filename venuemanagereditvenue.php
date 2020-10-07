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
        if (isset($_GET['editvenuedetails'])) {

            $edit_venue_details = $_GET['editvenuedetails'];

            $editvenue = "SELECT * FROM Venue WHERE venue_id='$edit_venue_details'";

            $result = $conn->query($editvenue);

            if (!$result) {
                echo $conn->error;
            }


            while ($row = $result->fetch_assoc()) {
                $managervenueid = $row["venue_id"];
                $managervenuename = $row["venuename"];
                $managervenuetimes = $row["venuetimes"];
                $managervenuecontents = $row["venuecontents"];
                $managervenuebio = $row["bio"];
                $managervenuelocation = $row["location"];
                $managerseatcapacity = $row["seatcapacity"];
                $managervenueimage = $row["venueimage"];
            }
        }
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">EDIT VENUE DETAILS</h4>


            <form action="venuemanagerprocesseditvenue.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="Venue Name" class="col-sm-2 col-form-label">Venue Name:</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="venuename"  placeholder="" value="<?php echo "$managervenuename" ?>" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden"  class="form-control" name="venueid"  placeholder="" value="<?php echo "$managervenueid" ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Venue Opening Times">Venue Opening Times:</label>
                        <input type="text" class="form-control" name="venuetimes" placeholder="" value="<?php echo "$managervenuetimes" ?>" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for="Venue Features">Venue Features:</label>
                        <input type="text" class="form-control" name="venuecontents" placeholder="" value="<?php echo "$managervenuecontents" ?>" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for="Venue Bio">Bio:</label>
                        <input type="text" class="form-control" name="bio" placeholder="" value="<?php echo "$managervenuebio" ?>" required>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Location">Location:</label>
                        <input type="text" class="form-control" name="location" placeholder="" value="<?php echo "$managervenuelocation" ?>" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for="Seat Capacity">Seat Capacity:</label>
                        <input type="text" class="form-control" name="seatcapacity" placeholder="" value="<?php echo "$managerseatcapacity" ?>" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for='Venue Image'>Venue Image:</label>
                        <input type='file' class='form-control-file' name='venueimage' value= "<?php echo "$managervenueimage" ?>">
                    </div> 
                </div>


                <button type='submit' name='editvenue' class='btn btn-primary'>Amend Venue Details</button>

            </form>

    </body>
</html>
