@extends('admin.layouts.admin')

@section('title', 'dashboard')

@section('content')
<div class="animate-fade-in space-y-8">

    {{-- Welcome Banner --}}
    <div class="admin-card p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-primary-600/5 rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="font-mono text-xs text-primary-400 mb-1">// welcome back</p>
                <h2 class="text-2xl font-black text-white">Admin Dashboard</h2>
                <p class="text-slate-500 text-sm mt-1">Kelola portfolio Anda dari satu tempat.</p>
            </div>
            <div class="font-mono text-xs text-slate-700 bg-[#161b22] border border-slate-800 rounded-lg px-4 py-3 shrink-0">
                <span class="text-neon-400">$ </span><span class="text-slate-400">date</span><br>
                <span class="text-slate-500">{{ now()->format('D, d M Y — H:i') }} WIB</span>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        {{-- Certificates --}}
        <a href="/admin/certificates" class="admin-card p-6 group hover:-translate-y-1 transition-transform duration-300 cursor-pointer">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-primary-600/15 border border-primary-600/25 flex items-center justify-center group-hover:shadow-[0_0_16px_rgba(6,182,212,0.2)] transition-shadow">
                    <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <svg class="w-4 h-4 text-slate-700 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
            <div class="font-mono text-4xl font-black text-white mb-1">{{ $stats['certificates'] }}</div>
            <div class="font-mono text-xs text-slate-600 uppercase tracking-widest">certificates.length</div>
        </a>

        {{-- Activities --}}
        <a href="/admin/activities" class="admin-card p-6 group hover:-translate-y-1 transition-transform duration-300 cursor-pointer" style="border-color: rgba(139,92,246,0.15);">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-shadow" style="background: rgba(139,92,246,0.12); border: 1px solid rgba(139,92,246,0.25);">
                    <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <svg class="w-4 h-4 text-slate-700 group-hover:text-violet-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
            <div class="font-mono text-4xl font-black text-white mb-1">{{ $stats['activities'] }}</div>
            <div class="font-mono text-xs text-slate-600 uppercase tracking-widest">activities.size()</div>
        </a>

        {{-- Projects --}}
        <a href="/admin/projects" class="admin-card p-6 group hover:-translate-y-1 transition-transform duration-300 cursor-pointer" style="border-color: rgba(34,197,94,0.12);">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-shadow" style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2);">
                    <svg class="w-5 h-5 text-neon-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </div>
                <svg class="w-4 h-4 text-slate-700 group-hover:text-neon-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
            <div class="font-mono text-4xl font-black text-white mb-1">{{ $stats['projects'] }}</div>
            <div class="font-mono text-xs text-slate-600 uppercase tracking-widest">projects.count()</div>
        </a>
    </div>

    {{-- Quick Actions --}}
    <div class="admin-card p-6">
        <p class="font-mono text-xs text-slate-600 uppercase tracking-widest mb-4">// quick_actions</p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <a href="/admin/certificates/create"
                class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-primary-600/10 border border-primary-600/20 text-primary-300 hover:bg-primary-600/15 hover:border-primary-500/40 hover:text-primary-200 transition-all group">
                <div class="w-7 h-7 rounded-lg bg-primary-600/20 flex items-center justify-center shrink-0 group-hover:shadow-[0_0_10px_rgba(6,182,212,0.3)] transition-shadow">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <span class="font-mono text-xs font-semibold">add_certificate()</span>
            </a>
            <a href="/admin/activities/create"
                class="flex items-center gap-3 px-4 py-3.5 rounded-xl border text-violet-300 hover:text-violet-200 transition-all group"
                style="background: rgba(139,92,246,0.08); border-color: rgba(139,92,246,0.2);">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 transition-shadow" style="background: rgba(139,92,246,0.15);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <span class="font-mono text-xs font-semibold">add_activity()</span>
            </a>
            <a href="/admin/projects/create"
                class="flex items-center gap-3 px-4 py-3.5 rounded-xl border text-neon-300 hover:text-neon-200 transition-all group"
                style="background: rgba(34,197,94,0.07); border-color: rgba(34,197,94,0.18);">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0" style="background: rgba(34,197,94,0.12);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <span class="font-mono text-xs font-semibold">add_project()</span>
            </a>
        </div>
    </div>

</div>
@endsection
