<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #0a0e1a; }

        .admin-sidebar {
            background: #0d1117;
            border-right: 1px solid rgba(6,182,212,0.1);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.875rem;
            border-radius: 0.625rem;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #64748b;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            font-family: 'JetBrains Mono', monospace;
        }
        .nav-item:hover {
            color: #22d3ee;
            background: rgba(6,182,212,0.07);
            border-color: rgba(6,182,212,0.15);
        }
        .nav-item.active {
            color: #22d3ee;
            background: rgba(6,182,212,0.1);
            border-color: rgba(6,182,212,0.25);
        }
        .nav-item.active svg { color: #22d3ee; }

        .admin-topbar {
            background: rgba(13,17,23,0.95);
            border-bottom: 1px solid rgba(6,182,212,0.08);
            backdrop-filter: blur(12px);
        }

        .admin-card {
            background: #0d1117;
            border: 1px solid rgba(6,182,212,0.1);
            border-radius: 0.875rem;
            transition: all 0.25s ease;
        }
        .admin-card:hover {
            border-color: rgba(6,182,212,0.25);
            box-shadow: 0 0 20px rgba(6,182,212,0.06);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.125rem;
            border-radius: 0.5rem;
            background: #0891b2;
            color: #fff;
            font-size: 0.8125rem;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            transition: all 0.2s ease;
            border: 1px solid #0e7490;
        }
        .btn-primary:hover {
            background: #06b6d4;
            box-shadow: 0 0 16px rgba(6,182,212,0.35);
            transform: translateY(-1px);
        }

        .input-field {
            width: 100%;
            padding: 0.625rem 0.875rem;
            background: #161b22;
            border: 1px solid rgba(6,182,212,0.15);
            border-radius: 0.5rem;
            color: #e2e8f0;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.2s;
        }
        .input-field:focus {
            border-color: rgba(6,182,212,0.5);
            box-shadow: 0 0 0 3px rgba(6,182,212,0.08);
        }
        .input-field::placeholder { color: #475569; }

        textarea.input-field { resize: none; }

        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-family: 'JetBrains Mono', monospace;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .admin-table td {
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            color: #94a3b8;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }
        .admin-table tr:hover td { background: rgba(6,182,212,0.03); color: #cbd5e1; }
        .admin-table tr:last-child td { border-bottom: none; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #0a0e1a; }
        ::-webkit-scrollbar-thumb { background: rgba(6,182,212,0.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(6,182,212,0.5); }

        /* Selection */
        ::selection { background: rgba(6,182,212,0.25); }

        label { color: #94a3b8; font-size: 0.8125rem; font-weight: 500; display: block; margin-bottom: 0.375rem; }
        label span.req { color: #f87171; }
    </style>
</head>
<body class="font-sans antialiased text-slate-300">

    <div class="min-h-screen flex">

        {{-- ──────── SIDEBAR ──────── --}}
        <aside id="sidebar" class="admin-sidebar fixed inset-y-0 left-0 z-40 w-60 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300">

            {{-- Brand --}}
            <div class="flex items-center gap-2.5 px-5 h-16 border-b border-primary-900/30">
                <div class="w-7 h-7 rounded-lg bg-primary-600/20 border border-primary-600/40 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <span class="font-mono font-bold text-sm text-white">Dev</span><span class="font-mono font-bold text-sm text-primary-400">Admin</span>
                    <p class="font-mono text-[9px] text-slate-600 leading-none">portfolio manager</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <p class="font-mono text-[9px] text-slate-700 uppercase tracking-widest px-3 mb-2">// navigation</p>

                <a href="/admin" class="nav-item {{ request()->is('admin') && !request()->is('admin/*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    dashboard()
                </a>

                <a href="{{ route('admin.profile.edit') }}" class="nav-item {{ request()->is('admin/profile*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    profile.json()
                </a>

                <a href="{{ route('admin.account.edit') }}" class="nav-item {{ request()->is('admin/account*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    edit_account()
                </a>

                <a href="{{ route('admin.tech_stack.edit') }}" class="nav-item {{ request()->is('admin/tech-stack*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    skill.json()
                </a>

                <a href="{{ route('admin.socials.edit') }}" class="nav-item {{ request()->is('admin/socials*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    socials.json()
                </a>

                <p class="font-mono text-[9px] text-slate-700 uppercase tracking-widest px-3 mt-4 mb-2">// content</p>

                <a href="/admin/certificates" class="nav-item {{ request()->is('admin/certificates*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    certificates[]
                </a>

                <a href="/admin/education" class="nav-item {{ request()->is('admin/education*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    education[]
                </a>

                <a href="/admin/activities" class="nav-item {{ request()->is('admin/activities*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    activities{}
                </a>

                <a href="/admin/projects" class="nav-item {{ request()->is('admin/projects*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    projects.all()
                </a>
            </nav>

            {{-- Bottom actions --}}
            <div class="px-3 pb-4 border-t border-primary-900/20 pt-3 space-y-1">
                <a href="/" target="_blank" class="nav-item">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    view_portfolio()
                </a>
                <form method="POST" action="/admin/logout">
                    @csrf
                    <button type="submit" class="nav-item w-full text-left hover:!text-red-400 hover:!border-red-900/40 hover:!bg-red-900/10">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        logout()
                    </button>
                </form>
            </div>
        </aside>

        {{-- Overlay (mobile) --}}
        <div id="sidebar-overlay" class="hidden fixed inset-0 z-30 bg-black/60 backdrop-blur-sm lg:hidden" onclick="toggleSidebar()"></div>

        {{-- ──────── MAIN AREA ──────── --}}
        <div class="flex-1 lg:ml-60 min-w-0">

            {{-- Topbar --}}
            <header class="admin-topbar sticky top-0 z-20 h-16 flex items-center gap-4 px-4 sm:px-6">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-1 rounded-lg text-slate-500 hover:text-primary-400 hover:bg-primary-900/20 transition-all border border-transparent hover:border-primary-900/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <div class="flex items-center gap-2 min-w-0">
                    <span class="font-mono text-xs text-slate-700">~/admin/</span>
                    <span class="font-mono text-sm font-semibold text-slate-300 truncate">@yield('title', 'dashboard')</span>
                </div>

                <div class="ml-auto flex items-center gap-3">
                    {{-- Status dot --}}
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-neon-500/10 border border-neon-500/20">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-neon-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-neon-500"></span>
                        </span>
                        <span class="font-mono text-[10px] text-neon-400 font-semibold">ONLINE</span>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mx-4 sm:mx-6 mt-5">
                    <div class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-neon-500/10 border border-neon-500/25 text-neon-400">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-mono text-xs font-medium">// {{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-4 sm:mx-6 mt-5">
                    <div class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-red-500/10 border border-red-500/25 text-red-400">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-mono text-xs font-medium">// {{ session('error') }}</span>
                    </div>
                </div>
            @endif

            {{-- Page Content --}}
            <main class="p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
