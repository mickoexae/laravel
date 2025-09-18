<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        $tasks = Task::with('project')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,in_progress,done',
            'project_id'  => 'required|exists:projects,id',
        ]);

        Task::create([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'project_id'  => $request->project_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,in_progress,done',
            'project_id'  => 'required|exists:projects,id',
        ]);

        $task->update([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'project_id'  => $request->project_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus');
    }
}
