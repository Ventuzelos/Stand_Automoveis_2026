<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class AuditoriaController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(20);

        return view('auditoria.index', compact('logs'));
    }
}
