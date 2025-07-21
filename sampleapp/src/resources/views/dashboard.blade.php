{{-- resources/views/dashboard.blade.php --}}
@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app-noncomponent')


@section('content')
<div class="py-12 max-w-5xl mx-auto">
    <div class="bg-white shadow rounded p-6">
    {{-- @if (session('success'))
    <div class="mb-4 text-green-600 font-semibold">
        {{ session('success') }}
    </div>
@endif --}}


        <p class="text-lg text-gray-700 mb-4">
            Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
        </p>

        {{-- Form Tambah Tugas (Hanya untuk Admin) --}}
        @if (Auth::user()->is_admin)
        <h3 class="text-xl font-semibold mb-2">Tambah Tugas Baru</h3>
        <form method="POST" action="{{ url('/tasks') }}" class="mb-6 space-y-3">
            @csrf
            <input type="text" name="title" required placeholder="Judul" class="w-full border rounded px-2 py-1">
            <textarea name="description" placeholder="Deskripsi" class="w-full border rounded px-2 py-1"></textarea>
            <input type="date" name="due_date" required class="w-full border rounded px-2 py-1">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Tambah Tugas
            </button>
        </form>
        @endif

        {{-- Daftar Tugas --}}
        <h3 class="text-xl font-semibold mb-3">Daftar Tugas:</h3>

        @forelse ($tasks as $task)
            <div class="border-b pb-3 mb-4">
                {{-- Checkbox selesai (mahasiswa centang = selesai) --}}
                @if (!Auth::user()->is_admin)
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="checkbox" name="status" onchange="this.form.submit()" {{ $task->status === 'selesai' ? 'checked' : '' }}>
                        <strong>{{ $task->title }}</strong> - {{ $task->status }}
                    </form>
                @else
                    <strong>{{ $task->title }}</strong> - {{ $task->status }}
                @endif

                <br>
                <p class="text-sm">📅 Deadline: <strong>{{ $task->due_date }}</strong></p>
                <p>{{ $task->description }}</p>

                @if (Carbon::parse($task->due_date)->diffInDays(now()) <= 2 && $task->status === 'belum')
                    <span class="text-red-600 font-semibold">⚠️ Deadline Hampir Tiba!</span>
                @endif

                {{-- Pengumpulan Tugas (Mahasiswa) --}}
                @php
                    $submission = $task->submissions->where('user_id', auth()->id())->first();
                @endphp

                @if (Auth::user()->is_admin)
                    {{-- Tombol Edit & Hapus (Admin) --}}
                    <div class="mt-2 space-x-3">
                        <button onclick="openModal({{ $task->id }})" class="text-blue-600 hover:underline">✏️ Edit</button>
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Yakin hapus?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline">🗑️ Hapus</button>
                        </form>
                    </div>
                @else
                    @if ($submission)
                        <p class="text-green-600 mt-2 font-semibold">✅ Tugas sudah dikumpulkan</p>
                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-600 underline">📄 Lihat File</a>
                    @else
                        <form method="POST" action="{{ route('submissions.store') }}" enctype="multipart/form-data" class="mt-3 space-y-2">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <input type="file" name="file" required class="border p-1 rounded w-full">
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                Upload Jawaban
                            </button>
                        </form>
                    @endif
                @endif

                {{-- Modal Edit --}}
                <div id="modal-{{ $task->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded w-full max-w-lg">
                        <h3 class="text-xl font-bold mb-3">Edit Tugas</h3>
                        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label>Judul:</label>
                                <input type="text" name="title" value="{{ $task->title }}" class="w-full border px-2 py-1 rounded">
                            </div>
                            <div class="mb-2">
                                <label>Deskripsi:</label>
                                <textarea name="description" class="w-full border px-2 py-1 rounded">{{ $task->description }}</textarea>
                            </div>
                            <div class="mb-2">
                                <label>Deadline:</label>
                                <input type="date" name="due_date" value="{{ $task->due_date }}" class="w-full border px-2 py-1 rounded">
                            </div>
                            <div class="mt-4 flex justify-end space-x-2">
                                <button type="button" onclick="closeModal({{ $task->id }})" class="text-gray-600 hover:underline">Batal</button>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada tugas.</p>
        @endforelse
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
</script>
@endsection
