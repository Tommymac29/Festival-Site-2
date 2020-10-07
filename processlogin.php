<?php

session_start();
include ("connection/connect.php");
//if (isset($_POST['login'])) {

$account_username = mysqli_real_escape_string($conn, $_POST['username']);
$account_password = mysqli_real_escape_string($conn, $_POST['password']);


$sql = "SELECT * FROM Users WHERE username= '$account_username'";
$result = $conn->query($sql) or die($conn->error);
while ($row = $result->fetch_assoc()) {
    $passwordhash = $row['password'];
}
echo"$passwordhash";
$verification = password_verify($account_password, $passwordhash);
echo $verification;
if (!$verification == 1) {
    echo"unauthorised user please create an account via the sign up page";
} else {
    $userselect = "SELECT * FROM Users WHERE username='$account_username' ";

    $run_user = mysqli_query($conn, $userselect);

    if (mysqli_num_rows($run_user) > 0) {
        $_SESSION['username'] = $account_username;
        $userlocation = "SELECT `usertypeid` FROM `Users` WHERE `username`='$account_username'";
        $result = $conn->query($userlocation) or die($conn->error);
        while ($row = $result->fetch_assoc()) {
            $typeid = $row['usertypeid'];

            echo"$typeid";

            if ($typeid == '1') {
                header("Location: adminpanel.php?login=adminhome");
                echo "Welcome $account_username";
                echo 'admin';
            } elseif ($typeid == '2') {
                echo 'public';
                header("Location: useradminpanel.php?login Success");
                echo "Welcome $account_username";
            } elseif ($typeid == '3') {
                echo 'venue';
                header("Location: venuemanagerpanel.php");
                echo "Welcome $account_username";
            }
        }
    } else {
        echo "<script>alert ('User name or password is incorrect')</script>";
}}

//}
?>