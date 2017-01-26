     <!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>download  file</h2>

<div>
 
      Hi

       <?php

     "You can use password for download ".$password;
     echo "<br>";
      ?>
      

     You Send a file to <?php echo $fname; ?>
      
     
      
       please click here to update the file
    
     <?php
      $path="http://dev.imenso.co/nwd-app/users/create?id=".$id;
      ?>



    
    <a href="<?php echo $path; ?>">Update Now</a>
</div>

</body>
</html>