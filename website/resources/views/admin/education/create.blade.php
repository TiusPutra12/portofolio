@extends('admin.layouts.admin')

@section('title', 'Tambah Pendidikan')

@section('content')
<div class="animate-fade-in max-w-2xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <p class="font-mono text-xs text-yellow-400 mb-1">// education.create()</p>
            <h2 class="text-2xl font-black text-white">Tambah Pendidikan</h2>
        </div>
        <a href="{{ route('admin.education.index') }}" class="px-4 py-2 text-sm font-mono text-slate-400 hover:text-white transition-colors border border-slate-800 hover:border-slate-600 rounded-lg bg-[#161b22]">
            return_to_list()
        </a>
    </div>

    <form action="{{ route('admin.education.store') }}" method="POST" class="admin-card p-6">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="institution">Nama Institusi <span class="req">*</span></label>
                <input type="text" name="institution" id="institution" class="input-field" value="{{ old('institution') }}" required>
                @error('institution')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="degree">Gelar / Jurusan <span class="req">*</span></label>
                <input type="text" name="degree" id="degree" class="input-field" value="{{ old('degree') }}" required>
                @error('degree')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="start_year">Tahun Mulai <span class="req">*</span></label>
                    <input type="number" name="start_year" id="start_year" class="input-field font-mono" value="{{ old('start_year') }}" required placeholder="YYYY">
                    @error('start_year')
                        <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="end_year">Tahun Selesai <span class="text-xs text-slate-500 font-mono ml-1">// opsional</span></label>
                    <input type="number" name="end_year" id="end_year" class="input-field font-mono" value="{{ old('end_year') }}" placeholder="Kosongkan jika masih berlangsung">
                    @error('end_year')
                        <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="status">Status <span class="req">*</span></label>
                <select name="status" id="status" class="input-field" required>
                    <option value="Proses" {{ old('status') == 'Proses' ? 'selected' : '' }}>Sedang Berlangsung (Proses)</option>
                    <option value="Lulus" {{ old('status') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                </select>
                @error('status')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="mt-8 pt-6 border-t border-slate-800 flex justify-end">
            <button type="submit" class="btn-primary" style="background: #ca8a04; border-color: #a16207;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                save()
            </button>
        </div>
    </form>
</div>
@endsection
