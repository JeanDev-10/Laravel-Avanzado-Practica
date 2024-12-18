<?php

namespace App\Http\Controllers;

use App\Events\TaskUpdated;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'done' => 'boolean',
        ]);

        $task = Task::create($validated);

        //* event(new TaskUpdated($task)); sin emitir a otros
        broadcast(new TaskUpdated($task, 'created'))->toOthers(); //* emitiendo a otros

        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'done' => 'boolean',
        ]);

        $task->update($validated);

        broadcast(new TaskUpdated($task, 'updated'))->toOthers();

        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        broadcast(new TaskUpdated($task, 'deleted'))->toOthers();

        return response()->json(['message' => 'Task deleted']);
    }
}
