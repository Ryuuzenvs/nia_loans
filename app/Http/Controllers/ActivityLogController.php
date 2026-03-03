<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Ambil log terbaru di atas
        $logs = ActivityLog::latest()->paginate(20);
        
        return view('admin.logs.index', compact('logs'));
    }
}
