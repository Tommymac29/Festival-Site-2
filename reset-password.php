<?php
include("connection/connect.php");

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Reset your password</h1>
        <p>An email will be sent to inform you how to reset your password</p>
        <form action="reset-request.php" method="POST">
              <input type="text" name="email" placeholder="Enter your email address..." required>
            <button type="submit" name="reset-request-submit">Recieve new password by email</button>
        </form>
      
            <?php
        if(isset($_GET["reset"])){
            if($_GET["reset"]=="success"){
                echo '<p class="signupsuccess">check your email!</p>';
           
                }
        }
                ?>
    </body>
</html>
