<?php

// app/Http/Controllers/Api/TaskApiController.php

// app/Http/Controllers/Api/TaskApiController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskApiController extends Controller
{
    public function index()
    {
        // Ambil semua tugas (bisa disesuaikan jika ingin hanya sebagian)
        return response()->json([
            'tasks' => Task::all()
        ]);
    }
}
