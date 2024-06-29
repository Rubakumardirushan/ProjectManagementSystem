<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function store(Request $request){
$validator=Validator::make($request->all(),[
    'name'=>'required|unique:projects',
    'description'=>'required',
    'deadline'=>'required|date'
]);
if($validator->fails()){
    return response()->json($validator->errors(),422);
}
$project=Project::create($request->all());
$massage['message']='Project created successfully';
return response()->json($massage,201); 
    }
    
    public function index(){
        $projects=Project::all();
        return response()->json($projects,200); 
    }

    public function show($id){
        $project=Project::find($id);
        if($project){
            return response()->json($project,200);
        }
        else{
            return response()->json(['message'=>'Project not found'],404); 
            
        }
        
    }
public function update(Request $request,$id){
    $project=Project::find($id);
    if($project){
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:projects',
            'description'=>'required',
            'deadline'=>'required|date'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        $project->update($request->all());
        $massage['message']='Project updated successfully';
        return response()->json($massage,200); 
    }
    else{
        return response()->json(['message'=>'Project not found'],404); 
    }
}
    public function destroy($id){
        $project=Project::find($id);
        if($project){
            $project->tasks()->delete();
            $project->delete();
            $massage['message']='Project deleted successfully';
            return response()->json($massage,200); 
        }
        else{
            return response()->json(['message'=>'Project not found'],404); 
        }
    }

}
