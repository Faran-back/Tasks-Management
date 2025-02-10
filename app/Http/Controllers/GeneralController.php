<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function edit_tasks(){
        $users = User::all();
        $tasks = Task::all();
        return view('tasks.edit', compact(['tasks', 'users']));
    }
}
