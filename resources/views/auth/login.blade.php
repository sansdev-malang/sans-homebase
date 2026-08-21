<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Login — {{ config('app.name', 'Sans Homebase') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        * {
            -webkit-tap-highlight-color: transparent;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            height: 100dvh;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Input focus ring */
        .input-field {
            transition: all 0.2s ease;
            border: 1.5px solid #E5E7EB;
        }
        .input-field:focus {
            outline: none;
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
        }

        /* Glassmorphism card */
        .glass-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.9);
        }

        /* Subtle blob animation */
        @keyframes blobFloat {
            0%, 100% { transform: scale(1) translate(0, 0); }
            33%       { transform: scale(1.08) translate(16px, -12px); }
            66%       { transform: scale(0.95) translate(-10px, 10px); }
        }
        .blob-anim-1 { animation: blobFloat 9s ease-in-out infinite; }
        .blob-anim-2 { animation: blobFloat 11s ease-in-out infinite reverse; }
        .blob-anim-3 { animation: blobFloat 13s ease-in-out infinite 2s; }

        /* Password eye button */
        .eye-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            color: #9CA3AF;
            transition: color 0.2s;
        }
        .eye-btn:hover { color: #374151; }

        /* Submit button */
        .btn-primary {
            background: linear-gradient(135deg, #0D0E11 0%, #1E293B 100%);
            transition: all 0.25s ease;
            box-shadow: 0 10px 30px -8px rgba(13, 14, 17, 0.5);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 32px -6px rgba(13, 14, 17, 0.55);
        }
        .btn-primary:active {
            transform: scale(0.985);
        }

        /* Scrollable content on small screens */
        .card-scroll {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            max-height: 100dvh;
        }
    </style>
</head>
<body class="h-full flex items-center justify-center bg-[#F0F9F4]">

    <!-- Animated Background Blobs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="blob-anim-1 absolute -top-24 -left-24 w-80 h-80 bg-[#A5E7FF] rounded-full filter blur-3xl opacity-60"></div>
        <div class="blob-anim-2 absolute -bottom-24 -right-24 w-96 h-96 bg-[#86EFAC] rounded-full filter blur-3xl opacity-55"></div>
        <div class="blob-anim-3 absolute top-1/3 right-1/4 w-64 h-64 bg-[#D794FF] rounded-full filter blur-3xl opacity-35"></div>
    </div>


    <!-- Main Card -->
    <div class="relative z-10 w-full max-w-[390px] px-4 card-scroll py-6">
        <div id="login-card" class="glass-card rounded-[32px] px-8 py-10 shadow-[0_24px_64px_-12px_rgba(0,0,0,0.12),0_0_1px_1px_rgba(255,255,255,0.6)]">

            <!-- Logo / Brand -->
            <div class="flex flex-col items-center mb-8">
                <div id="logo-wrap" class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-4 shadow-[0_4px_16px_-2px_rgba(16,185,129,0.25)]">
                    <i data-lucide="house" class="w-8 h-8 text-emerald-600" stroke-width="1.8"></i>
                </div>
                <h1 class="text-[22px] font-bold text-[#0D0E11] tracking-tight">Selamat datang kembali</h1>
                <p class="text-[13.5px] text-[#656E7B] mt-1 text-center">Masuk ke akun Tim Independen Homebase</p>
            </div>

            @if(session('error'))
            <div class="mb-5 px-4 py-3 rounded-2xl bg-red-50 border border-red-100 text-red-600 text-[13px] flex items-center gap-2.5">
                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <!-- Login Form -->
            <form id="login-form" method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-[12.5px] font-semibold text-[#374151] mb-1.5 tracking-wide uppercase">Email atau Username</label>
                    <input
                        id="email"
                        name="email"
                        type="text"
                        autocomplete="email"
                        required
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        class="input-field w-full px-4 py-3.5 rounded-2xl text-[14px] text-[#0D0E11] bg-white placeholder-[#C4CDD5]"
                    >
                    @error('email')
                    <p class="mt-1.5 text-[12px] text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-[12.5px] font-semibold text-[#374151] tracking-wide uppercase">Password</label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[12px] font-medium text-emerald-600 hover:text-emerald-700 transition-colors">Lupa password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            placeholder="Masukkan password"
                            class="input-field w-full px-4 py-3.5 pr-12 rounded-2xl text-[14px] text-[#0D0E11] bg-white placeholder-[#C4CDD5]"
                        >
                        <button type="button" onclick="togglePassword()" class="eye-btn absolute right-4 top-1/2 -translate-y-1/2" aria-label="Toggle password visibility">
                            <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1.5 text-[12px] text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Remember Me Toggle -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer select-none" for="remember">
                        <div class="relative">
                            <input id="remember" name="remember" type="checkbox" class="sr-only peer">
                            <div onclick="document.getElementById('remember').click()"
                                class="w-[42px] h-[24px] bg-gray-200 rounded-full cursor-pointer peer-checked:bg-emerald-500 transition-colors duration-200 relative flex-shrink-0 after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:w-[18px] after:h-[18px] after:bg-white after:rounded-full after:shadow-sm after:transition-all after:duration-200 peer-checked:after:translate-x-[18px]">
                            </div>
                        </div>
                        <span class="text-[13px] text-[#4B5563]" onclick="document.getElementById('remember').click()">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit -->
                <div class="pt-2">
                    <button id="btn-login" type="submit"
                        class="btn-primary w-full py-4 text-white text-[15px] font-semibold rounded-full cursor-pointer select-none">
                        Masuk
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="flex items-center gap-3 my-6">
                <div class="flex-1 h-px bg-gray-100"></div>
                <span class="text-[12px] text-[#9CA3AF] font-medium">atau</span>
                <div class="flex-1 h-px bg-gray-100"></div>
            </div>

            <!-- Form Penilaian Button -->
            <div class="text-center">
                <a href="{{ url('/penilaian') }}" class="inline-flex items-center justify-center gap-2 w-full py-3.5 rounded-full border-2 border-[#E5E7EB] text-[14px] font-semibold text-[#374151] hover:border-emerald-400 hover:text-emerald-600 hover:bg-emerald-50 active:scale-[0.985] transition-all cursor-pointer select-none">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    Input Poin
                </a>
            </div>
        </div>
    </div>

    <!-- Anime.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                pwd.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Render Lucide icons
            if (typeof lucide !== 'undefined') lucide.createIcons();

            if (typeof anime !== 'undefined') {
                // Card entrance
                anime({
                    targets: '#login-card',
                    opacity: [0, 1],
                    translateY: [32, 0],
                    duration: 700,
                    easing: 'easeOutExpo',
                });

                // Logo pop in
                anime({
                    targets: '#logo-wrap',
                    scale: [0.7, 1],
                    opacity: [0, 1],
                    duration: 600,
                    delay: 200,
                    easing: 'easeOutBack',
                });

            }
        });
    </script>
</body>
</html>
