<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        return Task::all();
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = Task::create($data);

        return response()->json([
            'status' => 200,
            'message' => 'Task Created Successfully',
            'task' => $task
        ]);
    }


    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

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
    }

    public function delete($id){
        $task = Task::where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Task Deleted Successfully',
        ]);
    }
}
