<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function index(){
        return view('tasks.index');
    }

    public function all_tasks(){
        $users = User::all();
        $tasks = Task::with('user')->get();
        return view('tasks.show', compact(['tasks', 'users']));
    }

    public function edit_tasks($id){
        $user = Auth::user();
        $task = Task::find($id);
        return view('tasks.edit', compact(['task', 'user']));
    }

    public function delete_task($id){
        $task = Task::find($id);
        $task->delete();
        return redirect('all-tasks')->with('success', 'Task deleted successfully');
    }
}
