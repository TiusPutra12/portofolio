@extends('admin.layouts.admin')

@section('title', 'Edit Sub-Pendidikan')

@section('content')
<div class="animate-fade-in max-w-2xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <p class="font-mono text-xs text-yellow-400 mb-1">// education.edit_sub({{ $sub->id }})</p>
            <h2 class="text-2xl font-black text-white">Edit Sub-Pendidikan</h2>
            <p class="text-xs text-slate-500 mt-1">Institusi Utama: <span class="text-slate-300">{{ $sub->education->institution }}</span></p>
        </div>
        <a href="{{ route('admin.education.index') }}" class="px-4 py-2 text-sm font-mono text-slate-400 hover:text-white transition-colors border border-slate-800 hover:border-slate-600 rounded-lg bg-[#161b22]">
            return_to_list()
        </a>
    </div>

    <form action="{{ route('admin.education.subs.update', $sub) }}" method="POST" class="admin-card p-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="institution">Nama Institusi / Tempat Magang <span class="req">*</span></label>
                <input type="text" name="institution" id="institution" class="input-field" value="{{ old('institution', $sub->institution) }}" required placeholder="Contoh: PT. Teknologi Maju">
                @error('institution')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="start_date">Tanggal Mulai <span class="req">*</span></label>
                    <input type="date" name="start_date" id="start_date" class="input-field font-mono text-sm" value="{{ old('start_date', $sub->start_date?->format('Y-m-d')) }}" required>
                    @error('start_date')
                        <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="end_date">Tanggal Selesai <span class="text-xs text-slate-500 font-mono ml-1">// opsional</span></label>
                    <input type="date" name="end_date" id="end_date" class="input-field font-mono text-sm" value="{{ old('end_date', $sub->end_date?->format('Y-m-d')) }}">
                    @error('end_date')
                        <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="supervisor">Pembimbing / Supervisor</label>
                <input type="text" name="supervisor" id="supervisor" class="input-field" value="{{ old('supervisor', $sub->supervisor) }}" placeholder="Contoh: Bapak Ahmad">
                @error('supervisor')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status">Status <span class="req">*</span></label>
                <select name="status" id="status" class="input-field" required>
                    <option value="Proses" {{ old('status', $sub->status) == 'Proses' ? 'selected' : '' }}>Sedang Berlangsung (Proses)</option>
                    <option value="Lulus" {{ old('status', $sub->status) == 'Lulus' ? 'selected' : '' }}>Selesai / Lulus</option>
                </select>
                @error('status')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description">Deskripsi Kegiatan</label>
                <textarea name="description" id="description" rows="4" class="input-field" placeholder="Jelaskan apa yang Anda lakukan selama di sini...">{{ old('description', $sub->description) }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-800 flex justify-end">
            <button type="submit" class="btn-primary" style="background: #ca8a04; border-color: #a16207;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                save_sub_changes()
            </button>
        </div>
    </form>
</div>
@endsection
