<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\EducationSub;
use Illuminate\Http\Request;

class EducationSubController extends Controller
{
    public function create(Education $education)
    {
        return view('admin.education.subs.create', compact('education'));
    }

    public function store(Request $request, Education $education)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'supervisor' => 'nullable|string|max:255',
            'status' => 'required|string|in:Lulus,Proses',
            'description' => 'nullable|string',
        ]);

        $education->subs()->create($request->all());

        return redirect()->route('admin.education.index')->with('success', 'Sub-pendidikan berhasil ditambahkan.');
    }

    public function edit(EducationSub $sub)
    {
        return view('admin.education.subs.edit', compact('sub'));
    }

    public function update(Request $request, EducationSub $sub)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'supervisor' => 'nullable|string|max:255',
            'status' => 'required|string|in:Lulus,Proses',
            'description' => 'nullable|string',
        ]);

        $sub->update($request->all());

        return redirect()->route('admin.education.index')->with('success', 'Sub-pendidikan berhasil diperbarui.');
    }

    public function destroy(EducationSub $sub)
    {
        $sub->delete();
        return redirect()->route('admin.education.index')->with('success', 'Sub-pendidikan berhasil dihapus.');
    }
}
