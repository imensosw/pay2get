     <!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>download  file</h2>

<div>
 
      Hi,<?php echo $fname; ?>

        You Got a file
      
     <?php

     "You can use password for download ".$password;
     echo "<br>";
      ?>
      
       please click
     

     <?php

      $path="http://dev.imenso.co/nwd-app/users/download?path=".$id;
      ?>

     
    
    <a href="<?php echo $path; ?>">Download Now</a>
</div>

</body>
</html>