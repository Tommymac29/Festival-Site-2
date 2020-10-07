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


  if (isset($_POST['update'])) {
                $updatewebsitecontactusmessage = mysqli_real_escape_string($conn,$_POST["contactusmessage"]);
                $updatewebsiteemail = mysqli_real_escape_string($conn, $_POST["websiteemail"]);
                $updatewebsitephone = mysqli_real_escape_string($conn, $_POST["websitephone"]);
                
               
                
                        
             

                $editcontactusdetails = "UPDATE `ContactUs` SET `contactusmessage`='$updatewebsitecontactusmessage',`websiteemail`='$updatewebsiteemail',`websitephone`='$updatewebsitephone' WHERE id=1";

                
                
                $contact_us_update = mysqli_query($conn, $editcontactusdetails);
                
                echo $editcontactusdetails;
                
                 header("location:adminpanel.php");
    }
        
    ?>
