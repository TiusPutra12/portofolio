<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    public function edit()
    {
        $socials = [];
        if (Storage::exists('socials.json')) {
            $socials = json_decode(Storage::get('socials.json'), true);
        }

        return view('admin.socials.edit', compact('socials'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'github' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['github', 'email', 'linkedin', 'instagram', 'facebook', 'whatsapp']);

        Storage::put('socials.json', json_encode($data, JSON_PRETTY_PRINT));

        return redirect()->route('admin.socials.edit')->with('success', 'Social Media links updated successfully.');
    }
}
