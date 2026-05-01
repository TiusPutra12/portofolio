@extends('admin.layouts.admin')

@section('title', 'Edit Skill')

@section('content')
<div class="animate-fade-in max-w-2xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <p class="font-mono text-xs text-neon-400 mb-1">// cat skill.json</p>
            <h2 class="text-2xl font-black text-white">Edit Skill</h2>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-mono text-slate-400 hover:text-white transition-colors border border-slate-800 hover:border-slate-600 rounded-lg bg-[#161b22]">
            return_to_dashboard()
        </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.tech_stack.update') }}" method="POST" class="admin-card p-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="tech_stack">Skill (pisahkan dengan koma) <span class="req">*</span></label>
                <textarea name="tech_stack" id="tech_stack" rows="6" class="input-field font-mono" 
                    placeholder="PHP, Laravel, React, Tailwind CSS" required>{{ old('tech_stack', $techStackString) }}</textarea>
                <p class="font-mono text-[10px] text-slate-500 mt-2">// contoh format: PHP, Laravel, MySQL, Git</p>
                @error('tech_stack')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-800 flex items-center justify-end">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                save_skill()
            </button>
        </div>
    </form>
</div>
@endsection
