@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detail Task</h1>
        <div class="flex space-x-3">
            <a href="{{ route('tasks.index') }}" 
               class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
            <a href="{{ route('tasks.edit', $task->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>

    <!-- Task Details -->
    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Basic Info -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi Task</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Judul Task</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $task->title }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Status</label>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'in_progress' => 'bg-blue-100 text-blue-800',
                                'done' => 'bg-green-100 text-green-800'
                            ];
                            $statusLabels = [
                                'pending' => 'Pending',
                                'in_progress' => 'In Progress',
                                'done' => 'Selesai'
                            ];
                        @endphp
                        <span class="mt-1 inline-block px-3 py-1 text-sm font-medium rounded-full {{ $statusColors[$task->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $statusLabels[$task->status] ?? $task->status }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Dibuat Pada</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $task->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Project & Assignee -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi Lainnya</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Project</label>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $task->project->name ?? 'Tidak ada project' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Dibuat Oleh</label>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $task->user->name ?? 'Unknown' }}
                            @if($task->user->role === 'admin')
                                <span class="ml-2 bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Admin</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $task->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Deskripsi Task</h2>
        
        @if($task->description)
            <div class="prose max-w-none bg-white p-4 rounded-lg border">
                {!! nl2br(e($task->description)) !!}
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p>Tidak ada deskripsi untuk task ini</p>
            </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-between items-center pt-6 border-t">
        <div>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 text-white px-5 py-2.5 rounded-lg hover:bg-red-700 transition duration-200 flex items-center"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus task ini?')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Task
                </button>
            </form>
        </div>
        
        <div class="flex space-x-3">
            @if($task->status !== 'done')
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="done">
                    <button type="submit" 
                            class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Tandai Selesai
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

<style>
    .prose {
        line-height: 1.6;
    }
    .prose p {
        margin-bottom: 1rem;
    }
</style>
@endsection