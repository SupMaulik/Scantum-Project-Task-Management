<?php

namespace App\Http\Controllers\Api;

namespace App\Http\Controllers\Api;

if (session_status() == PHP_SESSION_ACTIVE) {
    ;
  }
  else
  {
    
  
  session_start();
  }
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Task;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        echo "hello";
        exit;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rules=[

            "task"=>'required',
            "status"=>'required',
            
        ];
        
        
        $validator=Validator::make($request->all(),$rules);
            
        if($validator->fails())
        {
           
            
            return response()->json(["message"=>$validator->errors(),"status"=>false]);
        }
        else
        {
            
        $task=new Task();
        $task->Task_Name=$request->task;
        $task->user_id=$_SESSION["ID"];
        $task->Task_Status =$request->status;
        $task->save();

       

        return response()->json([ 
                                "message" => "Task is added Succdessfully"]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        echo "here";
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task=Task::find($request->task_id);
        $task->Task_Name=$request->Task_Name;
        $task->Task_Status =$request->Task_Status;
        $task->save();

       

        return response()->json([ 
                                "message" => "Task Update Sucessfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
    

        $tid=$request["tid"];

        $task=Task::find($tid);
        $task->delete();

        return response()->json([ 
            "message" => "Task Deleted Sucessfully"]);

    }
}
