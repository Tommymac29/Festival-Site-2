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
        if (isset($_GET['editperformance'])) {

            $edit_performance_details = $_GET['editperformance'];

            $editperformance = "SELECT * FROM Performance WHERE performance_id='$edit_performance_details'";

            $result = $conn->query($editperformance);

            if (!$result) {
                echo $conn->error;
            }


            while ($row = $result->fetch_assoc()) {
                $performanceid = $row["performance_id"];
                $performancename = $row["performancename"];
                $performancebio = $row["performancebio"];
                $performanceimage1= $row["performanceimage1"];
                $performancetypeid = $row["typeid"];
                
            }
        }
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">EDIT PERFORMANCE DETAILS</h4>


            <form action="adminprocesseditperformance.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="Performance Name" class="col-sm-2 col-form-label">Performance Name:</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="performancename"  placeholder="" value="<?php echo "$performancename" ?>" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden"  class="form-control" name="performanceid"  placeholder="" value="<?php echo "$performanceid" ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Performance Bio">Performance Bio:</label>
                        <input type="text" class="form-control" name="performancebio" placeholder="" value="<?php echo "$performancebio" ?>" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for="Time of Event">Performance Image:</label>
                        <input type="file" class="form-control" name="performanceimage1" placeholder="" value="<?php echo "$performanceimage1" ?>">
                    </div> 
                   <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="Performance Type">Performance Type:</label>
                    <select class='form-control' name='performancetype' value= "<?php echo "$performancetypeid" ?>"  required>
                        ";

                        <?php
                        $performancetypeoptions = 'SELECT * FROM PerformanceType';
                        $result1 = $conn->query($performancetypeoptions);
                        if (!$result1) {
                            echo $conn->error;
                        }

                        while ($row = $result1->fetch_assoc()) {
                            $performancetypeid = $row['performance_type_id'];
                            $performancetypename = $row['name'];
                            echo "'<option value='$performancetypeid'>$performancetypename</option>'";
                        };
                        echo"</select></div>"
                        ?>   
                    
                </div>
                 

                      
        

        <button type='submit' name='updateperformance' class='btn btn-primary'>Update Performance Information</button>
        
    </form>

    </body>
</html>
