<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('project')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::all(); // biar bisa pilih project
        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'status'      => 'required',
            'project_id'  => 'required|exists:projects,id',
        ]);

        Task::create([
            'title'      => $request->title,
            'status'     => $request->status,
            'project_id' => $request->project_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required',
            'status'      => 'required',
            'project_id'  => 'required|exists:projects,id',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus');
    }
}
