@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Project</h1>
        <a href="{{ route('projects.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            + Tambah Project
        </a>
    </div>

    @if($projects->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">Nama Project</th>
                        <th class="py-3 px-4 text-left">Deskripsi</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($projects as $project)
                        <tr>
                            <td class="py-3 px-4 font-medium text-gray-800">
                                <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:underline">
                                    {{ $project->name }}
                                </a>
                            </td>
                            <td class="py-3 px-4 text-gray-600">{{ $project->description }}</td>
                            <td class="py-3 px-4 flex justify-center gap-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('projects.edit', $project) }}" 
                                   class="px-3 py-1 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition">
                                    Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus project ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500 italic">Belum ada project.</p>
    @endif
</div>
@endsection
