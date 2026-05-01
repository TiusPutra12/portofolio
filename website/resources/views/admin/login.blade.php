<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — DevPortfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #0a0e1a; }
        .grid-pattern {
            background-image:
                linear-gradient(rgba(6,182,212,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(6,182,212,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex items-center justify-center p-4 bg-[#0a0e1a] text-slate-300">

    {{-- Background --}}
    <div class="absolute inset-0 grid-pattern pointer-events-none"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-primary-600/8 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-sm">

        {{-- Header --}}
        <div class="text-center mb-8 animate-fade-in">
            {{-- Logo --}}
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#0d1117] border border-primary-600/30 mb-5 shadow-[0_0_30px_rgba(6,182,212,0.15)]">
                <svg class="w-7 h-7 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="font-mono font-bold text-xl text-white">Dev<span class="text-primary-400">Admin</span></h1>
            <p class="font-mono text-xs text-slate-600 mt-1">// authenticate to continue</p>
        </div>

        {{-- Login Card --}}
        <div class="animate-fade-in delay-100 bg-[#0d1117] border border-primary-900/40 rounded-2xl p-7 shadow-[0_0_40px_rgba(6,182,212,0.06)]">

            @if($errors->any())
                <div class="mb-5 flex items-center gap-2.5 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/25 text-red-400">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-mono text-xs">{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="/admin/login" class="space-y-5">
                @csrf

                <div>
                    <label for="password" class="block font-mono text-xs font-semibold text-slate-500 mb-2 uppercase tracking-wider">
                        $ password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            autofocus
                            placeholder="••••••••••••"
                            class="w-full px-4 py-3 pr-12 rounded-xl bg-[#161b22] border border-primary-900/40 text-white placeholder-slate-700 font-mono text-sm focus:outline-none focus:border-primary-600/50 focus:shadow-[0_0_0_3px_rgba(6,182,212,0.08)] transition-all"
                        >
                        <button type="button" id="toggle-pwd" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-600 hover:text-primary-400 transition-colors">
                            <svg class="w-4 h-4" id="eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl bg-primary-600 text-white font-mono font-bold text-sm hover:bg-primary-500 focus:outline-none transition-all duration-200 hover:shadow-[0_0_20px_rgba(6,182,212,0.35)] hover:-translate-y-0.5 active:translate-y-0 border border-primary-500/50">
                    authenticate()
                </button>
            </form>
        </div>

        {{-- Back link --}}
        <div class="text-center mt-6 animate-fade-in delay-200">
            <a href="/" class="font-mono text-xs text-slate-600 hover:text-primary-400 transition-colors">
                &larr; back_to_portfolio()
            </a>
        </div>
    </div>

    <script>
        const btn = document.getElementById('toggle-pwd');
        const pwd = document.getElementById('password');
        btn && btn.addEventListener('click', () => {
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
        });
    </script>
</body>
</html>
