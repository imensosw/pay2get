<!DOCTYPE html>
<html lang="en">
<head>
  <title>App</title>
  <meta charset="utf-16">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="{{ url('style.css') }}">      
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" /> 
  
</head>
<section id="content">
<div class="container-fluid main_content "  >
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

             <span class="sucess_msg hidden"> </span>  
	           <div class="site_logo"><img src="images/logo.svg" alt="site-logo"></div> 
                     
                <div class="form_wrp ">
                
			 
			<form action="{{ url('/users/save') }}" method="POST" enctype="multipart/form-data" class="form_main wow fadeInUp" data-wow-duration="3s">
			{!! csrf_field() !!}
			
			 <div class="uplod_input">
			  
                            <label for="upload_input">
                                <span class="upload_pls">+</span>
                                <aside>add your file</aside>
                                <p> Add up to 2 GB</p>
                            </label>
                            <input id="upload_input" name="name"  @if(empty($id)) required  @endif  type="file" value="add your files">
                            <div id="fake-btn" class="choos_file">
                             
                              @if(!empty($imgname)) 
                              
                                <?php echo $imgname; ?>
                             
                               @endif
                            </div>
                        </div>  
                          <div class="form_input">  
                              
                             @if(empty($id)) 
                              <div class="form-group"><input type="text" required name="fname" placeholder="First name"></div>
                              <div class="form-group"><input type="text" required  name="lname" placeholder="Last name"></div> 
                              <div class="form-group"><input type="text" required  name="email" placeholder="Email to"></div>
                              <div class="form-group"><input type="text" required  id="send_by" name="send_by" placeholder="your email"></div>
                              @endif
                         
                            <div class="form-group"><textarea name="message" required  id="message"  rows="1" placeholder="Message">@if(!empty($message)) <?php echo $message; ?> @endif</textarea></div>
                           <div class="form-group ">
                              <span class="select_bar">                   
                                <select id="expiry_days" name="expiry_days" class="" required>
                                <option disabled selected value>Delete After</option>
                                  <option value="1" @if(!empty($expiry_days) && $expiry_days==1) selected  @endif>1 Week</option>
                                  <option value="2" @if(!empty($expiry_days) && $expiry_days==2) selected  @endif>2 Week</option>
                                  <option value="3" @if(!empty($expiry_days) && $expiry_days==3) selected  @endif>3 Week</option>
                                  <option value="4" @if(!empty($expiry_days) && $expiry_days==4) selected  @endif>4 Week</option>
                                  <option value="5" @if(!empty($expiry_days) && $expiry_days==5) selected  @endif>5 Week</option>
                                </select>
                              </span>
                            </div>
                            @if( !empty($id))
				
				<input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control" required/>
				
			         @endif
				
                        </div>
                        <div class="form_footer col-md-12">
                            <!--<span class="link_btn" data-target="#form_acordian" data-toggle="collapse" ><img src="{{ url('images/link.svg') }}" class="img-responsive" alt="link svg"></span>-->
                  
                            <button  class="tranfer_btn" >@if(empty($id)) Transfer @else Update @endif  </button>  
                        </div>
                        
				
			</form>
			
 </div>      
            </div>
        </div>
    </div>  
</section>

<div class="loading-image"><div class="loader"><img src="{{ url('images/loader.gif') }}"><div class="loading_per">0</div></div></div>

 <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
 <script src="//oss.maxcdn.com/jquery.form/3.50/jquery.form.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
            
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
              <script>
 
 $(function() {
 $(document).ready(function(){

 var bar = $('.loading_per')
 var percent = $('#percent');
 var status = $('#status');
 
 $('form').ajaxForm({
 beforeSend: function() {
 status.empty();
$('.loading-image').show();
 if(!$('.sucess_msg').hasClass('hidden'))
 {
   $('.sucess_msg').addClass('hidden');
 }
  bar.show();
 var percentVal = '0%';
 bar.width(percentVal);
 percent.html(percentVal);
 },
 uploadProgress: function(event, position, total, percentComplete) {

  if(percentComplete!=100)
  {
     var percentVal = percentComplete + '%';
     bar.html(percentVal);
  }

 },
 success: function( data ) {
$('.sucess_msg').html(data.success);
$('.sucess_msg').removeClass('hidden');
 },
 complete: function(xhr) {
  percentComplete=100;
    var percentVal = percentComplete + '%';
    bar.html(percentVal);
     bar.hide();
      bar.html(0);
 //status.html(xhr.responseText);
 $('.loading-image').hide();
 }
 });
 });
 });
 </script>
    
