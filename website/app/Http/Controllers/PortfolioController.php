<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Activity;
use App\Models\Project;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('date', 'desc')->get();
        $activities = Activity::orderByRaw('date IS NULL ASC')->orderBy('date', 'desc')->get();
        $projects = Project::orderBy('date', 'desc')->get();
        $educations = Education::with('subs')->orderBy('start_year', 'desc')->get();

        $profile = [];
        if (Storage::exists('profile.json')) {
            $profile = json_decode(Storage::get('profile.json'), true);
        } else {
            $profile = [
                'name' => 'My Portfolio',
                'role' => 'IT Student',
                'open_to_work' => true
            ];
        }

        $techStack = [];
        if (Storage::exists('tech_stack.json')) {
            $techStack = json_decode(Storage::get('tech_stack.json'), true);
        } else {
            $techStack = ['PHP', 'Laravel', 'JavaScript', 'MySQL', 'Tailwind CSS', 'Git'];
        }

        $socials = [];
        if (Storage::exists('socials.json')) {
            $socials = json_decode(Storage::get('socials.json'), true);
        }

        return view('portfolio', compact('certificates', 'activities', 'projects', 'educations', 'profile', 'techStack', 'socials'));
    }
}
