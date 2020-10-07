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
        $selector =$_GET["selector"];
         $validator =$_GET["validator"];
         
         if(empty($selector)|| empty($validator)){
             echo "could not validate request";
             
         }else{
             if(ctype_xdigit($selector)!== false && ctype_xdigit($validator)!== false ){
           ?>  
        
        <form action="reset-password-submit.php" method="post">
            <input type="hidden" name="selector" value="<?php echo $selector ?>">
            <input type="hidden" name="validator" value="<?php echo $validator ?>">
            <input type="text" name="password" placeholder="Enter a new password">
            <input type="text" name="passwordrepeat" placeholder="Repeat new password">
         <button type="submit" name="reset-password-submit">Reset password</button>
        
        </form>
        
        <?php
        
        
             }
         }
                ?>
    </body>
</html>

