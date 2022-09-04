<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function tasks(){

        $tasks = Task::all();    
        return new TaskResource($tasks);
    }


    public function users(){

        $users = User::all();    
        return $users;
    }

    public function store(TaskRequest $request){

        $inputs = $request->all();
        $task = Task::create($inputs);
        $user = auth()->user();
        $user->tasks()->attach($task->id);
        return response([
            'message'=> 'تسک با موفقیت ثبت شد',
            'status' => 'success'
        ],200);
      

    } 

    public function update(TaskRequest $request,Task $task){
        $inputs = $request->all();
        $task->update($inputs);
        return response([
            'message'=> 'تسک با موفقیت آپدیت شد',
            'status' => 'success'
        ],200); 
       }


    public function addUser(Task $task){

        $user = auth()->user();
        $task->users()->attach($user->id);
        return response([
            'message'=> 'شما به تسک منشن شدید',
            'status' => 'success'
        ],200); 
    
       }


    public function destroy(Task $task){

        $task->delete();
        return response([
            'message'=> 'تسک با موفقیت حذف شد',
            'status' => 'success'
        ],200); 

    }
}
