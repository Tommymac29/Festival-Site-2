<?php

include ("connection/connect.php");
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

if (isset($_POST["addevent"])) {

    $addeventname = mysqli_real_escape_string($conn, $_POST["eventname"]);
    $addeventdate = mysqli_real_escape_string($conn, $_POST["date"]);
    $addeventtime = mysqli_real_escape_string($conn, $_POST["time"]);
    $addeventticketcapacity = mysqli_real_escape_string($conn, $_POST["ticketcapacity"]);
    $addeventimage1 = mysqli_real_escape_string($conn, $_FILES['eventimage1']['name']);
    $post_event_image_1 = mysqli_real_escape_string($conn, $_FILES['eventimage1']['tmp_name']);
    
    
    
     $randomNum = rand(0, 9999999999);
        $imageName = str_replace(' ','-',strtolower($_FILES["eventimage1"]["name"]));
        $ImageType = $_FILES['eventimage1']['type'];
        $ImageExt = substr($imageName, strrpos($imageName, '.'));
        $ImageExt = str_replace('.','',$ImageExt);
        $imageName = preg_replace("/.[^.\s]{3,4}$/", "", $imageName);
        $newImageName = $imageName.'-'.$randomNum.'.'.$ImageExt;
         $addeventimage1=$newImageName;
        
    $targdir = "uploaded/";
    
    
    move_uploaded_file($_FILES['eventimage1']['tmp_name'], $targdir . $addeventimage1);
    $addvenuechoice = mysqli_real_escape_string($conn, $_POST["venuename"]);
    $addperformance = mysqli_real_escape_string($conn, $_POST["performance"]);

    $addnewevent = "INSERT INTO `Events`( `eventname`, `date`, `time`, `ticketcapacity`, `eventimage1`, `venueid`, `performanceid`) VALUES ('$addeventname','$addeventdate','$addeventtime','$addeventticketcapacity','$newImageName','$addvenuechoice','$addperformance')";
    $insert_event = $conn->query($addnewevent);

   echo $addnewevent;
    
  header("location:venuemanagerpanel.php");
}
?>
