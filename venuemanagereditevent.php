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
        if (isset($_GET['editeventdetails'])) {

            $edit_event_details = $_GET['editeventdetails'];

            $editevent = "SELECT * FROM Events WHERE event_id='$edit_event_details'";

            $result = $conn->query($editevent);

            if (!$result) {
                echo $conn->error;
            }


            while ($row = $result->fetch_assoc()) {
                $managereventid = $row["event_id"];
                $managereventname = $row["eventname"];
                $managereventdate = $row["date"];
                $managereventtime= $row["time"];
                $managereventticketcapacity = $row["ticketcapacity"];
                $managereventimage1 = $row["eventimage1"];
                $managereventvenue = $row["venueid"];
                $managereventperformance = $row["performanceid"];
            }
        }
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">EDIT EVENT DETAILS</h4>


            <form action="venuemanagerprocesseditevent.php" enctype="multipart/form-data" method='POST'>

                <div class="form-group row">
                    <label for="Event Name" class="col-sm-2 col-form-label">Event Name:</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="eventname"  placeholder="" value="<?php echo "$managereventname" ?>" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden"  class="form-control" name="eventid"  placeholder="" value="<?php echo "$managereventid" ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Date of Event">Date of Event:</label>
                        <input type="text" class="form-control" name="date" placeholder="" value="<?php echo "$managereventdate" ?>" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for="Time of Event">Time of Event:</label>
                        <input type="text" class="form-control" name="time" placeholder="" value="<?php echo "$managereventtime" ?>" required>
                    </div> 
                    <div class="col-md-4 mb-3">
                        <label for="Ticket Capacity">Ticket Capacity:</label>
                        <input type="text" class="form-control" name="ticketcapacity" placeholder="" value="<?php echo "$managereventticketcapacity" ?>" required>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                       <label for='Event Image'>Event Image:</label>
                        <input type='file' class='form-control-file' name='eventimage1' value= "<?php echo "$managereventimage1" ?>">
                    </div>   
                </div>
                   <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="Venue">Venue:</label>
                    <select class='form-control' name='venuename' value= "<?php echo "$managereventvenue" ?>"  required>
                        

                        <?php
                        $venueoptions = 'SELECT * FROM Venue';
                        $result1 = $conn->query($venueoptions);
                        if (!$result1) {
                            echo $conn->error;
                        }

                        while ($row = $result1->fetch_assoc()) {
                            $venuechoiceid = $row['venue_id'];
                            $venuechoicename = $row['venuename'];
                            echo "'<option value='$venuechoiceid'>$venuechoicename</option>'";
                        };
                        echo"</select></div>"
                        ?>   
                    <div class="col-md-6 mb-3">
                       <label for="Performance">Performance:</label>
                    <select class='form-control' name='performance' value= "<?php echo "$managereventperformance" ?>" required>
                       

                        <?php
                        $performanceoptions = 'SELECT * FROM Performance';
                        $result = $conn->query($performanceoptions);
                        if (!$result) {
                            echo $conn->error;
                        }

                        while ($row = $result->fetch_assoc()) {
                            $performanceid = $row['performance_id'];
                            $performancename = $row['performancename'];
                            echo "'<option value='$performanceid'>$performancename</option>'";
                        };
                        echo"</select></div>"
                        ?>
                </div>
                 

                      
        

        <button type='submit' name='editevent' class='btn btn-primary'>Update Event Information</button>
        
    </form>

    </body>
</html>
