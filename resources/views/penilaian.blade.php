<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Form Penilaian — {{ config('app.name', 'Sans Homebase') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
            overflow-x: hidden;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .input-field {
            transition: all 0.2s ease;
            border: 1.5px solid #E5E7EB;
        }
        .input-field:focus {
            outline: none;
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.9);
        }

        @keyframes blobFloat {
            0%, 100% { transform: scale(1) translate(0, 0); }
            33%       { transform: scale(1.08) translate(16px, -12px); }
            66%       { transform: scale(0.95) translate(-10px, 10px); }
        }
        .blob-anim-1 { animation: blobFloat 9s ease-in-out infinite; }
        .blob-anim-2 { animation: blobFloat 11s ease-in-out infinite reverse; }
        .blob-anim-3 { animation: blobFloat 13s ease-in-out infinite 2s; }

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

        .card-scroll {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            max-height: 100dvh;
        }
    </style>
</head>
<body class="h-full bg-[#F0F9F4] flex flex-col justify-start sm:justify-center items-center py-6 sm:py-10">

    <!-- Animated Background Blobs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="blob-anim-1 absolute -top-24 -left-24 w-80 h-80 bg-[#A5E7FF] rounded-full filter blur-3xl opacity-60"></div>
        <div class="blob-anim-2 absolute -bottom-24 -right-24 w-96 h-96 bg-[#86EFAC] rounded-full filter blur-3xl opacity-55"></div>
        <div class="blob-anim-3 absolute top-1/3 right-1/4 w-64 h-64 bg-[#D794FF] rounded-full filter blur-3xl opacity-35"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-[500px] px-4 card-scroll">
        <div id="form-card" class="glass-card rounded-[32px] px-6 sm:px-8 py-10 shadow-[0_24px_64px_-12px_rgba(0,0,0,0.12),0_0_1px_1px_rgba(255,255,255,0.6)] opacity-0">
            
            <!-- Header -->
            <div class="flex flex-col items-center mb-8">
                <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-4 shadow-[0_4px_16px_-2px_rgba(16,185,129,0.25)]">
                    <i data-lucide="clipboard-check" class="w-8 h-8 text-emerald-600" stroke-width="1.8"></i>
                </div>
                <h1 class="text-[22px] font-bold text-[#0D0E11] tracking-tight">Form Penilaian</h1>
                <p class="text-[13.5px] text-[#656E7B] mt-1 text-center">Silahkan isi form penilaian kinerja di bawah ini.</p>
            </div>

            <!-- Form -->
            <form action="#" method="POST" class="space-y-5">
                @csrf
                
                <!-- Nama Field -->
                <div class="anim-field opacity-0">
                    <label for="nama" class="block text-[12.5px] font-semibold text-[#374151] mb-1.5 tracking-wide uppercase">Nama Pegawai</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-4.5 h-4.5 text-[#9CA3AF]"></i>
                        </div>
                        <input type="text" id="nama" name="nama" required placeholder="Masukkan nama lengkap"
                            class="input-field w-full pl-11 pr-4 py-3.5 rounded-2xl text-[14px] text-[#0D0E11] bg-white placeholder-[#C4CDD5]">
                    </div>
                </div>

                <!-- Divisi Field -->
                <div class="anim-field opacity-0">
                    <label for="divisi" class="block text-[12.5px] font-semibold text-[#374151] mb-1.5 tracking-wide uppercase">Divisi / Unit Kerja</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="briefcase" class="w-4.5 h-4.5 text-[#9CA3AF]"></i>
                        </div>
                        <select id="divisi" name="divisi" required
                            class="input-field w-full pl-11 pr-4 py-3.5 rounded-2xl text-[14px] text-[#0D0E11] bg-white appearance-none">
                            <option value="" disabled selected>Pilih Divisi</option>
                            <option value="IT">Teknologi Informasi</option>
                            <option value="HR">Sumber Daya Manusia</option>
                            <option value="Finance">Keuangan & Akuntansi</option>
                            <option value="Operations">Operasional</option>
                            <option value="Marketing">Pemasaran</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <i data-lucide="chevron-down" class="w-4.5 h-4.5 text-[#9CA3AF]"></i>
                        </div>
                    </div>
                </div>

                <!-- Nilai Kinerja -->
                <div class="anim-field opacity-0">
                    <label class="block text-[12.5px] font-semibold text-[#374151] mb-2 tracking-wide uppercase">Nilai Kinerja Keseluruhan</label>
                    <div class="grid grid-cols-5 gap-2 w-full">
                        <label class="cursor-pointer">
                            <input type="radio" name="nilai" value="1" class="peer sr-only" required>
                            <div class="py-2.5 text-center rounded-xl border border-gray-200 text-[#9CA3AF] font-bold text-[15px] peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-600 transition-all hover:bg-gray-50 hover:border-gray-300">1</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="nilai" value="2" class="peer sr-only" required>
                            <div class="py-2.5 text-center rounded-xl border border-gray-200 text-[#9CA3AF] font-bold text-[15px] peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-600 transition-all hover:bg-gray-50 hover:border-gray-300">2</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="nilai" value="3" class="peer sr-only" required>
                            <div class="py-2.5 text-center rounded-xl border border-gray-200 text-[#9CA3AF] font-bold text-[15px] peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-600 transition-all hover:bg-gray-50 hover:border-gray-300">3</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="nilai" value="4" class="peer sr-only" required>
                            <div class="py-2.5 text-center rounded-xl border border-gray-200 text-[#9CA3AF] font-bold text-[15px] peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-600 transition-all hover:bg-gray-50 hover:border-gray-300">4</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="nilai" value="5" class="peer sr-only" required>
                            <div class="py-2.5 text-center rounded-xl border border-gray-200 text-[#9CA3AF] font-bold text-[15px] peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-600 transition-all hover:bg-gray-50 hover:border-gray-300">5</div>
                        </label>
                    </div>
                    <div class="flex justify-between mt-1 text-[11px] text-[#9CA3AF] font-medium px-1">
                        <span>Kurang</span>
                        <span>Sangat Baik</span>
                    </div>
                </div>

                <!-- Evaluasi/Komentar -->
                <div class="anim-field opacity-0">
                    <label for="komentar" class="block text-[12.5px] font-semibold text-[#374151] mb-1.5 tracking-wide uppercase">Komentar / Catatan</label>
                    <textarea id="komentar" name="komentar" rows="4" placeholder="Tuliskan evaluasi atau catatan tambahan..."
                        class="input-field w-full px-4 py-3.5 rounded-2xl text-[14px] text-[#0D0E11] bg-white placeholder-[#C4CDD5] resize-none"></textarea>
                </div>

                <!-- Submit -->
                <div class="pt-4 anim-field opacity-0">
                    <button type="submit" class="btn-primary w-full py-4 text-white text-[15px] font-semibold rounded-full cursor-pointer select-none flex items-center justify-center gap-2">
                        <span>Kirim Penilaian</span>
                        <i data-lucide="send" class="w-4.5 h-4.5"></i>
                    </button>
                </div>
            </form>

            <!-- Back to Login -->
            <div class="text-center mt-6 anim-field opacity-0">
                <a href="{{ url('/login') }}" class="inline-flex items-center gap-1.5 text-[13.5px] font-medium text-[#6B7280] hover:text-[#0D0E11] transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Login
                </a>
            </div>
            
        </div>
    </div>

    <!-- Anime.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();

            if (typeof anime !== 'undefined') {
                // Card entrance
                anime({
                    targets: '#form-card',
                    opacity: [0, 1],
                    translateY: [40, 0],
                    duration: 800,
                    easing: 'easeOutExpo',
                });

                // Staggered field entrance
                anime({
                    targets: '.anim-field',
                    opacity: [0, 1],
                    translateY: [20, 0],
                    duration: 600,
                    delay: anime.stagger(100, {start: 300}),
                    easing: 'easeOutBack',
                });
            }
        });
    </script>
</body>
</html>
