<!DOCTYPE html>
<html lang="en">
<head>
  <title>App</title>
  <meta charset="utf-16">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="http://dev.imenso.co/nwd-app/style.css">      
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />     
</head>
<section id="content">
<div class="container-fluid main_content wow fadeInUp" data-wow-duration="2s" >
       
			 
 </div>      
            </div>
        </div>
    </div>  
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
              new WOW().init();
               $('input[id=upload_input]').change(function() {
        console.log($(this).val());
        var mainValue = $(this).val();
        if(mainValue == ""){
            document.getElementById("fake-btn").innerHTML = "Choose File";
        }else{
            document.getElementById("fake-btn").innerHTML = mainValue.replace("C:\\fakepath\\", "");
        }
    });
              </script>
    
