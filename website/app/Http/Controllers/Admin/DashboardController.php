<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Activity;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'certificates' => Certificate::count(),
            'activities' => Activity::count(),
            'projects' => Project::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
