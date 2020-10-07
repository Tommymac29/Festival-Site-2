<?php
include ("connection/connect.php");
if (isset($_POST["reset-request-submit"])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://tmcavoy01.web.eeecs.qub.ac.uk/Project 2-Festival Site/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);


    $expiration = date("U") + 1800;

    $useremail = $_POST["email"];
    
$sql="DELETE FROM ResetPassword WHERE resetemail=?";

$stmt=  mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    
    echo 'There was an error 1';
    exit();
} else{
    mysqli_stmt_bind_param($stmt, "s", $useremail);
    mysqli_stmt_execute($stmt);
}
echo $sql = "INSERT INTO ResetPassword (resetemail,resetselector,resettoken,resetexpires) VALUES (?,?,?,?);";
$stmt2=  mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt2, $sql)){
    
    echo 'There was an error 2';
    exit();
} else{
    $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt2, "ssss", $useremail,$selector,$hashedtoken,$expiration);
    mysqli_stmt_execute($stmt2);
}

mysqli_stmt_close($stmt2);

mysqli_close($conn);

$emailto= $useremail;

$subject = 'reset your password';

$message = '<p> We received a password reset request link below</p>';

$message .= '<p> here is your password reset link:</br>';

$message .= '<a href="' . $url . '">' . $url .'</a></p>';

$headers ="From: Thomas Mcavoy <mcavoynum1@gmail.com>\r\n";
$headers .= "Reply-To: mcavoynum1@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";

mail($emailto, $subject, $message, $headers);

header("location:reset-password.php");
} else {
    header("Location:home.php");
}
?>
//yes