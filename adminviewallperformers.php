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
    <body><h2>LISTED EVENT REVIEWS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>PerformanceID</th>
                        <th>Performance Name</th>
                        <th>Performance Bio</th>
                        <th>Performance Image</th>
                        <th>Performance Type</th>
                    </tr>
                </thead>
                <?php
                $userreviewdetails = "SELECT * FROM Performance INNER JOIN PerformanceType ON Performance.typeid=PerformanceType.performance_type_id";

                $result = $conn->query($userreviewdetails);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $performance_id = $row["performance_id"];
                    $performance_name = $row["performancename"];
                    $performance_bio = $row["performancebio"];
                    $performance_image = $row["performanceimage1"];
                    $performance_type_name = $row["name"];
                
                echo "<thead>
                    <tr>
                        <th>$performance_id</th>
                        <th> $performance_name </th>
                        <th>$performance_bio </th>
                        <th>$performance_image</th>
                            <th>$performance_type_name</th>
                        
                            <td><a href='admineditperformance.php?editperformance=$performance_id'>Edit Performance</a></td>
                                <td><a href='adminremoveperformance.php?adminremoveperformance=$performance_id'>Remove Performance</a></td>
                                
                    </tr>
                </thead>
                
                   
          
           ";
                }
                ?>

                </body>
                </html>
