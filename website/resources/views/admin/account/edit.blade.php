@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Edit Akun</h2>
            <p class="text-slate-500 font-mono text-xs mt-1">/ root / user / account_settings.db</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg bg-slate-800 text-slate-300 font-mono text-sm hover:bg-slate-700 transition-all">
            &lt; back_to_dash()
        </a>
    </div>

    <form action="{{ route('admin.account.update') }}" method="POST" class="max-w-2xl bg-[#0d1117] border border-slate-800 rounded-xl p-8 shadow-xl">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            {{-- Name --}}
            <div>
                <label for="name">Nama Lengkap <span class="req">*</span></label>
                <input type="text" name="name" id="name" class="input-field font-mono" 
                    value="{{ old('name', $user->name) }}" required placeholder="Nama Administrator">
                @error('name')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email">Email Address <span class="req">*</span></label>
                <input type="email" name="email" id="email" class="input-field font-mono" 
                    value="{{ old('email', $user->email) }}" required placeholder="admin@example.com">
                @error('email')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6 mt-6 border-t border-slate-800">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">// ganti password (opsional)</h3>
                
                <div class="space-y-4">
                    {{-- Password --}}
                    <div>
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" class="input-field font-mono" 
                            placeholder="••••••••">
                        <p class="mt-1 text-[10px] text-slate-600 font-mono">// Kosongkan jika tidak ingin mengubah password</p>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Confirmation --}}
                    <div>
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="input-field font-mono" 
                            placeholder="••••••••">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-800 flex items-center justify-end">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                update_account()
            </button>
        </div>
    </form>
</div>
@endsection
