<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Submission;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Dashboard Mahasiswa (Daftar tugas & tambah tugas)
Route::get('/dashboard', function () {
    $tasks = Task::with('submissions')->orderBy('due_date')->get();
    return view('dashboard', compact('tasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Tambah tugas manual (khusus admin/dosen)
Route::post('/tasks', function (Request $request) {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'required|date',
    ]);

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
        'status' => 'belum',
        'user_id' => auth()->id(), // user_id dosen/pembuat tugas
    ]);

    return redirect('/dashboard')->with('success', 'Tugas berhasil ditambahkan!');
})->middleware('auth')->name('tasks.store');

// ✅ Update status atau edit tugas (hanya pembuat tugas)
Route::put('/tasks/{id}', function (Request $request, $id) {
    $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    $task->update([
        'title' => $request->title ?? $task->title,
        'description' => $request->description ?? $task->description,
        'due_date' => $request->due_date ?? $task->due_date,
        'status' => $request->has('status') ? 'selesai' : 'belum',
    ]);

    return back()->with('success', 'Tugas berhasil diupdate!');
})->middleware('auth')->name('tasks.update');

// ✅ Hapus tugas
Route::delete('/tasks/{id}', function ($id) {
    $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $task->delete();

    return back()->with('success', 'Tugas berhasil dihapus.');
})->middleware('auth')->name('tasks.destroy');

// ✅ Upload tugas (Mahasiswa)
Route::post('/submissions', function (Request $request) {
    $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'file' => 'required|file|mimes:pdf,docx,doc,zip|max:2048',
    ]);

    $path = $request->file('file')->store('submissions', 'public');

    Submission::create([
        'task_id' => $request->task_id,
        'user_id' => auth()->id(),
        'file_path' => $path,
    ]);

    return back()->with('success', 'Tugas berhasil dikumpulkan!');
})->middleware('auth')->name('submissions.store');

// ✅ Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Auth routes (login/register/logout)
require __DIR__.'/auth.php';
