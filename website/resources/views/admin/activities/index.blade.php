@extends('admin.layouts.admin')

@section('title', 'Kegiatan')

@section('content')
<div class="animate-fade-in max-w-6xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="font-mono text-xs text-violet-400 mb-1">// activities.all()</p>
            <h2 class="text-2xl font-black text-white">Daftar Kegiatan</h2>
        </div>
        <a href="/admin/activities/create" class="btn-primary" style="background: #6d28d9; border-color: #5b21b6;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            add_activity()
        </a>
    </div>

    @if($activities->isEmpty())
        <div class="admin-card p-16 text-center">
            <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-4 border" style="background: rgba(139,92,246,0.1); border-color: rgba(139,92,246,0.2);">
                <svg class="w-8 h-8 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <p class="text-slate-400 font-mono text-sm">// Belum ada kegiatan. Mulai tambahkan kegiatan pertama Anda!</p>
        </div>
    @else
        <div class="admin-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Judul Kegiatan</th>
                            <th class="hidden sm:table-cell">Deskripsi Singkat</th>
                            <th class="hidden sm:table-cell">Tanggal</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        @if($activity->image)
                                            <div class="w-10 h-10 rounded bg-[#161b22] border border-slate-800 overflow-hidden shrink-0 hidden sm:block">
                                                <img src="{{ asset('storage/' . $activity->image) }}" class="w-full h-full object-cover">
                                            </div>
                                        @endif
                                        <div>
                                            <span class="font-medium text-white block">{{ $activity->title }}</span>
                                            <span class="text-xs text-slate-500 sm:hidden block mt-0.5">{{ optional($activity->date)->format('d M Y') ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden sm:table-cell">
                                    {{ $activity->description ? Str::limit($activity->description, 50) : '-' }}
                                </td>
                                <td class="hidden sm:table-cell font-mono text-xs">{{ optional($activity->date)->format('d M Y') ?? '-' }}</td>
                                <td>
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="/admin/activities/{{ $activity->id }}/edit" class="p-2 rounded-lg text-slate-400 hover:text-violet-400 hover:bg-violet-900/20 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="/admin/activities/{{ $activity->id }}" onsubmit="return confirm('Hapus kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-900/20 transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
