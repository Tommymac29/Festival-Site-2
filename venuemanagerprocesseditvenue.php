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



if (isset($_POST['editvenue'])) {
    $updatevenueid = mysqli_real_escape_string($conn, $_POST["venueid"]);
    $updatevenuename = mysqli_real_escape_string($conn, $_POST["venuename"]);
    $updatvenueopeningtimes = mysqli_real_escape_string($conn, $_POST["venuetimes"]);
    $updatvenuefeatures = mysqli_real_escape_string($conn, $_POST["venuecontents"]);
    $updatvenuebio = mysqli_real_escape_string($conn, $_POST["bio"]);
    $updatvenuelocation = mysqli_real_escape_string($conn, $_POST["location"]);
    $updatvenueseatcapacity = mysqli_real_escape_string($conn, $_POST["seatcapacity"]);
    $updatevenuepicture = mysqli_real_escape_string($conn, $_FILES['venueimage']['name']);
    $post_venue_picture = mysqli_real_escape_string($conn, $_FILES['venueimage']['tmp_name']);
    
     $randomNum = rand(0, 9999999999);
        $imageName = str_replace(' ','-',strtolower($_FILES["venueimage"]["name"]));
        $ImageType = $_FILES['venueimage']['type'];
        $ImageExt = substr($imageName, strrpos($imageName, '.'));
        $ImageExt = str_replace('.','',$ImageExt);
        $imageName = preg_replace("/.[^.\s]{3,4}$/", "", $imageName);
        $newImageName = $imageName.'-'.$randomNum.'.'.$ImageExt;
         $updatevenuepicture=$newImageName;
    $targdir = "uploaded/";
    move_uploaded_file($_FILES['venueimage']['tmp_name'], $targdir . $updatevenuepicture);





    $editvenuedetails = "UPDATE `Venue` SET `venuename`='$updatevenuename',`venuetimes`='$updatvenueopeningtimes',`venuecontents`='$updatvenuefeatures',`bio`='$updatvenuebio',`location`='$updatvenuelocation',`seatcapacity`='$updatvenueseatcapacity',`venueimage`='$updatevenuepicture' WHERE venue_id='$updatevenueid'";

    $venue_update = mysqli_query($conn, $editvenuedetails);

    echo $editvenuedetails;
    
      header("location:venuemanagerpanel.php");
}
?>
