<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('date', 'desc')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('certificates', 'public');

        Certificate::create([
            'title' => $request->title,
            'issuer' => $request->issuer,
            'date' => $request->date,
            'image' => $path,
        ]);

        return redirect('/admin/certificates')->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'issuer' => $request->issuer,
            'date' => $request->date,
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($certificate->image);
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect('/admin/certificates')->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function destroy(Certificate $certificate)
    {
        Storage::disk('public')->delete($certificate->image);
        $certificate->delete();

        return redirect('/admin/certificates')->with('success', 'Sertifikat berhasil dihapus!');
    }
}
