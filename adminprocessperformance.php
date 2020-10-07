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

if (isset($_POST["addperformance"])) {

    $addperformancename = mysqli_real_escape_string($conn, $_POST["performancename"]);
    $addperformancebio = mysqli_real_escape_string($conn, $_POST["performancebio"]);
    $addperformanceimage1 = mysqli_real_escape_string($conn, $_FILES['performanceimage1']['name']);
    $post_performance_image_1 = mysqli_real_escape_string($conn, $_FILES['performanceimage1']['tmp_name']);
    $targdir = "uploaded/";
    
      $randomNum = rand(0, 9999999999);
        $imageName = str_replace(' ','-',strtolower($_FILES["performanceimage1"]["name"]));
        $ImageType = $_FILES['performanceimage1']['type'];
        $ImageExt = substr($imageName, strrpos($imageName, '.'));
        $ImageExt = str_replace('.','',$ImageExt);
        $imageName = preg_replace("/.[^.\s]{3,4}$/", "", $imageName);
        $newImageName = $imageName.'-'.$randomNum.'.'.$ImageExt;
    
    
    $addperformanceimage1=$newImageName;
    
    move_uploaded_file($_FILES['performanceimage1']['tmp_name'], $targdir . $addperformanceimage1);
    $addperformanetype = mysqli_real_escape_string($conn, $_POST["performancetype"]);
    $addnewperformance = "INSERT INTO `Performance`(`performancename`, `performancebio`, `performanceimage1`, `typeid`) VALUES ('$addperformancename','$addperformancebio','$addperformanceimage1','$addperformanetype')";
    $insert_performance = $conn->query($addnewperformance);

    echo $addperformancename;
    echo $addperformancebio;
    echo $addperformanceimage1;
    echo $addperformanetype;
     
    header("location:adminpanel.php");
}
?>
