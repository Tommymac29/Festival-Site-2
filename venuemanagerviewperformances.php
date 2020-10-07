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
            <h4 class="mb-3">ALL VENUE PERFORMANCES</h4>

           <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Performance ID</th>
                        <th>Performance Name</th>
                        <th>Performance Type</th>
                        <th>Venue</th>
                        <th>Event</th>
                        <th>Time</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <?php
             
         $sql = "SELECT * FROM `Users` WHERE `username` = '$userselect'";
           $result0 = $conn->query($sql) or die($conn->error);
           while($rowdata = $result0->fetch_assoc()){
               $venuemanagerid = $rowdata['user_id'];
               $venuemanagerusername = $rowdata['username'];
           };
           ?>
                <?php
       
                $venuemanagerviewperformances = "SELECT * FROM Events INNER JOIN Venue ON Events.venueid=Venue.venue_id INNER JOIN Performance ON Events.performanceid=Performance.performance_id INNER JOIN PerformanceType ON Performance.typeid=PerformanceType.performance_type_id WHERE Venue.manager='$venuemanagerid' ";

                $result = $conn->query($venuemanagerviewperformances);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $performance_id = $row["performance_id"];
                    $performance_name = $row["performancename"];
                    $performance_type = $row["name"];
                    $performance_venue= $row["venuename"];
                    $performance_event = $row["eventname"];
                    $performance_time = $row["time"];
                    $performance_date = $row["date"];
                    
                
                echo "<thead>
                    <tr>
                        <th>$performance_id</th>
                        <th>$performance_name</th>
                        <th>$performance_type</th>
                        <th>$performance_venue</th>
                            <th>$performance_event</th>
                                <th>$performance_time</th>
                                    <th>$performance_date</th>
 
                            
                                
                    </tr>
                </thead>
                
                   
          
           ";
                }
                ?>

</body>
</html>
