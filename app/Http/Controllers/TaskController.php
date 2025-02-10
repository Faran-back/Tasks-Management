<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Notifications\TaskUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();

        if($tasks->isEmpty()){
            return response()->json([
                'status' => 200,
                'message' => 'No tasks found',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Tasks Fetched Successfully',
            'tasks' => $tasks
        ]) ;
    }

    public function store(Request $request){

        $user = Auth::user();

        $user_id = $user->id;

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $user_id
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Task created successfully',
            'task' => $task
        ]);
    }


    public function update(Request $request, $id){

        $task = Task::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Task Updated Successfully',
            'task' => $task
        ]);

        $response = Http::post(route('task.update', ['id' => $id]), [
            'task_id' => $id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $notification = Notification::send($task->user, new TaskUpdated($task));
    }

    public function delete($id){
        $task = Task::where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Task Deleted Successfully',
        ]);
    }

}
