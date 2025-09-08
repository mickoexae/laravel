@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <!-- Judul Project -->
    <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $project->name }}</h1>
    <p class="text-gray-600 mb-6">{{ $project->description }}</p>

    <!-- Daftar Task -->
    <h2 class="text-xl font-semibold mb-3 text-gray-700">Daftar Task</h2>
    @if($project->tasks->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">Judul</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Dibuat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($project->tasks as $task)
                        <tr>
                            <td class="py-3 px-4">{{ $task->title }}</td>
                            <td class="py-3 px-4">
                                <span class="
                                    @if($task->status == 'done') bg-green-100 text-green-700
                                    @elseif($task->status == 'in_progress') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-700
                                    @endif
                                    px-2 py-1 rounded-full text-sm font-medium
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-gray-500">{{ $task->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500 italic">Belum ada task untuk project ini.</p>
    @endif

    <!-- Tombol -->
    <div class="flex justify-between items-center mt-6">
        <a href="{{ route('projects.index') }}" 
           class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
            Kembali
        </a>
        <a href="{{ route('tasks.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Tambah Task
        </a>
    </div>
</div>
@endsection
