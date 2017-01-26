<?php 

namespace App\Http\Controllers;

use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Reuests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

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
            return view('users.create', ['id' => $_GET['id'],'imgname'=>$imgname,'expiry_days'=>$user1->expiry_days,'message'=>$message]);
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
    
    if(!isset($request->id))
    {
        $user= new User();
        $user->email= $request->email;
        $user->message= $request->message;
        $user->fname= $request->fname;
        $user->lname= $request->lname;
        $user->send_by= $request->send_by;
        $user->expiry_days= $request->expiry_days;

        


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

         
       $data1=array('fname'=>$request->fname,'to'=>$request->name,'id'=>$insertedId,'mess'=>$request->message);
     
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
        else
        {
                $id= $request->id;
                $user= new User();
               
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
           $msg=$request->message;
           $user->where('id', $id)->update(array('message' =>$msg,'expiry_days'=>$expiry_days));
	      
	      $data=array("success"=>'Updated Successfully');
	      
        //  return $this->create()->with('data',$data);
            return \Response::json($data);
        }
    }
    public function profile()
    {
      return view('users.profile');
    }
    public function getDownload(){
    
    
     $path=0;
     $user= new User();
    
     
     if(isset($_GET['path']) && isset($_GET['paid']))
     {
	     $path=$_GET['path'];
	

	     $user->where('id', $path)->update(array('paid_status' =>1));
	     
	      return view('users.download', ['path' => $path,'suc'=>'Payment Successfully']);
	     
	     
     }
     else
     {
          $path=$_GET['path'];
	
	     $user1 = $user->where('id',$path)->first();
	     if(!empty($user1 ))
	     {
	    
		   
		     if($user1->paid_status!=1)
		     {
		      
	                   return view('users.download', ['path' => $path]);
		       //  return view('users.download');
		     }
		     else
		     {
		       $path=$user1->name;
		      return( Response::download('upload/'.$path) );
		     }
		        //PDF file is stored under project/public/download/info.pdf
	   }
     }
}
}

?>