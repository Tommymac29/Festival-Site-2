<?php
include ("connection/connect.php");
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
    <body>
        <body><h2>REGISTERED USERS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Forename</th>
                <th>Surname</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Address</th>
                 <th>Authorisation</th>
            </tr>
            <thead>
            <?php
            $readquery = "SELECT * FROM Users WHERE usertypeid = 2 ";


            $result = $conn->query($readquery);

            while ($row = $result->fetch_assoc()) {
                $registereduserid = $row["user_id"];
                $username = $row["username"];
                $password = $row["password"];
                $firstname = $row["forename"];
                $surname = $row["surname"];
                $dateofbirth = $row["dateofbirth"];
                $email = $row["email"];
                $address = $row["address"];
                $authoristation=$row["authorised"];

                echo "<thead> <tr>
                <td>$registereduserid</td> 
                <td>$username</td> 
                <td>$password</td> 
                <td>$firstname</td>
                <td>$surname</td> 
                <td>$dateofbirth</td> 
                <td>$email</td>
                    <td>$address</td>
                         <td>$authoristation</td>
           <td><a href='adminremoveregistereduser.php?removeregistereduser=$registereduserid'>Remove</a></td> 
               <td><a href='adminvalidate.php?validateregistereduser=$registereduserid'>Validate</a></td> 
                   <td><a href='adminrevoke.php?revokeregistereduser=$registereduserid'>Revoke Privilages</a></td> 
            </tr> 
            </thead>"
                        ;
            }
            ?>
    </body>
</html>
