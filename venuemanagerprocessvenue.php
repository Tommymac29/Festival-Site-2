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

if (isset($_POST["addvenue"])) {
    $addvenuemanager = mysqli_real_escape_string($conn, $_POST["venuemanager"]);
    $addvenuename = mysqli_real_escape_string($conn, $_POST["venuename"]);
    $addvenuetimes = mysqli_real_escape_string($conn, $_POST["venuetimes"]);
    $addvenuecontents = mysqli_real_escape_string($conn, $_POST["venuecontents"]);
    $addvenuebio = mysqli_real_escape_string($conn, $_POST["bio"]);
    $addvenuelocation = mysqli_real_escape_string($conn, $_POST["location"]);
    $addvenueseatcapacity = mysqli_real_escape_string($conn, $_POST["seatcapacity"]);
    $addvenueimage = mysqli_real_escape_string($conn, $_FILES['venueimage']['name']);
    $post_venue_image = mysqli_real_escape_string($conn, $_FILES['venueimage']['tmp_name']);
    
     $randomNum = rand(0, 9999999999);
        $imageName = str_replace(' ','-',strtolower($_FILES["venueimage"]["name"]));
        $ImageType = $_FILES['venueimage']['type'];
        $ImageExt = substr($imageName, strrpos($imageName, '.'));
        $ImageExt = str_replace('.','',$ImageExt);
        $imageName = preg_replace("/.[^.\s]{3,4}$/", "", $imageName);
        $newImageName = $imageName.'-'.$randomNum.'.'.$ImageExt;
     $addvenueimage=$newImageName;
    $targdir = "uploaded/";
    move_uploaded_file($_FILES['venueimage']['tmp_name'], $targdir . $addvenueimage);

    $addnewvenue = "INSERT INTO `Venue`( `venuename`, `venuetimes`, `venuecontents`, `bio`, `location`, `seatcapacity`, `venueimage`, `manager`) VALUES ('$addvenuename','$addvenuetimes','$addvenuecontents','$addvenuebio','$addvenuelocation','$addvenueseatcapacity','$addvenueimage','$addvenuemanager')";
    $insert_venue = $conn->query($addnewvenue);

    echo $addvenuename;
    echo $addvenuetimes;
    echo $addvenuecontents;
    echo $addvenuebio;
    echo $addvenuelocation;
    echo $addvenueseatcapacity;
    echo $addvenueimage;
    echo $addvenuemanager;
    
      header("location:venuemanagerpanel.php");
    
   
}
?>
