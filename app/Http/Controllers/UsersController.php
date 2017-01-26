<?php 

namespace App\Http\Controllers;

use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Reuests;
use App\User;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        return "hi";
    }
    public function create()
    {
    if(isset($_GET['id']))
    {
         $user= new User();
        
         $user1 = $user->where('id',$_GET['id'])->first();
         if(!empty($user1))
         {
             $imgname=$user1->name;
             $message=$user1->message;
			 $download_fee = $user1->download_fee;
			 $paypal_email = $user1->paypal_email; 
            return view('users.create', ['id' => $_GET['id'],'imgname'=>$imgname,'expiry_days'=>$user1->expiry_days,'message'=>$message,'download_fee' => $download_fee ,'paypal_email' => $paypal_email]);
         }
        else
        {
              return view('users.create');
        }

    }
    else
    {
     return view('users.create');
    }
    
       
    }
    public function save(Request $request)
    {

    if(isset($request->path))
    {
         $user= new User();
          $path=$request->path;
     $user1 = $user->where('id',$path)->first();    

         if(!empty($user1 ))
         {   
             if(1)
            {    
                if($user1->password==$request->pass)
                {
                     $path=$user1->name;
                  return( Response::download('upload/'.$path) );
                }
                else
                {
                 return view('users.download', ['path' => $path,'status'=> 2,'suc'=>'Please Enter Valid Password']);         
                }

                  
            }
           else
             {
                 return view('users.download', ['path' => $path,'status'=> 2,'alert'=>'alert','suc'=>'Please insert password for Download ']);         
             }
                //PDF file is stored under project/public/download/info.pdf
       }
    }
    else if(!isset($request->id))
    {
        $pass= rand(11111,99999);
        $user= new User();
        $user->email= $request->email;
        $user->message= $request->message;
        $user->fname= $request->fname;
        $user->lname= $request->lname;
        $user->send_by= $request->send_by;
        $user->expiry_days= $request->expiry_days;
	    $user->download_fee = $request->download_fee;
		$user->paypal_email = $request->paypal_email; 
        $user->password =$pass;
        


        $file = $request->file('name');
   
        $timestamp =time();
	    
	$name = $timestamp. '-' .$file->getClientOriginalName();
	    
	$user->name= $name;

      //Move Uploaded File
      $destinationPath = 'uploads';
      $file->move('./upload',$name);

 
       $user->save();
         
        $insertedId = $user->id;
        
        $userss = array(
		'email'=>$request->email,
		'email_to'=>$request->send_by

	);

         
       $data1=array('fname'=>$request->fname,'to'=>$request->name,'id'=>$insertedId,'mess'=>$request->message,'password'=>$pass);
     
	Mail::send('emails.welcome', $data1, function ($message) use ($userss ) {
	    $message->from('mahicoolparihar@gmail.com', 'send');
	
	    $message->to($userss['email']);
	});
	
	   Mail::send('emails.sendby', $data1, function ($message) use ($userss ) {
	    $message->from('mahicoolparihar@gmail.com', 'send');
	
	    $message->to($userss['email_to']);
	});
	
	
          $url="http://dev.imenso.co/nwd-app/users/create?id=".$insertedId ;


         
        // $data=array("success"=>"Uploaded Successfully","url"=>'');
       
        $data=array("success"=>'Send Successfully','status' => 'success','url'=>$url);

         return \Response::json($data);

      
        }
        else if(isset($request->delete_file))
		{
			$id= $request->id;
            $user_data = User::find($id);	
			$user= new User();			
	        $timestamp =time();		    
		    $name = $user_data->name;		
        	//Move Uploaded File
        	$destinationPath = 'uploads';
			File::Delete('upload/'.$name);
			
        	$user->where('id', $id)->update(array('name' =>''));
			$data=array("success"=>'File Deleted Successfully','status' => 'success','delete' => 'Y');

			return \Response::json($data);			
		}
		else 
        {
                $id= $request->id;
                $user= new User();
              $user1 = $user->where('id',$id)->first(); 
           if($request->hasFile('name'))
           {
	           
	            $file = $request->file('name');
	            $timestamp =time();
		    
		       $name = $timestamp. '-' .$file->getClientOriginalName();
		
        	   //Move Uploaded File
        	   $destinationPath = 'uploads';
        	   $file->move('./upload',$name);

	          $user->where('id', $id)->update(array('name' =>$name));
          }

           $expiry_days=$request->expiry_days;
		   $download_fee=$request->download_fee;
		   $paypal_email = $request->paypal_email; 
           $msg=$request->message;
           $user->where('id', $id)->update(array('message' =>$msg,'expiry_days'=>$expiry_days,'download_fee' => $download_fee, 'paypal_email' => $paypal_email));
	      
	      $data=array("success"=>'Updated Successfully');
	      
		   $data1=array('fname'=>$user1->fname,'to'=>$user1->name,'id'=>$id,'mess'=>$request->message);
		   
		   $userss = array(
		'email'=>$user1->email,
		'email_to'=>$user1->send_by);
	
		  Mail::send('emails.sendby', $data1, function ($message) use ($userss ) {
				$message->from('mahicoolparihar@gmail.com', 'send');
	
				$message->to($userss['email_to']);
			});
		Mail::send('emails.welcome', $data1, function ($message) use ($userss ) {
	    $message->from('mahicoolparihar@gmail.com', 'send');
	
	    $message->to($userss['email']);
	});
	
        //  return $this->create()->with('data',$data);
            return \Response::json($data);
        }
    }
    public function profile()
    {
      return view('users.download');
    }
    public function getDownload(){   
    
     $path=0;
     $user= new User();
    
     
     if(isset($_GET['path']) && isset($_GET['paid']))
     {
	     $path=$_GET['path'];
	

	     $user->where('id', $path)->update(array('paid_status' =>1));
	     
	      return view('users.download', ['path' => $path,'status'=> 1,'suc'=>'Payment Successfully']);
	     
	     
     }
     else
     {
          $path=$_GET['path'];
	     $user1 = $user->where('id',$path)->first();		 		 $updatedTime = $user1->updated_at;		 $time_diff = strtotime(date('Y-m-d H:i:s')) - strtotime($updatedTime);		 $duration = $time_diff/60;	     		
	     if(!empty($user1 ))
	     {   
		     if($user1->paid_status!=1)
		     {	      
	                   return view('users.download', ['path' => $path,'userdata' => $user1]);
		       //  return view('users.download');
		     }
             elseif($duration > 360)
            {				
                return view('users.download', ['path' => $path,'status'=> 0,'suc'=>'Download File Link Expire.']);		
        	}
             elseif(isset($request->pass) && $request->pass!="")
            {    
                if($user1->password==$request->pass)
                {
                     $path=$user1->name;
                  return( Response::download('upload/'.$path) );
                }
                else
                {
                 return view('users.download', ['path' => $path,'status'=> 2,'alert'=>'Please Enter Valid Password','suc'=>'Please insert password for Download ']);         
                }

                  
            }
		   else
		     {
		         return view('users.download', ['path' => $path,'status'=> 2,'alert'=>'alert','suc'=>'Please insert password for Download ']);         
		     }
		        //PDF file is stored under project/public/download/info.pdf
	   }
     }
}

   
}

?>