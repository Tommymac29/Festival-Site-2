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
        <?php
          if (isset($_GET['adminremovereview'])){
    
    $remove_review_id=$_GET['removereview'];
    
    $remove_review = "DELETE FROM Reviews WHERE review_id='$remove_review_id'";
    
    $run_delete= mysqli_query($conn,$remove_review);
    
       header("location:useradminpanel.php");
}
        ?>
    </body>
</html>
