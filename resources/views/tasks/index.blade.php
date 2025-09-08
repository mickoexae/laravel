@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Task List</h1>

    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        + Create Task
    </a>

    <table class="w-full mt-4 border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="border p-2">#</th>
                <th class="border p-2">Title</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Project</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td class="border p-2">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $task->title }}</td>
                    <td class="border p-2">{{ $task->status }}</td>
                    <td class="border p-2">{{ $task->project->name ?? '-' }}</td>
                    <td class="border p-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        |
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
