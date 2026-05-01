@extends('admin.layouts.admin')

@section('title', 'Pendidikan')

@section('content')
<div class="animate-fade-in max-w-6xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="font-mono text-xs text-yellow-400 mb-1">// education.all()</p>
            <h2 class="text-2xl font-black text-white">Riwayat Pendidikan</h2>
        </div>
        <a href="/admin/education/create" class="btn-primary" style="background: #ca8a04; border-color: #a16207;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            add_education()
        </a>
    </div>

    @if($educations->isEmpty())
        <div class="admin-card p-16 text-center">
            <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-4 border" style="background: rgba(202,138,4,0.1); border-color: rgba(202,138,4,0.2);">
                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
            </div>
            <p class="text-slate-400 font-mono text-sm">// Belum ada riwayat pendidikan.</p>
        </div>
    @else
        <div class="admin-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Institusi</th>
                            <th>Gelar/Jurusan</th>
                            <th class="hidden sm:table-cell">Status</th>
                            <th class="hidden sm:table-cell">Tahun</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($educations as $edu)
                            <tr>
                                <td>
                                    <span class="font-medium text-white block">{{ $edu->institution }}</span>
                                    <span class="text-xs text-slate-500 sm:hidden block mt-0.5">{{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}</span>
                                    
                                    {{-- Sub Education (Internships) --}}
                                    @if($edu->subs->isNotEmpty())
                                        <div class="mt-2 space-y-1.5 pl-4 border-l border-slate-800">
                                            @foreach($edu->subs as $sub)
                                                <div class="group/sub flex items-center justify-between gap-4">
                                                    <div class="text-[10px]">
                                                        <span class="text-yellow-400/80 font-bold uppercase tracking-tighter mr-1">[SUB]</span>
                                                        <span class="text-slate-300 font-medium">{{ $sub->institution }}</span>
                                                        <span class="text-slate-500 ml-1">({{ $sub->start_date?->format('d M Y') }} - {{ $sub->end_date?->format('d M Y') ?? 'Sekarang' }})</span>
                                                        <span class="ml-2 px-1.5 py-0.5 rounded {{ $sub->status == 'Lulus' ? 'bg-blue-500/10 text-blue-400 border-blue-500/20' : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' }} border opacity-70 text-[8px]">{{ $sub->status }}</span>
                                                        @if($sub->supervisor)
                                                            <span class="text-slate-500 italic ml-2">P: {{ $sub->supervisor }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="flex items-center gap-1 opacity-0 group-hover/sub:opacity-100 transition-opacity">
                                                        <a href="{{ route('admin.education.subs.edit', $sub) }}" class="text-slate-500 hover:text-yellow-400">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.education.subs.destroy', $sub) }}" onsubmit="return confirm('Hapus sub ini?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="text-slate-500 hover:text-red-400">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $edu->degree }}</td>
                                <td class="hidden sm:table-cell text-xs">
                                    @if($edu->status)
                                        <span class="px-2 py-1 rounded {{ $edu->status == 'Lulus' ? 'bg-blue-900/20 text-blue-400 border-blue-700/30' : 'bg-yellow-900/20 text-yellow-400 border-yellow-700/30' }} border">{{ $edu->status }}</span>
                                    @else
                                        <span class="text-slate-600">-</span>
                                    @endif
                                </td>
                                <td class="hidden sm:table-cell font-mono text-xs">{{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}</td>
                                <td>
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.education.subs.create', $edu) }}" class="p-2 rounded-lg text-slate-400 hover:text-green-400 hover:bg-green-900/20 transition-colors" title="Tambah Sub (Magang/Lainnya)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        </a>
                                        <a href="/admin/education/{{ $edu->id }}/edit" class="p-2 rounded-lg text-slate-400 hover:text-yellow-400 hover:bg-yellow-900/20 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="/admin/education/{{ $edu->id }}" onsubmit="return confirm('Hapus pendidikan ini?')">
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
