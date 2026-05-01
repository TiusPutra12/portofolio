<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TechStackController extends Controller
{
    public function edit()
    {
        $techStack = [];
        if (Storage::exists('tech_stack.json')) {
            $techStack = json_decode(Storage::get('tech_stack.json'), true);
        }

        // Convert array to comma-separated string for easy editing
        $techStackString = is_array($techStack) ? implode(', ', $techStack) : '';

        return view('admin.tech_stack.edit', compact('techStackString'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tech_stack' => 'required|string',
        ]);

        // Convert comma-separated string back to array, remove empty items, and trim whitespace
        $techStackArray = array_filter(array_map('trim', explode(',', $request->tech_stack)));

        // Re-index array
        $techStackArray = array_values($techStackArray);

        Storage::put('tech_stack.json', json_encode($techStackArray, JSON_PRETTY_PRINT));

        return redirect()->route('admin.tech_stack.edit')->with('success', 'Tech Stack updated successfully.');
    }
}
