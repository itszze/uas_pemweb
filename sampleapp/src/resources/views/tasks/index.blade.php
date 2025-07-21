<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #f4f4f4;
        }

        h1, h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .deadline-alert {
            color: red;
            font-weight: bold;
        }

        hr {
            margin: 20px 0;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Daftar Tugas Mahasiswa</h1>

    {{-- Form Tambah Tugas --}}
    <h2>Tambah Tugas Baru</h2>
    <form method="POST" action="/tasks">
        @csrf
        <label>Judul:
            <input type="text" name="title" required>
        </label><br>

        <label>Deskripsi:
            <textarea name="description"></textarea>
        </label><br>

        <label>Deadline:
            <input type="date" name="due_date" required>
        </label><br>

        <button type="submit">Tambah</button>
    </form>


    <hr>

    {{-- Daftar Tugas --}}
    <ul>
    @foreach ($tasks as $task)
        <li>
            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                @csrf
                @method('PUT')
                <input type="checkbox" name="status" onchange="this.form.submit()" {{ $task->status == 'selesai' ? 'checked' : '' }}>

                <strong>{{ $task->title }}</strong> - {{ $task->status }} - <em>{{ $task->status }}</em><br>
                Deadline: {{ $task->due_date }}

                {{-- Notifikasi Deadline Hampir Tiba --}}
                @if (\Carbon\Carbon::parse($task->due_date)->diffInDays(now()) <= 2 && $task->status === 'belum')
                    <span class="deadline-alert">⚠️ Deadline Hampir Tiba!</span>
                @endif

                <p>{{ $task->description }}</p>
            </form>
        </li>
    @endforeach
    </ul>
</body>
</html>
