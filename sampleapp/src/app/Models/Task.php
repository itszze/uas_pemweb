<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'user_id',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    // ✅ Opsional: untuk nama file ZIP
    public function zipFileName(): string
    {
        return 'submissions_task_' . $this->id . '.zip';
    }

    // ✅ Opsional: untuk semua path file submission (bisa dipakai di controller)
    public function getAllSubmissionPaths(): array
    {
        return $this->submissions->map(function ($submission) {
            return storage_path('app/public/' . $submission->file_path);
        })->filter(fn($path) => file_exists($path))->toArray();
    }
}
