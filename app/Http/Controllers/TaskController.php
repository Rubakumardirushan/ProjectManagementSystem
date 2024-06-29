<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'description'=>'required',
            'title'=>'required',
            'status'=>'required',
            'project_id'=>'required|exists:projects,id'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        // check project_id
        $project_id=$request->project_id;
        $project=Project::find($project_id);
        if(!$project){
            return response()->json(['message'=>'Project not found'],404); 
        }
        $task=Task::create($request->all());
        $massage['message']='Task created successfully';
        return response()->json($massage,201); 
    }
    public function index(){
        $tasks=Task::all();
        return response()->json($tasks,200); 
    }
    public function show($id){
        $task=Task::find($id);
        if($task){
            return response()->json($task,200);
        }
        else{
            return response()->json(['message'=>'Task not found'],404); 
        }
    }


public function showProjectTask($id){
    $task=Task::where('project_id',$id)->get();
    if($task){
        return response()->json($task,200);
    }
    else{
        return response()->json(['message'=>'Task not found'],404); 
    }
}
   
public function update(Request $request,$id){
    $task=Task::find($id);
    if($task){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'description'=>'required',
            'title'=>'required',
            'status'=>'required',
            'project_id'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        $task->update($request->all());
        $massage['message']='Task updated successfully';
        return response()->json($massage,200); 
    }
    else{
        return response()->json(['message'=>'Task not found'],404); 
    }
}
    public function destroy($id){
        $task=Task::find($id);
        if($task){
            $task->delete();
            $massage['message']='Task deleted successfully';
            return response()->json($massage,200); 
        }
        else{
            return response()->json(['message'=>'Task not found'],404); 
        }
    }
    
   
    
   
    
  
    
    
}
