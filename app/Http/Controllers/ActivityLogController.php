<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::query();

        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $logs = $query->latest()->paginate(50)->withQueryString();

        return view('admin.activity-logs', compact('logs'));
    }

    public function deleteLastLogs()
    {

        Artisan::call('logs:delete-last');

        return redirect()->route('admin.activity-log');
    }

}
