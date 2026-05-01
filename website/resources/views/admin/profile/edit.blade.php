@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Edit Profil</h2>
            <p class="text-slate-500 font-mono text-xs mt-1">/ root / user / profile_settings.json</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg bg-slate-800 text-slate-300 font-mono text-sm hover:bg-slate-700 transition-all">
            &lt; back_to_dash()
        </a>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" class="max-w-4xl bg-[#0d1117] border border-slate-800 rounded-xl p-8 shadow-xl">
        @csrf
        @method('PUT')

        <div class="space-y-8">
            <div class="grid grid-cols-1 gap-6">
                {{-- Name --}}
                <div>
                    <label for="name">Nama Portfolio <span class="req">*</span></label>
                    <input type="text" name="name" id="name" class="input-field font-mono" 
                        value="{{ old('name', $profile['name'] ?? '') }}" required placeholder="Nama Anda">
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Terminal Info Section --}}
            <div class="mt-8 pt-8 border-t border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider">Terminal JSON Data</h3>
                        <p class="text-[10px] text-slate-500 font-mono mt-1">// isi sesuka hati: Role, Alamat, Kelas, Status, dsb</p>
                    </div>
                    <button type="button" onclick="addInfoRow()" class="px-3 py-1.5 rounded-md bg-primary-500/10 text-primary-400 border border-primary-500/20 text-[10px] font-mono hover:bg-primary-500/20 transition-all">
                        + add_field()
                    </button>
                </div>

                <div id="additional-info-container" class="space-y-3">
                    @php
                        $terminalData = $profile['additional_info'] ?? [];
                        // Migration fallback: if it's the first time and we have old data
                        if (empty($terminalData) && isset($profile['role'])) {
                            $terminalData[] = ['label' => 'role', 'value' => $profile['role']];
                            if (isset($profile['address'])) {
                                $terminalData[] = ['label' => 'address', 'value' => $profile['address']];
                            }
                        }
                    @endphp
                    @forelse($terminalData as $index => $info)
                        <div class="flex gap-3 animate-fade-in info-row">
                            <div class="flex-1">
                                <input type="text" name="additional_labels[]" class="input-field text-xs font-mono" value="{{ $info['label'] }}" placeholder="Key (ex: role)">
                            </div>
                            <div class="flex-1">
                                <input type="text" name="additional_values[]" class="input-field text-xs font-mono text-yellow-300" value="{{ $info['value'] }}" placeholder="Value (ex: Developer)">
                            </div>
                            <button type="button" onclick="removeInfoRow(this)" class="p-2 text-red-400 hover:text-red-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    @empty
                        <p id="no-info-msg" class="text-center py-4 border border-dashed border-slate-800 rounded-lg text-slate-600 text-[10px] font-mono italic">
                            // Klik + add_field() untuk mulai mengisi data terminal
                        </p>
                    @endforelse
                </div>
            </div>

            {{-- About Me --}}
            <div>
                <label for="about_me">Tentang Saya <span class="text-xs text-slate-500 font-mono ml-1">// about_me</span></label>
                <textarea name="about_me" id="about_me" rows="4" class="input-field" 
                    placeholder="Ceritakan tentang diri Anda...">{{ old('about_me', $profile['about_me'] ?? '') }}</textarea>
                @error('about_me')
                    <p class="mt-1.5 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- Open To Work --}}
            <div class="flex items-center gap-3 bg-[#161b22] border border-slate-800 p-4 rounded-lg">
                <input type="checkbox" name="open_to_work" id="open_to_work" value="1" 
                    class="w-4 h-4 text-primary-600 rounded border-slate-700 bg-slate-900 focus:ring-primary-600 focus:ring-offset-slate-900"
                    {{ old('open_to_work', $profile['open_to_work'] ?? false) ? 'checked' : '' }}>
                <label for="open_to_work" class="!mb-0 !text-sm cursor-pointer">Open to work? <span class="text-xs text-slate-500 font-mono ml-2">// sets true/false in json</span></label>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-800 flex items-center justify-end">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                save_profile()
            </button>
        </div>
    </form>
</div>

<script>
    function addInfoRow() {
        const container = document.getElementById('additional-info-container');
        const noMsg = document.getElementById('no-info-msg');
        if (noMsg) noMsg.remove();

        const div = document.createElement('div');
        div.className = 'flex gap-3 animate-fade-in info-row';
        div.innerHTML = `
            <div class="flex-1">
                <input type="text" name="additional_labels[]" class="input-field text-xs font-mono" placeholder="Key (ex: kelas)">
            </div>
            <div class="flex-1">
                <input type="text" name="additional_values[]" class="input-field text-xs font-mono text-yellow-300" placeholder="Value (ex: XII RPL)">
            </div>
            <button type="button" onclick="removeInfoRow(this)" class="p-2 text-red-400 hover:text-red-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        `;
        container.appendChild(div);
    }

    function removeInfoRow(btn) {
        btn.closest('.info-row').remove();
        const container = document.getElementById('additional-info-container');
        if (container.children.length === 0) {
            container.innerHTML = `<p id="no-info-msg" class="text-center py-4 border border-dashed border-slate-800 rounded-lg text-slate-600 text-[10px] font-mono italic">// Klik + add_field() untuk mulai mengisi data terminal</p>`;
        }
    }
</script>
@endsection
