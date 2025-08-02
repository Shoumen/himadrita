<?php

namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;

use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = Activity::when($request->log_name, function ($query) use ($request) {
            $query->where('log_name', $request->log_name);
        })->latest()->paginate(20);

        return view('backend.activitylog.index', compact('logs'));
    }
    public function destroy($id)
    {
        $log = Activity::findOrFail($id);
        $log->delete();

        return redirect()->route('activity.logs')->with('success', 'History entry deleted successfully!');
    }
}
