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
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">ADD NEW PERFORMANCE</h4>

            <form action="adminprocessperformance.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="Performance Name" class="col-sm-2 col-form-label">Performance Name:</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="performancename"  placeholder="" value="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Performance Bio">Bio:</label>
                        <input type="text" class="form-control" name="performancebio" placeholder="" value="" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for='Performance Image'>Performance Image:</label>
                        <input type='file' class='form-control-file' name='performanceimage1' value= "" id='performanceimage1file'>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="Performance Type">Performance Type:</label>
                    <select class='form-control' name='performancetype' required>
                        ";

                        <?php
                        $performancetypeoptions = 'SELECT * FROM PerformanceType';
                        $result = $conn->query($performancetypeoptions);
                        if (!$result) {
                            echo $conn->error;
                        }

                        while ($row = $result->fetch_assoc()) {
                            $performancetypeid = $row['performance_type_id'];
                            $performancetype = $row['name'];
                            echo "'<option value='$performancetypeid'>$performancetype</option>'";
                        };
                        echo"</select></div>"
                        ?>
                </div>
        

        <button type='submit' name='addperformance' class='btn btn-primary'>Add new Performer</button>
        
    </form>

</body>
</html>
