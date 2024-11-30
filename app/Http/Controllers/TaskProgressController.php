<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskProgressController extends Controller
{
    // // Konstruktor untuk memastikan user harus login
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Menambahkan progress pada tugas
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'progress_description' => 'required|string',
        ]);

        $user = Auth::user();

        TaskProgress::create([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'description' => $request->progress_description,
            'status' => 'In Progress', // Bisa disesuaikan dengan status lainnya
        ]);

        return redirect()->route('user.todo', $task)->with('success', 'Progress tugas berhasil ditambahkan!');
    }

    // Menampilkan progress tugas
    public function show(Task $task)
    {
        $taskProgress = $task->taskProgress;
        return view('tasks.progress', compact('task', 'taskProgress'));
    }
}
