<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'done' => 'required|boolean',
        ]);

        $task = Task::create([
            'user_id' => $validated['user_id'],
            'name' => $validated['name'],
            'done' => $validated['done'],
        ]);

        return response()->json([
            'message' => 'Task created successfully!',
            'task' => $task,
        ], 201);
    }

    public function storeMultiple(Request $request)
    {
        $validated = $request->validate([
            'tasks' => 'required|array',
            'tasks.*.user_id' => 'required|exists:users,id',
            'tasks.*.name' => 'required|string|max:255', 
            'tasks.*.done' => 'required|boolean',
        ]);

        $tasks = [];
        foreach ($validated['tasks'] as $taskData) {
            $tasks[] = Task::create($taskData);
        }

        return response()->json([
            'message' => 'Tasks created successfully!',
            'tasks' => $tasks,
        ], 201);
    }
}
