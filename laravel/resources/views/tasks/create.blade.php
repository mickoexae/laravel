@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Judul Task -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Judul Task</label>
            <input type="text" name="title" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Masukkan judul task" required
                value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi Task -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Deskripsi Task (Opsional)</label>
            <textarea name="description" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Masukkan deskripsi task (opsional)" 
                rows="4">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Status</label>
            <select name="status" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pilih Project -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Pilih Project</label>
            <select name="project_id" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
            @error('project_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="flex justify-between items-center">
            <a href="{{ route('tasks.index') }}" 
               class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
                Kembali
            </a>
            <button type="submit" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Simpan Task
            </button>
        </div>
    </form>
</div>
@endsection