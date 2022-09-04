<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(TaskRequest $request){
            
        $validData= $this->validate($request, [
            'username' => 'required|exists:users',
            'password' => 'required',
        ]);


        if(! auth()->attempt($validData)) {
            return response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ],403);
        }

        $token = $this->createToken();
        return new UserResource(auth()->user() , $token);
    }

    public function register(Request $request){

        $validData = $this->validate($request, [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        
        $user = User::create([
            'username' => $validData['username'],
            'password' => bcrypt($validData['password']),
            'api_token' => Str::random(100)
        ]);

        auth()->login($user);
        $token = $this->createToken();
        return new UserResource($user, $token);
        }

    private function createToken()
        {
            auth()->user()->tokens()->delete();
            return auth()->user()->createToken('Api Token on Android')->accessToken;
        }


    public function index(){

        $user = auth()->user();
        $tasks = $user->tasks;    
        return new TaskResource($tasks);

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


    public function destroy(Task $task){
        $result = $task->delete();
        return response([
            'message'=> 'تسک با موفقیت حذف شد',
            'status' => 'success'
        ],200);  
      }
}
