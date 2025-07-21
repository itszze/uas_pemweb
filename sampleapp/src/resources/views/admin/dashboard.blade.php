<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin - Daftar Semua Tugas
        </h2>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto">
        <div class="bg-white shadow rounded p-6">
            @forelse ($tasks as $task)
                <div class="border-b pb-3 mb-4">
                    <strong>{{ $task->title }}</strong> - {{ $task->status }}
                    <br>
                    Mahasiswa: <em>{{ $task->user->name }}</em><br>
                    Deadline: {{ $task->due_date }}
                    <p>{{ $task->description }}</p>
                </div>
            @empty
                <p class="text-gray-500">Tidak ada tugas yang ditemukan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
