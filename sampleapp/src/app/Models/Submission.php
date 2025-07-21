<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'file_path'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Opsional: nama file hasil rename saat di-zip
    public function downloadFileName(): string
    {
        return $this->user->name . '_' . basename($this->file_path);
    }
}
