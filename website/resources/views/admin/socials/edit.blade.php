@extends('admin.layouts.admin')

@section('title', 'Edit Social Media')

@section('content')
<div class="animate-fade-in max-w-2xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <p class="font-mono text-xs text-green-400 mb-1">// socials.json</p>
            <h2 class="text-2xl font-black text-white">Edit Social Media Links</h2>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-mono text-slate-400 hover:text-white transition-colors border border-slate-800 hover:border-slate-600 rounded-lg bg-[#161b22]">
            return_to_dashboard()
        </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.socials.update') }}" method="POST" class="admin-card p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- WhatsApp --}}
            <div>
                <label for="whatsapp">WhatsApp <span class="text-xs text-slate-500 font-mono ml-1">// 628xxx</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500 font-mono text-sm">+</span>
                    <input type="text" name="whatsapp" id="whatsapp" class="input-field font-mono !pl-6" 
                        value="{{ old('whatsapp', $socials['whatsapp'] ?? '') }}" placeholder="628123456789">
                </div>
                @error('whatsapp')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="input-field font-mono" 
                    value="{{ old('email', $socials['email'] ?? '') }}" placeholder="nama@email.com">
                @error('email')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- GitHub --}}
            <div>
                <label for="github">GitHub</label>
                <input type="text" name="github" id="github" class="input-field font-mono" 
                    value="{{ old('github', $socials['github'] ?? '') }}" placeholder="github.com/username">
                @error('github')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- LinkedIn --}}
            <div>
                <label for="linkedin">LinkedIn</label>
                <input type="text" name="linkedin" id="linkedin" class="input-field font-mono" 
                    value="{{ old('linkedin', $socials['linkedin'] ?? '') }}" placeholder="linkedin.com/in/username">
                @error('linkedin')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- Instagram --}}
            <div>
                <label for="instagram">Instagram</label>
                <input type="text" name="instagram" id="instagram" class="input-field font-mono" 
                    value="{{ old('instagram', $socials['instagram'] ?? '') }}" placeholder="instagram.com/username">
                @error('instagram')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- Facebook --}}
            <div>
                <label for="facebook">Facebook</label>
                <input type="text" name="facebook" id="facebook" class="input-field font-mono" 
                    value="{{ old('facebook', $socials['facebook'] ?? '') }}" placeholder="facebook.com/username">
                @error('facebook')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-800 flex items-center justify-end">
            <button type="submit" class="btn-primary" style="background: #10b981; border-color: #059669;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                save_socials()
            </button>
        </div>
    </form>
</div>
@endsection
