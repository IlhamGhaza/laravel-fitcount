<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Menampilkan halaman todo dan daftar tugas
    public function show()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->get();
        return view('user.todo', compact('tasks'));
    }

    // Menambahkan tugas baru
    public function create()
    {
        return view('user.create_task');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string',
            'status' => 'required|string',
        ]);

        $user = Auth::user();

        Task::create([
            'user_id' => $user->id,
            'task_name' => $request->task_name,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return redirect()->route('todo.show')->with('success', 'Tugas berhasil ditambahkan!');
    }

    // Update status tugas
    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('todo.show')->with('success', 'Status tugas berhasil diperbarui!');
    }

    // Menambahkan progress pada tugas
    public function addProgress(Request $request, Task $task)
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

        return redirect()->route('todo.show')->with('success', 'Progress tugas berhasil ditambahkan!');
    }
}
