@extends('layouts.app')

@section('content')

    {{-- ═══════════════════════════════ HERO ═══════════════════════════════ --}}
    <section class="relative min-h-[100svh] flex items-center overflow-hidden bg-[#0a0e1a]">

        {{-- Matrix Rain Canvas (background) --}}
        <canvas id="matrix-canvas" class="absolute inset-0 w-full h-full opacity-100 pointer-events-none z-0"></canvas>

        {{-- Grid overlay --}}
        <div class="absolute inset-0 grid-pattern pointer-events-none z-0"></div>

        {{-- Radial glow spots --}}
        <div
            class="absolute top-1/4 left-1/3 w-[500px] h-[500px] bg-primary-600/10 rounded-full blur-[120px] pointer-events-none z-0">
        </div>
        <div
            class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] bg-violet-600/10 rounded-full blur-[100px] pointer-events-none z-0">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 w-full py-28 sm:py-36">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- ── Left: Text ── --}}
                <div>
                    {{-- Status badge --}}
                    <div
                        class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full border text-xs font-mono font-semibold mb-6 animate-fade-in {{ !empty($profile['open_to_work']) ? 'bg-neon-500/10 border-neon-500/30 text-neon-400' : 'bg-red-500/10 border-red-500/30 text-red-400' }}">
                        <span class="relative flex h-2 w-2">
                            @if (!empty($profile['open_to_work']))
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-neon-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-neon-500"></span>
                            @else
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                            @endif
                        </span>
                        $ status — open_to_work: {{ !empty($profile['open_to_work']) ? 'true' : 'false' }}
                    </div>

                    {{-- Greeting --}}
                    <p class="font-mono text-primary-400 text-sm font-medium mb-3 animate-fade-in delay-100">
                        <span class="text-slate-500">// </span>Hello, World!
                    </p>

                    {{-- Name --}}
                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-[1.1] tracking-tight mb-4 animate-fade-in delay-200">
                        Saya seorang <br>
                        <span id="typing-text"
                            class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 via-violet-400 to-neon-400 typing-cursor"></span>
                    </h1>

                    {{-- Description --}}
                    <p class="text-base sm:text-lg text-slate-400 leading-relaxed max-w-lg mb-8 animate-fade-in delay-300">
                        Membangun aplikasi web yang cepat, terukur, dan indah.
                        Sangat antusias dengan penulisan kode yang bersih dan pengalaman pengguna yang luar biasa.
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-wrap gap-4 animate-fade-in delay-400">
                        <a href="#projects"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-primary-500 text-white font-mono font-semibold text-sm hover:bg-primary-400 transition-all duration-300 hover:shadow-[0_0_20px_rgba(6,182,212,0.5)] hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            view_projects()
                        </a>
                        <a href="#about"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-primary-700/60 text-primary-300 font-mono font-semibold text-sm hover:border-primary-400 hover:text-primary-100 hover:bg-primary-900/30 transition-all duration-300 hover:-translate-y-0.5">
                            baca_selengkapnya();
                        </a>
                    </div>
                </div>

                {{-- ── Right: Terminal Window ── --}}
                <div class="animate-fade-in delay-300 w-full max-w-sm mx-auto lg:max-w-none mt-8 lg:mt-0">
                    <div class="terminal-window" style="animation: float 6s ease-in-out infinite;">
                        <div class="terminal-bar">
                            <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-500/80"></span>
                            <span class="w-3 h-3 rounded-full bg-neon-500/80"></span>
                        </div>
                        <div class="p-4 sm:p-6 font-mono text-xs sm:text-sm space-y-1.5 overflow-x-auto">
                            <p><span class="text-neon-400">❯</span> <span class="text-slate-300">Get-Content
                                    profile.json</span></p>
                            <p class="text-slate-600">{</p>

                            <p class="pl-4"><span class="text-violet-400">"name"</span><span class="text-slate-500">:
                                </span><span
                                    class="text-yellow-300">"{{ $profile['name'] ?? 'Timotius March Saputra' }}"</span><span
                                    class="text-slate-600">,</span></p>

                            <p class="pl-4"><span class="text-violet-400">"role"</span><span class="text-slate-500">:
                                </span><span class="text-yellow-300">"{{ $profile['role'] ?? 'Mahasiswa' }}"</span><span
                                    class="text-slate-600">{{ !empty($profile['address']) || !empty($profile['additional_info']) ? ',' : '' }}</span>
                            </p>

                            @if (!empty($profile['address']))
                                <p class="pl-4"><span class="text-violet-400">"address"</span><span
                                        class="text-slate-500">: </span><span
                                        class="text-yellow-300">"{{ $profile['address'] }}"</span><span
                                        class="text-slate-600">{{ !empty($profile['additional_info']) ? ',' : '' }}</span>
                                </p>
                            @endif

                            @if (!empty($profile['additional_info']))
                                @foreach ($profile['additional_info'] as $index => $info)
                                    <p class="pl-4">
                                        <span
                                            class="text-violet-400">"{{ strtolower(str_replace(' ', '_', $info['label'])) }}"</span><span
                                            class="text-slate-500">: </span>
                                        <span class="text-yellow-300">"{{ $info['value'] }}"</span>
                                        <span
                                            class="text-slate-600">{{ $index < count($profile['additional_info']) - 1 ? ',' : '' }}</span>
                                    </p>
                                @endforeach
                            @endif

                            <p class="text-slate-600">}</p>
                            <p class="mt-3"><span class="text-neon-400">❯</span> <span
                                    class="text-slate-500 typing-cursor"></span></p>
                        </div>
                    </div>

                    {{-- ── Social Media Links ── --}}
                    <div class="mt-8 flex flex-wrap items-center justify-center lg:justify-start gap-4 sm:gap-5">

                        {{-- GitHub --}}
                        @php
                            $hasGithub = !empty($socials['github']);
                            $githubUrl = $hasGithub
                                ? (Str::startsWith($socials['github'], 'http')
                                    ? $socials['github']
                                    : 'https://' . ltrim($socials['github'], '/'))
                                : '#';
                        @endphp
                        <a href="{{ $githubUrl }}" target="{{ $hasGithub ? '_blank' : '_self' }}"
                            class="transition-all duration-300 {{ $hasGithub ? 'text-slate-400 hover:text-white hover:scale-110' : 'text-slate-600 opacity-30 cursor-not-allowed pointer-events-none' }}"
                            title="{{ $hasGithub ? 'GitHub' : 'Tidak Valid' }}">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                            </svg>
                        </a>

                        {{-- Gmail --}}
                        @php
                            $hasEmail = !empty($socials['email']);
                        @endphp
                        <a href="{{ $hasEmail ? 'mailto:' . $socials['email'] : '#' }}"
                            target="{{ $hasEmail ? '_blank' : '_self' }}"
                            class="transition-all duration-300 {{ $hasEmail ? 'text-slate-400 hover:text-red-500 hover:scale-110' : 'text-slate-600 opacity-30 cursor-not-allowed pointer-events-none' }}"
                            title="{{ $hasEmail ? 'Email' : 'Tidak Valid' }}">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </a>

                        {{-- LinkedIn --}}
                        @php
                            $hasLinkedin = !empty($socials['linkedin']);
                        @endphp
                        <a href="{{ $hasLinkedin ? $socials['linkedin'] : '#' }}"
                            target="{{ $hasLinkedin ? '_blank' : '_self' }}"
                            class="transition-all duration-300 {{ $hasLinkedin ? 'text-slate-400 hover:text-blue-500 hover:scale-110' : 'text-slate-600 opacity-30 cursor-not-allowed pointer-events-none' }}"
                            title="{{ $hasLinkedin ? 'LinkedIn' : 'Tidak Valid' }}">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>

                        {{-- Instagram --}}
                        @php
                            $hasInstagram = !empty($socials['instagram']);
                        @endphp
                        <a href="{{ $hasInstagram ? $socials['instagram'] : '#' }}"
                            target="{{ $hasInstagram ? '_blank' : '_self' }}"
                            class="transition-all duration-300 {{ $hasInstagram ? 'text-slate-400 hover:text-pink-500 hover:scale-110' : 'text-slate-600 opacity-30 cursor-not-allowed pointer-events-none' }}"
                            title="{{ $hasInstagram ? 'Instagram' : 'Tidak Valid' }}">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>

                        {{-- Facebook --}}
                        @php
                            $hasFacebook = !empty($socials['facebook']);
                        @endphp
                        <a href="{{ $hasFacebook ? $socials['facebook'] : '#' }}"
                            target="{{ $hasFacebook ? '_blank' : '_self' }}"
                            class="transition-all duration-300 {{ $hasFacebook ? 'text-slate-400 hover:text-blue-600 hover:scale-110' : 'text-slate-600 opacity-30 cursor-not-allowed pointer-events-none' }}"
                            title="{{ $hasFacebook ? 'Facebook' : 'Tidak Valid' }}">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </a>

                        {{-- WhatsApp --}}
                        @php
                            $hasWhatsapp = !empty($socials['whatsapp']);
                        @endphp
                        <a href="{{ $hasWhatsapp ? 'https://wa.me/' . $socials['whatsapp'] : '#' }}"
                            target="{{ $hasWhatsapp ? '_blank' : '_self' }}"
                            class="transition-all duration-300 {{ $hasWhatsapp ? 'text-slate-400 hover:text-green-500 hover:scale-110' : 'text-slate-600 opacity-30 cursor-not-allowed pointer-events-none' }}"
                            title="{{ $hasWhatsapp ? 'WhatsApp' : 'Tidak Valid' }}">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.88-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                        </a>
                    </div>

                </div>

            </div>
        </div>

        {{-- Scroll hint --}}
        <div
            class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 opacity-40 animate-bounce z-10">
            <span class="font-mono text-[10px] text-slate-500 tracking-widest uppercase">gulir ke bawah</span>
            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    {{-- ═══════════════════════════ ABOUT / STATS ═══════════════════════════ --}}
    <section id="about" class="py-24 bg-[#0d1117] border-y border-slate-800/50 relative overflow-hidden">
        {{-- Glow background --}}
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary-600/5 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-12 scroll-reveal">
                <span class="font-mono text-xs font-bold text-primary-400 tracking-widest uppercase">/* portofolio
                    */</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Deskripsi</h2>
            </div>

            {{-- Bento Grid Container --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">

                {{-- 1. About Me (Large Cell) --}}
                <div
                    class="scroll-reveal tech-card p-6 sm:p-8 flex flex-col justify-center col-span-2 md:col-span-2 lg:col-span-2 md:row-span-2 group hover:border-primary-500/50 transition-all relative overflow-hidden">
                    <div
                        class="absolute -right-10 -bottom-10 opacity-10 group-hover:opacity-20 transition-opacity duration-500">
                        <svg class="w-64 h-64 text-primary-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div class="relative z-10">

                        <h3 class="text-2xl font-bold text-white mb-3">Tentang Saya</h3>
                        <p class="text-slate-400 leading-relaxed text-sm sm:text-base">
                            {!! nl2br(e($profile['about_me'])) !!}
                        </p>
                    </div>
                </div>

                {{-- 2. Projects Stat --}}
                <div
                    class="scroll-reveal tech-card p-6 flex flex-col items-center justify-center text-center delay-100 col-span-1 md:col-span-1 lg:col-span-1 group hover:border-primary-500/50 transition-all relative overflow-hidden">
                    <div
                        class="absolute -right-8 -bottom-8 opacity-10 group-hover:opacity-20 transition-opacity duration-500">
                        <svg class="w-32 h-32 text-primary-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div
                            class="font-mono text-5xl font-black text-white mb-2 group-hover:text-primary-400 transition-colors">
                            <span data-count="{{ $projects->count() }}">0</span>
                        </div>
                        <p class="font-mono text-xs text-primary-400 font-medium uppercase tracking-widest">Proyek</p>
                    </div>
                </div>

                {{-- 3. Certificates Stat --}}
                <div
                    class="scroll-reveal tech-card p-6 flex flex-col items-center justify-center text-center delay-200 col-span-1 md:col-span-1 lg:col-span-1 group hover:border-violet-500/50 transition-all relative overflow-hidden">
                    <div
                        class="absolute -left-8 -bottom-8 opacity-10 group-hover:opacity-20 transition-opacity duration-500">
                        <svg class="w-32 h-32 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div
                            class="font-mono text-5xl font-black text-white mb-2 group-hover:text-violet-400 transition-colors">
                            <span data-count="{{ $certificates->count() }}">0</span>
                        </div>
                        <p class="font-mono text-xs text-violet-400 font-medium uppercase tracking-widest">Sertifikat</p>
                    </div>
                </div>

                {{-- 4. Tech Stack (Wide Cell) --}}
                <div
                    class="scroll-reveal tech-card p-6 col-span-2 md:col-span-2 lg:col-span-2 flex flex-col justify-center delay-300 group hover:border-slate-500/50 transition-all relative overflow-hidden">
                    <div
                        class="absolute -right-10 top-0 opacity-5 group-hover:opacity-10 transition-opacity duration-500 pointer-events-none">
                        <svg class="w-48 h-48 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="font-mono text-xs text-primary-400 font-bold tracking-widest uppercase mb-4">//
                            skill.json</p>
                        <div class="flex flex-wrap gap-2">
                            @php
                                // Daftar kombinasi warna: Proyek (Primary), Sertifikat (Violet), Kegiatan (Neon/Amber)
                                $skillColors = [
                                    'text-primary-400 border-primary-500/40 bg-primary-500/10 hover:bg-primary-500/20 hover:border-primary-400 hover:shadow-[0_0_15px_rgba(6,182,212,0.2)]',
                                    'text-violet-400 border-violet-500/40 bg-violet-500/10 hover:bg-violet-500/20 hover:border-violet-400 hover:shadow-[0_0_15px_rgba(139,92,246,0.2)]',
                                    'text-neon-400 border-neon-500/40 bg-neon-500/10 hover:bg-neon-500/20 hover:border-neon-400 hover:shadow-[0_0_15px_rgba(59,130,246,0.2)]',
                                    'text-amber-400 border-amber-500/40 bg-amber-500/10 hover:bg-amber-500/20 hover:border-amber-400 hover:shadow-[0_0_15px_rgba(245,158,11,0.2)]',
                                    'text-green-400 border-green-500/40 bg-green-500/10 hover:bg-green-500/20 hover:border-green-400 hover:shadow-[0_0_15px_rgba(16,185,129,0.2)]',
                                ];
                            @endphp

                            @foreach ($techStack as $tech)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-lg border font-mono text-[11px] sm:text-xs transition-all duration-300 cursor-default {{ $skillColors[$loop->index % count($skillColors)] }}">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- 5. Activities Stat --}}
                <div
                    class="scroll-reveal tech-card p-6 flex flex-col items-center justify-center text-center delay-100 col-span-2 md:col-span-1 lg:col-span-1 group hover:border-neon-500/50 transition-all relative overflow-hidden">
                    <div
                        class="absolute -right-8 -bottom-8 opacity-10 group-hover:opacity-20 transition-opacity duration-500">
                        <svg class="w-32 h-32 text-neon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div
                            class="font-mono text-5xl font-black text-white mb-2 group-hover:text-neon-400 transition-colors">
                            <span data-count="{{ $activities->count() }}">0</span>
                        </div>
                        <p class="font-mono text-xs text-neon-400 font-medium uppercase tracking-widest">Kegiatan</p>
                    </div>
                </div>

                {{-- 6. Location / Status --}}
                <div
                    class="scroll-reveal tech-card p-6 flex flex-col justify-center col-span-2 md:col-span-1 lg:col-span-1 group hover:border-green-500/50 transition-all relative overflow-hidden delay-200">
                    <div
                        class="absolute -right-8 -bottom-8 opacity-10 group-hover:opacity-20 transition-opacity duration-500 pointer-events-none">
                        <svg class="w-32 h-32 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="relative z-10 flex items-start gap-4">
                        <div class="mt-1">
                            <span class="relative flex h-3 w-3">
                                @if (!empty($profile['open_to_work']))
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                @else
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white mb-1">Status</h4>
                            <p class="text-xs text-slate-400 leading-relaxed font-mono">
                                @if (!empty($profile['open_to_work']))
                                    Tersedia untuk peluang kerja & kolaborasi baru.
                                @else
                                    Saat ini tidak tersedia untuk peluang baru.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ═══════════════════════════ PROJECTS ═══════════════════════════ --}}
    <section id="projects" class="py-24 bg-[#0a0e1a]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12 scroll-reveal">
                <span class="font-mono text-xs text-primary-400 font-bold tracking-widest uppercase">/* Proyek */</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Project Yang Telah Di Buat</h2>
            </div>

            @if ($projects->isEmpty())
                <div class="scroll-reveal tech-card p-16 text-center border-dashed">
                    <p class="font-mono text-slate-600 text-sm">// Belum Ada Data</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6" id="projects-grid">
                    @foreach ($projects as $i => $project)
                        <div class="project-item scroll-reveal tech-card flex flex-col delay-{{ ($i % 3) * 100 }} group hover:border-primary-500/50 hover:shadow-[0_0_30px_rgba(6,182,212,0.15)] transition-all duration-300 {{ $i >= 6 ? 'hidden' : '' }}"
                            data-index="{{ $i }}">
                            {{-- Image / Placeholder --}}
                            <div class="aspect-video relative overflow-hidden bg-[#161b22] border-b border-primary-900/30">
                                @if ($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                        class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-700 group-hover:scale-110 cursor-pointer viewable-image">
                                @else
                                    <div
                                        class="absolute inset-0 flex flex-col items-center justify-center gap-2 font-mono text-xs text-slate-700">
                                        <svg class="w-8 h-8 text-slate-800" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                        </svg>
                                        <span>// no_preview.png</span>
                                    </div>
                                @endif
                                <div
                                    class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-black/70 backdrop-blur-sm border border-primary-900/50 text-primary-400 font-mono text-[8px] sm:text-[10px] font-bold px-1.5 py-0.5 sm:px-2.5 sm:py-1 rounded-md z-10">
                                    {{ $project->date->format('M Y') }}
                                </div>
                            </div>

                            <div class="p-3 sm:p-5 flex-1 flex flex-col">
                                <h3
                                    class="font-bold text-white text-sm sm:text-base mb-1.5 sm:mb-2 group-hover:text-primary-400 transition-colors">
                                    {{ $project->title }}</h3>
                                <p
                                    class="text-slate-500 text-[10px] sm:text-xs leading-relaxed flex-1 line-clamp-2 sm:line-clamp-3 font-mono">
                                    {{ $project->description ?? '// Tidak ada deskripsi' }}</p>

                                @if ($project->url)
                                    <a href="{{ $project->url }}" target="_blank"
                                        class="inline-flex items-center gap-1 mt-2 sm:mt-4 text-[10px] sm:text-xs font-mono font-bold text-primary-400 hover:text-primary-300 hover:underline transition-colors">
                                        $ Buka Link
                                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($projects->count() > 6)
                    <div class="text-center mt-10">
                        <button id="load-more-projects"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-primary-700/50 text-primary-400 font-mono text-sm hover:border-primary-400 hover:bg-primary-900/20 transition-all duration-300"
                            data-shown="6" data-total="{{ $projects->count() }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            tampilkan_lebih()
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </section>

    {{-- ═══════════════════════════ CERTIFICATES ═══════════════════════════ --}}
    <section id="certificates" class="py-24 bg-[#0d1117] border-y border-slate-800/50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 scroll-reveal">
                <span class="font-mono text-xs text-primary-400 font-bold tracking-widest uppercase">/* Sertifikat
                    */</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Sertifikat & Pencapaian</h2>
            </div>

            @if ($certificates->isEmpty())
                <div class="scroll-reveal tech-card p-16 text-center">
                    <p class="font-mono text-slate-600 text-sm">// Belum Ada Data</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6" id="certs-grid">
                    @foreach ($certificates as $i => $cert)
                        <div class="cert-item scroll-reveal tech-card group delay-{{ ($i % 3) * 100 }} hover:border-violet-500/50 hover:shadow-[0_0_30px_rgba(139,92,246,0.15)] transition-all duration-300 {{ $i >= 6 ? 'hidden' : '' }}"
                            data-index="{{ $i }}">
                            <div class="aspect-[4/3] relative overflow-hidden bg-[#161b22]">
                                <img src="{{ asset('storage/' . $cert->image) }}" alt="{{ $cert->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-70 group-hover:opacity-100 cursor-pointer viewable-image">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#0d1117] via-[#0d1117]/80 to-transparent opacity-90 group-hover:opacity-50 transition-opacity duration-500 pointer-events-none">
                                </div>

                                {{-- Nama Penerbit dipindah ke atas pojok kiri gambar --}}
                                @if ($cert->issuer)
                                    <div
                                        class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-[#0a0e1a]/80 backdrop-blur-sm border border-primary-900/50 text-primary-400 font-mono text-[8px] sm:text-[10px] font-semibold px-2 py-1 rounded-md z-10">
                                        {{ $cert->issuer }}
                                    </div>
                                @endif
                            </div>
                            <div class="p-3 sm:p-5 border-t border-slate-800/50">
                                <h3
                                    class="font-bold text-white text-xs sm:text-base line-clamp-1 group-hover:text-primary-400 transition-colors">
                                    {{ $cert->title }}</h3>
                                <div class="flex items-center justify-end mt-2 sm:mt-3">
                                    <span
                                        class="font-mono text-[8px] sm:text-[10px] text-slate-600">{{ $cert->date->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($certificates->count() > 6)
                    <div class="text-center mt-10">
                        <button id="load-more-certs"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-violet-700/50 text-violet-400 font-mono text-sm hover:border-violet-400 hover:bg-violet-900/20 transition-all duration-300"
                            data-shown="6" data-total="{{ $certificates->count() }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            tampilkan_lebih()
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </section>

    {{-- ═══════════════════════════ EDUCATION TIMELINE ═══════════════════════════ --}}
    <section id="education" class="py-24 bg-[#0a0e1a]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16 scroll-reveal">
                <span class="font-mono text-xs text-yellow-400 font-bold tracking-widest uppercase">/*Pendidikan*/</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Riwayat Pendidikan</h2>
            </div>

            @if ($educations->isEmpty())
                <div class="scroll-reveal tech-card p-16 text-center">
                    <p class="font-mono text-slate-600 text-sm">// Belum Ada Data</p>
                </div>
            @else
                <div class="relative">
                    {{-- Timeline vertical line --}}
                    <div
                        class="absolute left-6 sm:left-8 top-4 bottom-4 w-px bg-gradient-to-b from-yellow-600/50 via-yellow-600/20 to-transparent">
                    </div>

                    <div class="space-y-6">
                        @foreach ($educations as $i => $edu)
                            <div class="scroll-reveal relative pl-16 sm:pl-20 delay-{{ ($i % 4) * 100 }} group">
                                {{-- Timeline dot --}}
                                <div
                                    class="absolute left-4 sm:left-6 top-6 w-5 h-5 rounded-full bg-[#0a0e1a] border-2 border-yellow-500/50 group-hover:border-yellow-400 transition-colors flex items-center justify-center z-10">
                                    <div
                                        class="w-1.5 h-1.5 rounded-full bg-yellow-500 group-hover:bg-yellow-400 group-hover:shadow-[0_0_10px_rgba(234,179,8,1)] transition-all duration-300">
                                    </div>
                                </div>

                                <div
                                    class="tech-card p-5 sm:p-7 group-hover:border-yellow-500/30 group-hover:shadow-[0_0_30px_rgba(234,179,8,0.05)] transition-all duration-300 relative overflow-hidden">
                                    {{-- Background glow on hover --}}
                                    <div
                                        class="absolute top-0 right-0 w-32 h-32 bg-yellow-600/5 rounded-full blur-[50px] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                                    </div>

                                    <h3 class="text-lg font-bold text-white mb-1">{{ $edu->institution }}</h3>
                                    <div class="flex flex-wrap items-center gap-2 mb-3">
                                        <p class="text-yellow-400 text-sm font-medium">{{ $edu->degree }}</p>
                                        @if ($edu->status)
                                            <span
                                                class="px-2 py-0.5 rounded text-[10px] font-bold {{ $edu->status == 'Lulus' ? 'bg-blue-500/10 text-blue-400 border-blue-500/20' : 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' }} uppercase tracking-wider border">
                                                {{ $edu->status }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex flex-col gap-3">
                                        <div
                                            class="inline-flex items-center gap-2 bg-[#161b22] w-fit px-3 py-1.5 rounded-md border border-slate-800">
                                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-xs font-mono text-slate-400">{{ $edu->start_year }} -
                                                {{ $edu->end_year ?? 'Sekarang' }}</span>
                                        </div>

                                        @if ($edu->subs->isNotEmpty())
                                            <div class="mt-4 space-y-4 border-l-2 border-yellow-500/20 pl-4 py-1">
                                                @foreach ($edu->subs as $sub)
                                                    <div class="relative">
                                                        {{-- Sub-timeline dot --}}
                                                        <div
                                                            class="absolute -left-[21px] top-1.5 w-2 h-2 rounded-full bg-yellow-500/50 shadow-[0_0_8px_rgba(234,179,8,0.3)]">
                                                        </div>

                                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                                            <h5 class="text-xs font-bold text-slate-200">
                                                                {{ $sub->institution }}</h5>
                                                            <span
                                                                class="px-1.5 py-0.5 rounded text-[8px] font-bold {{ $sub->status == 'Lulus' ? 'bg-blue-500/10 text-blue-400 border-blue-500/20' : 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' }} border uppercase tracking-wider">
                                                                {{ $sub->status }}
                                                            </span>
                                                        </div>

                                                        <div class="flex flex-col gap-1">
                                                            <p class="text-[10px] font-mono text-slate-500">
                                                                {{ $sub->start_date?->format('d M Y') }} -
                                                                {{ $sub->end_date?->format('d M Y') ?? 'Sekarang' }}
                                                                @if ($sub->supervisor)
                                                                    <span class="mx-2 opacity-30">|</span>
                                                                    <span class="text-slate-400">Pembimbing:
                                                                        {{ $sub->supervisor }}</span>
                                                                @endif
                                                            </p>
                                                            @if ($sub->description)
                                                                <p
                                                                    class="text-[10px] text-slate-500 leading-relaxed font-mono mt-1 opacity-80">
                                                                    {{ $sub->description }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                    </div>

                                    {{-- Deskripsi pendidikan telah dihapus --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ═══════════════════════════ ACTIVITIES TIMELINE ═══════════════════════════ --}}
    <section id="activities" class="py-24 bg-[#0a0e1a]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16 scroll-reveal">
                <span class="font-mono text-xs text-primary-400 font-bold tracking-widest uppercase">/* Riwayat Kegiatan
                    */</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Riwayat Kegiatan & Pengalaman</h2>
            </div>

            @if ($activities->isEmpty())
                <div class="scroll-reveal tech-card p-16 text-center">
                    <p class="font-mono text-slate-600 text-sm">// Tidak Ada Riwayat Kegiatan</p>
                </div>
            @else
                @php
                    $colsPerRow = 3; // 3 per row desktop
                    $chunks = $activities->chunk($colsPerRow);
                    $totalShown = 6; // 2 desktop rows shown initially
                    $mobileLimit = 4; // first 4 items shown on mobile
                @endphp

                {{-- ── Desktop: Zigzag per Rows ── --}}
                <div id="activities-zigzag" class="hidden md:block space-y-2">
                    @foreach ($chunks as $rowIdx => $chunk)
                        @php
                            // All rows display L→R chronologically (oldest→newest)
                            $goRight = $rowIdx % 2 === 0;
                            $items = $chunk->values()->all();
                            $count = count($items);
                            $rowStart = $rowIdx * $colsPerRow;
                            $rowHidden = $rowStart >= $totalShown;
                            $displayItems = $items;
                        @endphp

                        <div class="activity-row {{ $rowHidden ? 'hidden' : '' }}" data-row="{{ $rowIdx }}"
                            data-row-start="{{ $rowStart }}">

                            <div class="flex items-stretch gap-0"
                                style="{{ $goRight ? 'justify-content:flex-start' : 'justify-content:flex-end' }}">
                                @foreach ($displayItems as $colIdx => $activity)
                                    @php
                                        $globalIdx = $rowStart + $colIdx;
                                        $isLast = $colIdx === $count - 1;
                                    @endphp

                                    <div class="activity-item px-1.5 flex-shrink-0" style="width:calc((100% - 4rem) / 3)"
                                        data-index="{{ $globalIdx }}">
                                        <div
                                            class="h-full scroll-reveal tech-card p-3 flex flex-col group hover:border-amber-400/30 transition-all duration-300 relative overflow-hidden">
                                            <div
                                                class="absolute inset-0 bg-primary-600/3 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none rounded-xl">
                                            </div>
                                            @if ($activity->image)
                                                <div
                                                    class="rounded overflow-hidden aspect-video bg-[#161b22] border border-slate-800/50 mb-2 relative flex-shrink-0">
                                                    <img src="{{ asset('storage/' . $activity->image) }}"
                                                        alt="{{ $activity->title }}"
                                                        class="w-full h-full object-cover opacity-75 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700 cursor-pointer viewable-image">
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-t from-[#0a0e1a] via-transparent to-transparent opacity-40 pointer-events-none">
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    class="rounded aspect-video bg-[#161b22] border border-slate-800/50 mb-2 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-6 h-6 text-slate-700" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <p class="font-mono text-[9px] text-amber-400/70 mb-0.5">
                                                {{ optional($activity->date)->format('d M Y') ?? '-' }}</p>
                                            <h3
                                                class="font-bold text-white text-xs mb-1 group-hover:text-amber-400/90 transition-colors leading-snug">
                                                {{ $activity->title }}</h3>
                                            @if ($activity->description)
                                                <p
                                                    class="text-slate-500 text-[10px] leading-relaxed font-mono line-clamp-3">
                                                    {{ $activity->description }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    @if (!$isLast)
                                        <div class="flex-shrink-0 flex items-center justify-center" style="width:2rem">
                                            <div class="flex items-center">
                                                <div class="w-2.5 h-px bg-amber-400/50"></div>
                                                <div
                                                    class="w-4 h-4 rounded-full border-2 border-amber-400/70 bg-[#0a0e1a] flex items-center justify-center flex-shrink-0">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-amber-400/60"></div>
                                                </div>
                                                <div class="w-2.5 h-px bg-amber-400/50"></div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        @if (!$loop->last)
                            @php $nextRowHidden = ($rowIdx + 1) * $colsPerRow >= $totalShown; @endphp
                            <div class="activity-vconn {{ $rowHidden || $nextRowHidden ? 'hidden' : '' }} flex"
                                style="{{ $goRight
                                    ? 'justify-content:flex-end;padding-right:calc(100%/6 - 1rem)'
                                    : 'justify-content:flex-start;padding-left:calc(100%/6 - 1rem)' }}"
                                data-after-row="{{ $rowIdx }}">
                                <div class="flex flex-col items-center py-0.5">
                                    <div class="w-px h-4 bg-gradient-to-b from-amber-400/50 to-amber-400/20"></div>
                                    <div
                                        class="w-4 h-4 rounded-full border-2 border-amber-400/60 bg-[#0a0e1a] flex items-center justify-center flex-shrink-0">
                                        <div class="w-1.5 h-1.5 rounded-full bg-amber-400/50"></div>
                                    </div>
                                    <div class="w-px h-4 bg-gradient-to-b from-amber-400/20 to-transparent"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- ── Mobile: Vertical Zigzag (S-Curve 100% Match) ── --}}
                <div class="md:hidden mt-8 px-8 pb-4" id="activities-mobile-grid">
                    <div class="relative w-full max-w-md mx-auto">
                        @foreach ($activities as $mIdx => $activity)
                            @php $mHidden = $mIdx >= $mobileLimit; @endphp

                            {{-- Container Kartu --}}
                            <div class="relative w-full act-mobile-item {{ $mHidden ? 'hidden' : '' }} {{ !$loop->last ? 'mb-10' : '' }}"
                                data-mobile-idx="{{ $mIdx }}">

                                {{-- Garis Sambung S-Curve (Tidak dicetak di elemen terakhir) --}}
                                @if (!$loop->last)
                                    @if ($mIdx % 2 == 0)
                                        <!-- Bracket Kiri -->
                                        <div
                                            class="absolute top-[50%] left-[-20px] w-[20px] h-[calc(100%+2.5rem)] border-l-2 border-t-2 border-b-2 border-amber-400/60 rounded-l-xl z-0 pointer-events-none">
                                        </div>
                                        <div
                                            class="absolute top-[calc(100%+1.25rem)] left-[-26px] w-3.5 h-3.5 rounded-full bg-[#0a0e1a] border-[1.5px] border-amber-400 z-10 -translate-y-1/2 flex items-center justify-center">
                                            <div class="w-1 h-1 rounded-full bg-amber-400"></div>
                                        </div>
                                    @else
                                        <!-- Bracket Kanan -->
                                        <div
                                            class="absolute top-[50%] right-[-20px] w-[20px] h-[calc(100%+2.5rem)] border-r-2 border-t-2 border-b-2 border-amber-400/60 rounded-r-xl z-0 pointer-events-none">
                                        </div>
                                        <div
                                            class="absolute top-[calc(100%+1.25rem)] right-[-26px] w-3.5 h-3.5 rounded-full bg-[#0a0e1a] border-[1.5px] border-amber-400 z-10 -translate-y-1/2 flex items-center justify-center">
                                            <div class="w-1 h-1 rounded-full bg-amber-400"></div>
                                        </div>
                                    @endif
                                @endif

                                {{-- Kartu Body --}}
                                <div
                                    class="scroll-reveal tech-card p-4 group hover:border-amber-400/40 hover:shadow-[0_0_20px_rgba(251,191,36,0.08)] transition-all duration-300 relative overflow-hidden bg-[#0d1117] z-10">
                                    <div
                                        class="aspect-[16/9] relative overflow-hidden bg-[#161b22] rounded border border-slate-800/50 mb-3">
                                        @if ($activity->image)
                                            <img src="{{ asset('storage/' . $activity->image) }}"
                                                alt="{{ $activity->title }}"
                                                class="w-full h-full object-cover opacity-75 group-hover:scale-105 transition-transform duration-700 group-hover:opacity-100 cursor-pointer viewable-image">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="font-mono text-[9px] text-amber-400/70 mb-1">
                                            {{ optional($activity->date)->format('d M Y') ?? '-' }}</p>
                                        <h3
                                            class="font-bold text-white text-sm mb-1.5 group-hover:text-amber-400/90 transition-colors leading-snug">
                                            {{ $activity->title }}</h3>
                                        @if ($activity->description)
                                            <p class="text-slate-500 text-[11px] leading-relaxed font-mono line-clamp-3">
                                                {{ $activity->description }}</p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Load-more button --}}
                @if ($activities->count() > $totalShown || $activities->count() > $mobileLimit)
                    <div class="text-center mt-10" id="activities-load-more-wrap">
                        <button id="load-more-activities"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-amber-700/50 text-amber-400 font-mono text-sm hover:border-amber-400 hover:bg-amber-900/20 transition-all duration-300"
                            data-desktop-shown="{{ $totalShown }}" data-desktop-total="{{ $activities->count() }}"
                            data-desktop-cols="{{ $colsPerRow }}" data-mobile-shown="{{ $mobileLimit }}"
                            data-mobile-total="{{ $activities->count() }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            tampilkan_lebih()
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </section>

    {{-- ═══════════════════════════ MODAL IMAGE VIEWER ═══════════════════════════ --}}
    <div id="image-modal"
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-[#0a0e1a]/90 backdrop-blur-md opacity-0 transition-opacity duration-300">
        {{-- Tombol Tutup --}}
        <button id="close-modal"
            class="absolute top-4 right-4 sm:top-8 sm:right-8 text-slate-400 hover:text-white bg-[#161b22]/50 hover:bg-red-500/80 p-2 rounded-full transition-all duration-300 z-50">
            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        {{-- Wadah Gambar --}}
        <div class="relative w-full max-w-6xl max-h-screen p-4 sm:p-8 flex justify-center items-center"
            id="modal-container">
            <img id="modal-image" src="" alt="Preview"
                class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-[0_0_50px_rgba(6,182,212,0.15)] transform scale-95 transition-transform duration-300 border border-slate-800/50">
        </div>
    </div>

    <style>
        /* Local floating animation for terminal */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('[data-count]');

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-count');
                if (target === 0) return; // No need to animate if target is 0

                const duration = 1500; // 1.5 seconds animation
                const increment = target / (duration / 16); // ~60fps

                let current = 0;
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.innerText = Math.round(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCounter();
            };

            // Use Intersection Observer to trigger animation when visible
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target); // Animate only once
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => {
                // Initialize to 0
                counter.innerText = '0';
                observer.observe(counter);
            });
        });
    </script>

    <script>
        // ── Load More (Projects & Certs) ──
        function setupLoadMore(btnId, itemClass) {
            const btn = document.getElementById(btnId);
            if (!btn) return;
            btn.addEventListener('click', () => {
                const shown = parseInt(btn.dataset.shown);
                const total = parseInt(btn.dataset.total);
                document.querySelectorAll('.' + itemClass).forEach(item => {
                    const idx = parseInt(item.dataset.index);
                    if (idx >= shown && idx < shown + 6) item.classList.remove('hidden');
                });
                const newShown = shown + 6;
                btn.dataset.shown = newShown;
                if (newShown >= total) btn.parentElement.remove();
            });
        }
        setupLoadMore('load-more-projects', 'project-item');
        setupLoadMore('load-more-certs', 'cert-item');

        // ── Load More Activities ──
        const actBtn = document.getElementById('load-more-activities');
        if (actBtn) {
            actBtn.addEventListener('click', () => {
                const isMobile = window.innerWidth < 768;

                if (isMobile) {
                    // Mobile: show next 4 act-mobile-item elements
                    const mShown = parseInt(actBtn.dataset.mobileShown);
                    const mTotal = parseInt(actBtn.dataset.mobileTotal);
                    const mNewShown = mShown + 4;

                    document.querySelectorAll('#activities-mobile-grid .act-mobile-item').forEach(el => {
                        const idx = parseInt(el.dataset.mobileIdx);
                        if (idx >= mShown && idx < mNewShown) el.classList.remove('hidden');
                    });

                    actBtn.dataset.mobileShown = mNewShown;
                    if (mNewShown >= mTotal) document.getElementById('activities-load-more-wrap')?.remove();

                } else {
                    // Desktop: show next 2 rows (6 items = 2 × 3)
                    const dShown = parseInt(actBtn.dataset.desktopShown);
                    const dTotal = parseInt(actBtn.dataset.desktopTotal);
                    const cols = parseInt(actBtn.dataset.desktopCols) || 3;
                    const dNewShown = dShown + 6;

                    document.querySelectorAll('#activities-zigzag .activity-row').forEach(row => {
                        const rowStart = parseInt(row.dataset.rowStart);
                        if (rowStart >= dShown && rowStart < dNewShown) row.classList.remove('hidden');
                    });

                    document.querySelectorAll('#activities-zigzag .activity-vconn').forEach(conn => {
                        const afterRow = parseInt(conn.dataset.afterRow);
                        const connRowStart = afterRow * cols;
                        const nextRowStart = (afterRow + 1) * cols;
                        if (connRowStart < dNewShown && nextRowStart < dNewShown) conn.classList.remove(
                            'hidden');
                    });

                    actBtn.dataset.desktopShown = dNewShown;
                    if (dNewShown >= dTotal) document.getElementById('activities-load-more-wrap')?.remove();
                }
            });
        }

        // ── Image Modal Viewer Logic ──
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('image-modal');
            const modalImg = document.getElementById('modal-image');
            const closeBtn = document.getElementById('close-modal');
            const viewableImages = document.querySelectorAll('.viewable-image');

            // Fungsi Buka Modal
            const openModal = (src) => {
                modalImg.src = src;
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                // Sedikit delay agar animasi transisi Tailwind berjalan
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modalImg.classList.remove('scale-95');
                    modalImg.classList.add('scale-100');
                }, 10);

                document.body.style.overflow = 'hidden'; // Kunci scroll halaman
            };

            // Fungsi Tutup Modal
            const closeModal = () => {
                modal.classList.add('opacity-0');
                modalImg.classList.remove('scale-100');
                modalImg.classList.add('scale-95');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    modalImg.src = ''; // Bersihkan src
                    document.body.style.overflow = ''; // Kembalikan scroll halaman
                }, 300); // Sesuai dengan durasi animasi Tailwind
            };

            // Pasang event klik ke semua gambar
            viewableImages.forEach(img => {
                img.addEventListener('click', (e) => {
                    e.stopPropagation();
                    openModal(img.src);
                });
            });

            // Tutup jika klik tombol silang
            closeBtn.addEventListener('click', closeModal);

            // Tutup jika klik di luar gambar (background gelap)
            modal.addEventListener('click', (e) => {
                if (e.target === modal || e.target.id === 'modal-container') {
                    closeModal();
                }
            });

            // Tutup jika menekan tombol Escape di keyboard
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>
@endsection
