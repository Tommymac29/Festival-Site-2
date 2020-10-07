<?php

include ("connection/connect.php");
if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordrepeat = $_POST["passwordrepeat"];

    if (empty($password) || empty($passwordrepeat)) {
        header("location:reset-password.php");
        exit();
    } else if ($password != $passwordrepeat) {
        header("location:reset-password.php?password does not match");
        exit();
    }
    $currentdate = date("U");

    $sql = "SELECT * FROM ResetPassword WHERE resetselector=? AND resetexpires >=$currentdate ";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo 'There was an error';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            echo"You need to re-submit your reset request";

            exit();
        } else {
            $tokenbin = hex2bin($validator);
            $tokencheck = password_verify($tokenbin, $row["resettoken"]);


            if ($tokencheck == false) {
                echo"You need to re-submit your reset request";
                exit();
            } elseif ($tokencheck == true) {

                $tokenemail = $row['resetemail'];
                $sql = "SELECT * FROM Users WHERE email=?;";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {

                    echo 'There was an error';
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenemail);

                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo"There was an error";

                        exit();
                    } else {
                        $sql = "UPDATE `Users` SET `password`=? WHERE `email`=?;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {

                            echo 'There was an error';
                            exit();
                        } else {
                            $newpasswordhash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newpasswordhash, $tokenemail);

                            mysqli_stmt_execute($stmt);
                        
                            $sql = "DELETE FROM ResetPassword WHERE resetemail=?";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {

                            echo 'There was an error';
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "s", $tokenemail);
                            
//                            header("Location:login.php?password=passwordupdated");

                            mysqli_stmt_execute($stmt);
                            echo $tokenemail;
                            echo $newpasswordhash;
                            echo $password;
                        }
                    }
                    
                        }
                }
            }
        }
    }
} else {
    header("location:home.php");
}
?>
