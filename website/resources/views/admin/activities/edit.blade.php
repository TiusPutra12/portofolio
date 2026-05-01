@extends('admin.layouts.admin')

@section('title', 'Edit Kegiatan')

@section('content')
<div class="animate-fade-in max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="/admin/activities" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-violet-400 transition-colors font-mono">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            cd ..
        </a>
    </div>

    <div class="admin-card p-6 sm:p-8" style="border-color: rgba(139,92,246,0.1);">
        <div class="mb-6">
            <p class="font-mono text-xs text-violet-400 mb-1">// edit_activity({{ $activity->id }})</p>
            <h2 class="text-xl font-bold text-white">Edit Kegiatan</h2>
        </div>

        <form method="POST" action="/admin/activities/{{ $activity->id }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Judul Kegiatan <span class="req">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $activity->title) }}" required
                    class="input-field focus:!border-violet-500 focus:!ring-violet-500/10" placeholder="Contoh: Menghadiri Seminar Teknologi">
                @error('title') <p class="text-red-400 text-xs mt-1.5 font-mono">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description">Deskripsi Singkat</label>
                <textarea name="description" id="description" rows="3"
                    class="input-field focus:!border-violet-500 focus:!ring-violet-500/10" placeholder="Ceritakan pengalaman singkat...">{{ old('description', $activity->description) }}</textarea>
                @error('description') <p class="text-red-400 text-xs mt-1.5 font-mono">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="date">Tanggal <span class="req">*</span></label>
                <input type="date" name="date" id="date" value="{{ old('date', optional($activity->date)->format('Y-m-d')) }}" required
                    class="input-field [color-scheme:dark] focus:!border-violet-500 focus:!ring-violet-500/10">
                @error('date') <p class="text-red-400 text-xs mt-1.5 font-mono">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image">Foto Dokumentasi (opsional)</label>
                @if($activity->image)
                    <div class="mb-3 relative rounded-lg overflow-hidden border border-slate-800 w-full sm:w-1/2 aspect-video bg-[#161b22]">
                        <img src="{{ asset('storage/' . $activity->image) }}" alt="Current image" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="relative">
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full text-slate-400 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-violet-600/20 file:text-violet-400 hover:file:bg-violet-600/30 file:transition-colors cursor-pointer border border-slate-800 rounded-lg bg-[#161b22] p-2 focus:!border-violet-500">
                </div>
                <p class="font-mono text-[10px] text-slate-500 mt-2">// biarkan kosong jika tidak ingin mengubah gambar</p>
                @error('image') <p class="text-red-400 text-xs mt-1.5 font-mono">{{ $message }}</p> @enderror
            </div>

            <div class="pt-6 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="/admin/activities" class="px-5 py-2 rounded-lg text-slate-400 hover:text-white transition-colors text-sm font-mono border border-slate-800 hover:border-slate-600 bg-[#161b22]">
                    cancel()
                </a>
                <button type="submit" class="btn-primary" style="background: #6d28d9; border-color: #5b21b6;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    update()
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
