<?php

include ("connection/connect.php");
session_start();
if (isset($_SESSION['username'])) {

    $userselect = $_SESSION['username'];
    $userprotect = "SELECT usertypeid FROM Users WHERE UserName = '$userselect'";
    $protectsession = $conn->query($userprotect) or die($mydb->error);
    while ($rowdata = $protectsession->fetch_assoc()) {
        $usertype = $rowdata['usertypeid'];


        if ($usertype == '1') {
            header('location:login.php?unauthorised=2');
        }
        if ($usertype == '3') {
            header('location:login.php?unauthorised=3');
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

    if (!$usertypeid == 2) {
        header("location:login.php?unauthorised=1");
    }
}

if (isset($_POST["signup"])) {
    $insertusername = mysqli_real_escape_string($conn, $_POST["username"]);
    $insertpassword = mysqli_real_escape_string($conn, $_POST["password"]);
    $insertforename = mysqli_real_escape_string($conn, $_POST["forename"]);
    $insertsurname = mysqli_real_escape_string($conn, $_POST["surname"]);
    $insertdateofbirth = mysqli_real_escape_string($conn, $_POST["dateofbirth"]);
    $insertaddress = mysqli_real_escape_string($conn, $_POST["address"]);
    $insertphonenumber = mysqli_real_escape_string($conn, $_POST["phonenumber"]);
    $insertemail = mysqli_real_escape_string($conn, $_POST["email"]);
    $hashedpassword = password_hash($insertpassword, PASSWORD_DEFAULT);

    $currentusernames = "SELECT * FROM Users WHERE username='$insertusername'";
    $currentemails = "SELECT * FROM Users WHERE email='$insertemail'";

    $resultcurrentusernames = $conn->query($currentusernames);
    $resultcurrentemails = $conn->query($currentemails);


    if (mysqli_num_rows($resultcurrentusernames) > 0) {
        $name_error = "Username already in use please try again";
        echo $name_error;
        header("Location:signup.php?usernametaken");
    } 
    
    if (mysqli_num_rows($resultcurrentemails) > 0) {
        $email_error = "Email already in use please try another email or attempt to login to registered account";
        header("Location:signup.php?emailtaken");
    } 

        $insertquery = "INSERT INTO `Users` (`username`,`password`,`forename`,`surname`,`dateofbirth`,`address`,`phonenumber`,`email`)
                VALUES ('$insertusername','$hashedpassword','$insertforename','$insertsurname','$insertdateofbirth','$insertaddress','$insertphonenumber','$insertemail')";

        $insert_user = $conn->query($insertquery);

        echo $insertusername;
        echo $insertpassword;
        echo $insertforename;
        echo $insertsurname;
        echo $insertdateofbirth;
        echo $insertaddress;
        echo $insertphonenumber;
        echo $insertemail;
        header("location:useradminpanel.php");
    }

?>
