<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function taskUpdated(Request $request){
        $data = $request->all;

        $task = Task::find($data['task_id']);

        if ($task) {
            // Optionally, you can perform additional actions with the data
            $task->status = $data['status'];
            $task->updated_at = $data['updated_at'];
            $task->save();
        }

        return response()->json(['status' => 'success']);
    }
}
