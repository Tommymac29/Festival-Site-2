<?php

include("connection/connect.php");
session_start();
$userselect = $_SESSION['username'];
$userprotect = "SELECT usertypeid FROM Users WHERE UserName = '$userselect'";
$protectsession = $conn->query($userprotect) or die($mydb->error);
while ($rowdata = $protectsession->fetch_assoc()) {
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
    $userauthorised = $row["authorised"];
    $usertypeid = $row["usertypeid"];
}

if (!$usertypeid == 3) {
    header("location:login.php?unauthorised=1");
}



if (isset($_POST['editevent'])) {
    $updateeventid = mysqli_real_escape_string($conn, $_POST["eventid"]);
    $updateeventname = mysqli_real_escape_string($conn, $_POST["eventname"]);
    $updateeventdate = mysqli_real_escape_string($conn, $_POST["date"]);
    $updateeventtime = mysqli_real_escape_string($conn, $_POST["time"]);
    $updateeventticketcapacity = mysqli_real_escape_string($conn, $_POST["ticketcapacity"]);
    $updateeventimage1 = mysqli_real_escape_string($conn, $_FILES['eventimage1']['name']);
    $post_event_picture_1 = mysqli_real_escape_string($conn, $_FILES['eventimage1']['tmp_name']);
    $updateeventvenue = mysqli_real_escape_string($conn, $_POST["venuename"]);
    $updateeventperformance = mysqli_real_escape_string($conn, $_POST["performance"]);
    $targdir = "uploaded/";

    $randomNum = rand(0, 9999999999);
    $imageName = str_replace(' ', '-', strtolower($_FILES["eventimage1"]["name"]));
    $ImageType = $_FILES['eventimage1']['type'];
    $ImageExt = substr($imageName, strrpos($imageName, '.'));
    $ImageExt = str_replace('.', '', $ImageExt);
    $imageName = preg_replace("/.[^.\s]{3,4}$/", "", $imageName);
    $newImageName = $imageName . '-' . $randomNum . '.' . $ImageExt;
    
    $updateeventimage1 = $newImageName;
    
    move_uploaded_file($_FILES['eventimage1']['tmp_name'], $targdir . $updateeventimage1);

    $editeventdetails = "UPDATE `Events` SET `eventname`='$updateeventname',`date`='$updateeventdate',`time`='$updateeventtime',`ticketcapacity`='$updateeventticketcapacity',`eventimage1`='$updateeventimage1',`venueid`='$updateeventvenue',`performanceid`='$updateeventperformance' WHERE event_id='$updateeventid'";

    $event_update = mysqli_query($conn, $editeventdetails);

    echo $editeventdetails;

    header("location:venuemanagerpanel.php");
}
?>
