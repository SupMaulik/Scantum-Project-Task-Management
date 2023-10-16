<?php

use Illuminate\Support\Facades\Route;
if (session_status() == PHP_SESSION_ACTIVE) {
    ;
  }
  else
  {
    
  
  session_start();
  }
use App\Models\Task;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//Route for home page
Route::get('/',function(){

return view('index');
});

//Route for login page
Route::get('/login',function(){

    return view('login');
    });

    //Route for Register page
Route::get('/user_register',function(){

    return view('register');
    });

    //Route for Task page
Route::get('/Task_Dashboard',function(){

  
   
      if(isset($_SESSION["name"]))
      {
       $task=Task::all();

       
    return view('task')->with(["task"=>$task]);
      }
      else
      {
        return view('login');
      }
    });

    Route::get('/view_task/{id?}',[UserController::class,'show_view']);
    Route::get('/edit_task/{id?}',[UserController::class,'show_edit']);

    Route::get('/delete_task/{id?}',[UserController::class,'show_delete']);

    