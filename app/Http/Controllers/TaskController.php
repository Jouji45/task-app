<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Use the relationship to get only the current user's tasks
        $tasks = auth()->user()->tasks()->latest()->get(); 
        
        return view('tasks.index', compact('tasks'));        
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);

        auth()->user()->tasks()->create([
            'title' => $request->title
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        // Ensure the task belongs to the user before updating
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->is_done = !$task->is_done;
        $task->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        // Ensure the task belongs to the user before deleting (also fixed the 'ddestory' typo)
        auth()->user()->tasks()->findOrFail($id)->delete();
        
        return redirect()->back();
    }
}