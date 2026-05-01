<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = [];
        if (Storage::exists('profile.json')) {
            $profile = json_decode(Storage::get('profile.json'), true);
        }

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'open_to_work' => 'boolean',
            'about_me' => 'nullable|string',
        ]);

        $additional_info = [];
        $header_role = 'Mahasiswa'; // Default
        $header_address = null;

        if ($request->has('additional_labels')) {
            foreach ($request->additional_labels as $index => $label) {
                if (!empty($label) && isset($request->additional_values[$index])) {
                    $val = $request->additional_values[$index];
                    $additional_info[] = [
                        'label' => $label,
                        'value' => $val
                    ];
                    
                    // Sync with header role if label is "role"
                    if (strtolower($label) === 'role') {
                        $header_role = $val;
                    }
                    if (strtolower($label) === 'address' || strtolower($label) === 'alamat') {
                        $header_address = $val;
                    }
                }
            }
        }

        $data = [
            'name' => $request->name,
            'role' => $header_role,
            'address' => $header_address,
            'open_to_work' => $request->has('open_to_work') ? true : false,
            'about_me' => $request->about_me,
            'additional_info' => $additional_info,
        ];

        Storage::put('profile.json', json_encode($data, JSON_PRETTY_PRINT));

        return redirect()->route('admin.profile.edit')->with('success', 'Profile.json updated successfully.');
    }
}
