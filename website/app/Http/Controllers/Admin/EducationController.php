<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('start_year', 'desc')->get();
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_year' => 'required|integer',
            'end_year' => 'nullable|integer',
            'status' => 'nullable|string|max:255',
        ]);

        Education::create($request->all());

        return redirect()->route('admin.education.index')->with('success', 'Riwayat pendidikan berhasil ditambahkan.');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_year' => 'required|integer',
            'end_year' => 'nullable|integer',
            'status' => 'nullable|string|max:255',
        ]);

        $education->update($request->all());

        return redirect()->route('admin.education.index')->with('success', 'Riwayat pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.education.index')->with('success', 'Riwayat pendidikan berhasil dihapus.');
    }
}
