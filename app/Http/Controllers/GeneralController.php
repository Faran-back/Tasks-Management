<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index(){
        return view('tasks.index');
    }

    public function all_tasks(){
        return view('tasks.show');
    }
}
