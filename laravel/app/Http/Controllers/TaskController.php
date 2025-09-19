<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        $query = Task::with(['project', 'user'])->latest();
        
        if (auth()->user()->role !== 'admin') {
            $adminIds = \App\Models\User::where('role', 'admin')->pluck('id');
            
            $query->where(function($q) use ($adminIds) {
                $q->whereIn('user_id', $adminIds)
                  ->orWhere('user_id', auth()->id());
            });
        }
        
        $tasks = $query->paginate(10);
        
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
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string', // Bisa null
            'status'      => 'required|in:pending,in_progress,done',
            'project_id'  => 'required|exists:projects,id',
        ]);

        // PERBAIKAN: Gunakan null coalescing untuk handle jika description tidak ada
        Task::create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null, // Ini perbaikan utama
            'status'      => $validated['status'],
            'project_id'  => $validated['project_id'],
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil ditambahkan');
    }

    /**
     * Check authorization for task access (helper method)
     */
    private function authorizeTaskAccess(Task $task)
    {
        if (auth()->user()->role !== 'admin') {
            if (!$task->relationLoaded('user')) {
                $task->load('user');
            }
            
            if ($task->user->role !== 'admin' && $task->user_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        }
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        $this->authorizeTaskAccess($task);
        
        $task->load(['project', 'user']);
        
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        $this->authorizeTaskAccess($task);
        
        $task->load(['project', 'user']);
        
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeTaskAccess($task);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,in_progress,done',
            'project_id'  => 'required|exists:projects,id',
        ]);

        // PERBAIKAN: Gunakan null coalescing untuk update juga
        $task->update([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status'      => $validated['status'],
            'project_id'  => $validated['project_id'],
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil diperbarui');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorizeTaskAccess($task);
        
        $task->delete();
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil dihapus');
    }
}