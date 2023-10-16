<?php

namespace App\Http\Controllers\Api;
if (session_status() == PHP_SESSION_ACTIVE) {
    ;
  }
  else
  {
    
  
  session_start();
  }
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Http;

use Validator;

class UserController extends Controller
{
    //Function for User's Registration
    public function register(Request $request)
    {
        
        
        $rules=[

            "name"=>'required',
            "email"=>'required',
            "password"=>'required|confirmed',
            'password_confirmation'=>'required'
        ];
        
        
        $validator=Validator::make($request->all(),$rules);
            
        if($validator->fails())
        {
           
            
            return response()->json(["message"=>$validator->errors(),"status"=>false]);
        }
        else
        {
            
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();

        $token=$user->createToken('api-token')->plainTextToken;


        return response()->json(["user" => $user,
                                 "token" =>$token,
                                "message" => "User Has Created Successfully"]);

        }
      

    }

    //Function for User's Login
    public function login(Request $request)
 {
     
    $rules=[
    "email"=>"required|email",
    "password"=>"required",
   
   ];
  
$validator=Validator::make($request->all(),$rules);

if($validator->fails())
{
  
return response()->json(["message"=>$validator->errors(),"status"=>false]);
}
else
{
   
    $user=User::where('email',$request->email)->first();
    if(!$user or !Hash::check($request->password,$user->password))
    {
       
        return response()->json(["message"=>"These Credentials dont match with our records","status"=>false]);


    }
    else
    {
        $token=$user->createToken('api-token')->plainTextToken;
        
        $_SESSION["name"]=$user->name;
        $_SESSION["email"]=$user->email;
        $_SESSION["token"]=$token;
        $_SESSION["ID"]=$user->id;
        return response()->json(["user" => $user,
                                 "token" =>$token,
                                "message" => "Login Sucessfully",
                                "status"=>true]);

    }
   
 }
}
    

     //Function for User's Logout
     public function logout(Request $req)
     {
        
           
         
         if(isset($_SESSION["email"]))
         {
        $user=User::where('email',$_SESSION["email"])->first();
        
    
           $user->tokens()->delete();
         }
        
        session_destroy();
        return response()->json(["message"=>"Logout Successfuly"]);
     }

     
     public function show_edit($id)
     {
      
        $task=Task::find($id);
      if(is_null($task))
         {
              //not found
              return redirect()->back();
         }
        else
         {
             //found
             $task=Task::all();
             
             $task1=Task::find($id);
             $data=compact('task','task1');
              return view('task')->with($data);
         }

     }



     public function show_view($id)
     {
      
        $task=Task::find($id);
      if(is_null($task))
         {
              //not found
              return redirect()->back();
         }
        else
         {
             //found
             $task=Task::all();
             
             $task1=Task::find($id);
             $view=1;
             $data=compact('task','task1','view');
              return view('task')->with($data);
         }

     }

     public function show_delete(Request $request)
     {
       $id=$request["id"];
       $_SESSION["task_id"]=$id;
       
       $task=Task::find($id);
      if(is_null($task))
         {
              //not found
              return redirect()->back();
         }
        else
         {
             //found
             $task=Task::all();
             
             $task1=Task::find($id);
             $status="ok";
            $data=compact('task','task1','status');

            
             
              return view('task')->with($data);
         }
       
       

     }
}

