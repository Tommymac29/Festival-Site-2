<?php
include("connection/connect.php");
session_start();

$userselect=$_SESSION['username'];

 $userprotect = "SELECT usertypeid FROM Users WHERE UserName = '$userselect'";
$protectsession = $conn->query($userprotect) or die($mydb->error);
while($rowdata = $protectsession->fetch_assoc()){
    $usertype = $rowdata['usertypeid'];

    if ($usertype == '1') {
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
            
            if(!$usertypeid==2){
                header("location:login.php?unauthorised=1");
            }
            if(!$userauthorised==1){
                header("location:login.php?unauthorised=1");
            
              }
            


  if (isset($_POST['update'])) {
                $updateforename = mysqli_real_escape_string($conn,$_POST["forename"]);
                $updatesurname = mysqli_real_escape_string($conn, $_POST["surname"]);
                $updateprofilepicture  =  mysqli_real_escape_string($conn, $_FILES['profilepicture']['name']);
                $post_profile_picture = mysqli_real_escape_string($conn, $_FILES['profilepicture']['tmp_name']);
                $updateaddress = mysqli_real_escape_string($conn, $_POST["address"]);
                $updatedateofbirth = mysqli_real_escape_string($conn, $_POST["dateofbirth"]);
                $updatephonenumber  = mysqli_real_escape_string($conn,$_POST["phonenumber"]);
                $updateemail = mysqli_real_escape_string($conn, $_POST["email"]);
                $targdir = "uploaded/";
                move_uploaded_file($_FILES['profilepicture']['tmp_name'],$targdir.$updateprofilepicture);
                
                echo $updateforename;
                echo $updatesurname;
                echo $updateprofilepicture;
                echo $updateaddress;
                echo $updateemail;
                echo $updatedateofbirth;
                echo $updatephonenumber;
                        
             

                $edituserdetails = "UPDATE `Users` SET `profilepicture`='$updateprofilepicture',`forename`='$updateforename',`surname`='$updatesurname',`dateofbirth`='$updatedateofbirth',`address`='$updateaddress',`phonenumber`='$updatephonenumber',`email`='$updateemail' WHERE `username`='$userselect';";

                
                
                $user_update = mysqli_query($conn, $edituserdetails);
                
                 header("location:useradminpanel.php");
    }
        
    ?>
