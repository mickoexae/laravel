@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Task</h1>

    <!-- Notifikasi Error -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label for="title" class="block font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $task->title) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">{{ old('description', $task->description) }}</textarea>
        </div>

        <!-- Project -->
        <div>
            <label for="project_id" class="block font-medium text-gray-700">Project</label>
            <select id="project_id" name="project_id"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                <option value="">-- Pilih Project --</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}"
                        {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block font-medium text-gray-700">Status</label>
            <select id="status" name="status"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2">
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update Task
            </button>
            <a href="{{ route('tasks.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
