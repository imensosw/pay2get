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
        <div class="row">
        <div class="layer"></div>
            <div class="col-md-12">
             @if(!empty($data['success']))  
			   <span class="sucess_msg">
			   <?php echo $data['success']; ?>
				 @if(!empty($data['url']))
				  <br>
				     You can Update send file using this link <br>
				   
				      <?php echo $data['url']; ?>
				      @endif
			      </span>  

			     @endif
			    
			     <span class="sucess_msg">
			     @if(!empty($suc))
			         <?php echo $suc; ?>
			       @if($status == 1)

			         <a href="http://dev.imenso.co/nwd-app/users/download?path=<?php echo $path; ?>">Download NOW</a>
					 @endif
					 @if($status == 2)

						      	<form action="{{ url('/users/save') }}" method="POST" enctype="multipart/form-data" class="form_main wow fadeInUp" data-wow-duration="3s">
						{!! csrf_field() !!}

						   <div class="form_input">  

						   	<div class="form-group"><input type="password" required name="pass" placeholder="password"></div>
						   	<input type="hidden" required name="path" value="<?php echo $path; ?>">

					                    <button  class="tranfer_btn" type="submit" >Submit </button>  
                            </div>
									</form>
					 @endif
			      @endif				  
			      @if(empty($suc))
					<p><b>Download Fee : </b><?php echo $userdata['download_fee']; ?></p>
					 <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_xclick">
							
							<input type="submit" name="submit" value="Pay Now" class="btn" alt="PayPal - The safer, easier way to pay online!">
							  <input type="hidden" name="business" value="<?php echo $userdata['paypal_email']; ?>">
							<input type="hidden" name="lc" value="US">
							<input type="hidden" name="item_name" value="Download fee">
							 <input type="hidden" name="rm" value="1">
							<input type="hidden" name="amount" value="<?php echo $userdata['download_fee']; ?>">
							<input type="hidden" name="currency_code" value="USD">
							<input type='hidden' name='cancel_return' value='http://dev.imenso.co/nwd-app/users/download?path=<?php echo $path; ?>'>
							<input type='hidden' name='return' value='http://dev.imenso.co/nwd-app/users/download?path=<?php echo $path; ?>&paid=1'>
							<img alt="" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
					</form>

			 
			      @endif
			       
	     </span>
               
			 
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
    
