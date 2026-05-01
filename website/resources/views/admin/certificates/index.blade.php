@extends('admin.layouts.admin')

@section('title', 'Sertifikat')

@section('content')
<div class="animate-fade-in max-w-6xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="font-mono text-xs text-primary-400 mb-1">// certificates.all()</p>
            <h2 class="text-2xl font-black text-white">Daftar Sertifikat</h2>
        </div>
        <a href="/admin/certificates/create" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            add_certificate()
        </a>
    </div>

    @if($certificates->isEmpty())
        <div class="admin-card p-16 text-center">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-primary-600/10 flex items-center justify-center mb-4 border border-primary-600/20">
                <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <p class="text-slate-400 font-mono text-sm">// Belum ada sertifikat. Mulai tambahkan sertifikat pertama Anda!</p>
        </div>
    @else
        <div class="admin-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Sertifikat</th>
                            <th class="hidden sm:table-cell">Penerbit</th>
                            <th class="hidden sm:table-cell">Tanggal</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certificates as $cert)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        @if($cert->image)
                                            <div class="w-10 h-10 rounded bg-[#161b22] border border-slate-800 overflow-hidden shrink-0 hidden sm:block">
                                                <img src="{{ asset('storage/' . $cert->image) }}" class="w-full h-full object-cover">
                                            </div>
                                        @endif
                                        <div>
                                            <span class="font-medium text-white block">{{ $cert->title }}</span>
                                            <span class="text-xs text-slate-500 sm:hidden block mt-0.5">{{ $cert->issuer ?? '-' }} &bull; {{ $cert->date->format('M Y') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden sm:table-cell">
                                    {{ $cert->issuer ?? '-' }}
                                </td>
                                <td class="hidden sm:table-cell font-mono text-xs">{{ $cert->date->format('d M Y') }}</td>
                                <td>
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="/admin/certificates/{{ $cert->id }}/edit" class="p-2 rounded-lg text-slate-400 hover:text-primary-400 hover:bg-primary-900/20 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="/admin/certificates/{{ $cert->id }}" onsubmit="return confirm('Hapus sertifikat ini?')">
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
