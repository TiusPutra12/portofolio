@extends('admin.layouts.admin')

@section('title', 'Proyek')

@section('content')
<div class="animate-fade-in max-w-6xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="font-mono text-xs text-neon-400 mb-1">// projects.all()</p>
            <h2 class="text-2xl font-black text-white">Daftar Proyek</h2>
        </div>
        <a href="/admin/projects/create" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            add_project()
        </a>
    </div>

    @if($projects->isEmpty())
        <div class="admin-card p-16 text-center">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-neon-500/10 flex items-center justify-center mb-4 border border-neon-500/20">
                <svg class="w-8 h-8 text-neon-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            </div>
            <p class="text-slate-400 font-mono text-sm">// Belum ada proyek. Mulai tambahkan proyek pertama Anda!</p>
        </div>
    @else
        <div class="admin-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th class="hidden sm:table-cell">Deskripsi</th>
                            <th class="hidden sm:table-cell">Tanggal</th>
                            <th class="hidden md:table-cell">Link</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>
                                    <span class="font-medium text-white">{{ $project->title }}</span>
                                    <span class="block text-xs text-slate-500 sm:hidden">{{ $project->date->format('d/m/Y') }}</span>
                                </td>
                                <td class="hidden sm:table-cell">
                                    {{ $project->description ? Str::limit($project->description, 50) : '-' }}
                                </td>
                                <td class="hidden sm:table-cell font-mono text-xs">{{ $project->date->format('d M Y') }}</td>
                                <td class="hidden md:table-cell">
                                    @if($project->url)
                                        <a href="{{ $project->url }}" target="_blank" class="text-neon-400 hover:text-neon-300 hover:underline font-mono text-xs">Buka</a>
                                    @else
                                        <span class="text-slate-600 font-mono text-xs">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="/admin/projects/{{ $project->id }}/edit" class="p-2 rounded-lg text-slate-400 hover:text-primary-400 hover:bg-primary-900/20 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="/admin/projects/{{ $project->id }}" onsubmit="return confirm('Hapus proyek ini?')">
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
