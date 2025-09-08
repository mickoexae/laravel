@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Project</h1>

    <form action="{{ route('projects.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Nama Project -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Nama Project</label>
            <input type="text" name="name" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Masukkan nama project" required>
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Tulis deskripsi project (opsional)"></textarea>
        </div>

        <!-- Tombol -->
        <div class="flex justify-between items-center">
            <a href="{{ route('projects.index') }}" 
               class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
                Kembali
            </a>
            <button type="submit" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Simpan Project
            </button>
        </div>
    </form>
</div>
@endsection
