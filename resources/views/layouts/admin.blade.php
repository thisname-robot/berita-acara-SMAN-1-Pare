<!DOCTYPE html>
<html lang="id" class="h-full bg-[#F8FAFC] antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Redaksi') — Portal SMAN 1 Pare</title>

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Vite Assets (Tailwind CSS + Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-display: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            font-family: var(--font-sans);
            color: #0F172A;
            background-color: #F8FAFC;
        }

        h1,
        h2,
        h3,
        h4,
        .font-display {
            font-family: var(--font-display);
        }

        /* R-39: Kursor interaktif global pada kontrol aktif */
        a[href],
        button:not(:disabled),
        select:not(:disabled),
        summary,
        [role="button"] {
            cursor: pointer;
        }

        button:disabled,
        select:disabled {
            cursor: not-allowed;
        }

        /* R-32: Indikator fokus keyboard WCAG AA */
        :focus-visible {
            outline: 2px solid #0F172A;
            outline-offset: 2px;
        }

        /* R-39: Hormati preferensi pengurangan gerak */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="h-full text-[#0F172A] selection:bg-[#0F172A] selection:text-white" x-data="{ sidebarOpen: false }"
    @keydown.escape.window="sidebarOpen = false">

    <!-- Skip to Main Content untuk Aksesibilitas Keyboard -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded-lg focus:bg-[#0F172A] focus:px-4 focus:py-2.5 focus:text-sm focus:font-semibold focus:text-white">
        Langsung ke konten utama
    </a>

    <div class="min-h-full flex">
        <!-- Backdrop Mobile Sidebar (Level 4 Overlay) -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-[#0F172A]/40 backdrop-blur-[4px] lg:hidden" aria-hidden="true"
            style="display: none;"></div>

        <!-- Sidebar Navigasi (Desktop Fixed & Mobile Slide-out) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-[#E2E8F0] flex flex-col transition-transform duration-200 ease-out lg:translate-x-0 lg:static lg:inset-auto lg:shrink-0"
            aria-label="Navigasi Utama Admin">

            <!-- Identitas Institusi -->
            <div class="h-16 px-6 flex items-center justify-between border-b border-[#E2E8F0]">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 min-h-[44px]">
                    <div class="w-8 h-8 rounded-lg bg-[#0F172A] text-white flex items-center justify-center font-display font-bold text-xs tracking-tight shrink-0"
                        aria-hidden="true">
                        S1P
                    </div>
                    <div class="leading-tight">
                        <span class="block font-display font-bold text-sm text-[#0F172A] tracking-[-0.01em]">SMAN 1
                            Pare</span>
                        <span class="block text-[11px] font-medium text-[#64748B]">Portal Redaksi</span>
                    </div>
                </a>

                <button type="button" @click="sidebarOpen = false"
                    class="lg:hidden min-w-[44px] min-h-[44px] -mr-2 flex items-center justify-center rounded-lg text-[#64748B] hover:text-[#0F172A] hover:bg-[#F1F5F9]"
                    aria-label="Tutup menu navigasi">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Daftar Menu Berdasarkan Dokumen SDLC & Use Case Diagram -->
            <nav class="flex-1 px-4 py-6 space-y-6 overflow-y-auto">
                <div>
                    <p class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-[0.04em] text-[#64748B]">
                        Ringkasan
                    </p>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                @if (request()->routeIs('admin.dashboard')) aria-current="page" @endif
                                class="min-h-[44px] px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#0F172A] text-white' : 'text-[#475569] hover:bg-[#F1F5F9] hover:text-[#0F172A]' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-[0.04em] text-[#64748B]">
                        Manajemen Konten
                    </p>
                    <ul class="space-y-1">
                        <!-- Menu Artikel / Berita & Kurasi -->
                        <li>
                            <a href="{{ Route::has('admin.articles.index') ? route('admin.articles.index') : '#antrean-publikasi' }}"
                                @if (request()->routeIs('admin.articles.*')) aria-current="page" @endif
                                class="min-h-[44px] px-3 py-2.5 rounded-lg flex items-center justify-between text-sm font-medium transition-colors {{ request()->routeIs('admin.articles.*') ? 'bg-[#0F172A] text-white' : 'text-[#475569] hover:bg-[#F1F5F9] hover:text-[#0F172A]' }}">
                                <span class="flex items-center gap-3">
                                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                    </svg>
                                    <span>Berita & Artikel</span>
                                </span>
                                @if (isset($pendingArticlesCount) && $pendingArticlesCount > 0)
                                    <span
                                        class="px-2 py-0.5 text-[11px] font-semibold rounded-full {{ request()->routeIs('admin.articles.*') ? 'bg-white/20 text-white' : 'bg-[#FEF3C7] text-[#B45309] border border-[#FDE68A]' }}">
                                        {{ $pendingArticlesCount }}
                                    </span>
                                @endif
                            </a>
                        </li>

                        <!-- Master Kategori & Tag -->
                        @if (Route::has('admin.categories.index'))
                            <li>
                                <a href="{{ route('admin.categories.index') }}"
                                    @if (request()->routeIs('admin.categories.*')) aria-current="page" @endif
                                    class="min-h-[44px] px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm font-medium transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-[#0F172A] text-white' : 'text-[#475569] hover:bg-[#F1F5F9] hover:text-[#0F172A]' }}">
                                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                    </svg>
                                    <span>Kategori & Tag</span>
                                </a>
                            </li>
                        @endif

                        <!-- Moderasi Komentar Pembaca -->
                        @if (Route::has('admin.comments.index'))
                            <li>
                                <a href="{{ route('admin.comments.index') }}"
                                    @if (request()->routeIs('admin.comments.*')) aria-current="page" @endif
                                    class="min-h-[44px] px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm font-medium transition-colors {{ request()->routeIs('admin.comments.*') ? 'bg-[#0F172A] text-white' : 'text-[#475569] hover:bg-[#F1F5F9] hover:text-[#0F172A]' }}">
                                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                    </svg>
                                    <span>Moderasi Komentar</span>
                                </a>
                            </li>
                        @endif

                        <!-- menus -->
                        @if (Route::has('admin.settings.index'))
                            <li>
                                <a href="{{ route('admin.menus.index') }}"
                                    @if (request()->routeIs('admin.menus.*')) aria-current="page" @endif
                                    class="min-h-[44px] px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm font-medium transition-colors {{ request()->routeIs('admin.menus.*') ? 'bg-[#0F172A] text-white' : 'text-[#475569] hover:bg-[#F1F5F9] hover:text-[#0F172A]' }}">
                                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48。394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                    </svg>
                                    <span>Menus</span>
                                </a>
                            </li>
                        @endif

                        <!-- Pengaturan & Pemeliharaan Sistem -->
                        @if (Route::has('admin.settings.index'))
                            <li>
                                <a href="{{ route('admin.settings.index') }}"
                                    @if (request()->routeIs('admin.settings.*')) aria-current="page" @endif
                                    class="min-h-[44px] px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-[#0F172A] text-white' : 'text-[#475569] hover:bg-[#F1F5F9] hover:text-[#0F172A]' }}">
                                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                    </svg>
                                    <span>Pengaturan & Pemeliharaan Sistem</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Administrasi & Pengguna (Role Management) -->
                @if (Route::has('admin.users.index'))
                    <div>
                        <p class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-[0.04em] text-[#64748B]">
                            Administrasi
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    @if (request()->routeIs('admin.users.*')) aria-current="page" @endif
                                    class="min-h-[44px] px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-[#0F172A] text-white' : 'text-[#475569] hover:bg-[#F1F5F9] hover:text-[#0F172A]' }}">
                                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                    <span>Staf & Kontributor</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </nav>

            <!-- Footer Sidebar: Tautan ke Portal Publik -->
            <div class="p-4 border-t border-[#E2E8F0]">
                <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer"
                    class="min-h-[44px] w-full px-3 py-2.5 rounded-lg border border-[#CBD5E1] bg-white text-xs font-semibold text-[#0F172A] hover:bg-[#F1F5F9] flex items-center justify-center gap-2 transition-colors">
                    <span>Buka Portal Publik</span>
                    <svg class="w-3.5 h-3.5 text-[#64748B]" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </a>
            </div>
        </aside>

        <!-- Area Kerja Utama -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar -->
            <header
                class="sticky top-0 z-30 h-16 bg-white border-b border-[#E2E8F0] px-4 sm:px-6 lg:px-10 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <!-- Tombol Hamburger Mobile (Tap target >= 44px) -->
                    <button type="button" @click="sidebarOpen = true"
                        class="lg:hidden min-w-[44px] min-h-[44px] -ml-2 flex items-center justify-center rounded-lg text-[#0F172A] hover:bg-[#F1F5F9]"
                        aria-label="Buka menu navigasi">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <!-- Breadcrumb / Konteks Halaman -->
                    <nav aria-label="Breadcrumb" class="text-sm truncate">
                        <ol class="flex items-center gap-2 text-[#64748B]">
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="hover:text-[#0F172A] transition-colors">Admin</a>
                            </li>
                            <li aria-hidden="true" class="text-[#CBD5E1]">/</li>
                            <li class="font-medium text-[#0F172A] truncate">@yield('breadcrumb', 'Dashboard')</li>
                        </ol>
                    </nav>
                </div>

                <!-- Profil Pengguna Aktif & Aksi Keluar -->
                <div class="flex items-center gap-3" x-data="{ userMenuOpen: false }"
                    @keydown.escape.window="userMenuOpen = false">
                    @php
                        $currentUser = auth()->user();
                        $userName = $currentUser->name ?? 'Administrator';
                        $userRole = $currentUser->role ?? 'admin';
                        $initials = collect(explode(' ', $userName))
                            ->map(fn($part) => mb_substr($part, 0, 1))
                            ->take(2)
                            ->implode('');
                    @endphp

                    <div class="relative">
                        <button type="button" @click="userMenuOpen = !userMenuOpen" :aria-expanded="userMenuOpen"
                            aria-haspopup="true"
                            class="min-h-[44px] pl-2 pr-3 py-1.5 rounded-lg border border-transparent hover:border-[#E2E8F0] hover:bg-[#F8FAFC] flex items-center gap-2.5 text-left transition-colors">
                            @if (!empty($currentUser?->avatar))
                                <img src="{{ asset('storage/' . $currentUser->avatar) }}"
                                    alt="Foto profil {{ $userName }}" width="32" height="32"
                                    class="w-8 h-8 rounded-full object-cover border border-[#E2E8F0]">
                            @else
                                <span
                                    class="w-8 h-8 rounded-full bg-[#F1F5F9] border border-[#CBD5E1] text-[#0F172A] text-xs font-semibold flex items-center justify-center"
                                    aria-hidden="true">
                                    {{ strtoupper($initials ?: 'AD') }}
                                </span>
                            @endif

                            <span class="hidden sm:block leading-tight">
                                <span class="block text-xs font-semibold text-[#0F172A]">{{ $userName }}</span>
                                <span
                                    class="block text-[11px] font-medium text-[#64748B] capitalize">{{ $userRole }}</span>
                            </span>

                            <svg class="w-4 h-4 text-[#64748B]" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu Profil (Level 3 Elevation) -->
                        <div x-show="userMenuOpen" @click.outside="userMenuOpen = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-52 rounded-lg bg-white border border-[#E2E8F0] shadow-[0_20px_25px_-5px_rgba(15,23,42,0.08),0_8px_10px_-6px_rgba(15,23,42,0.04)] py-1.5 z-40"
                            role="menu" style="display: none;">
                            <div class="px-3.5 py-2 border-b border-[#F1F5F9]">
                                <p class="text-xs font-semibold text-[#0F172A] truncate">{{ $userName }}</p>
                                <p class="text-[11px] text-[#64748B] truncate">
                                    {{ $currentUser->email ?? 'admin@sman1pare.sch.id' }}</p>
                            </div>

                            @if (Route::has('logout'))
                                <form method="POST" action="{{ route('logout') }}" class="mt-1 px-1.5">
                                    @csrf
                                    <button type="submit" role="menuitem"
                                        class="min-h-[44px] w-full px-2.5 py-2 rounded-md text-left text-xs font-medium text-[#BA1A1A] hover:bg-[#FEF2F2] flex items-center gap-2 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                        </svg>
                                        <span>Keluar dari Sesi</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </header>

            <!-- Konten Utama (Max Width 1280px sesuai DESIGN.md) -->
            <main id="main-content" class="flex-1 w-full max-w-[1280px] mx-auto px-5 sm:px-8 lg:px-12 py-8 lg:py-10">
                @if (session('status'))
                    <div role="status"
                        class="mb-6 rounded-lg bg-[#ECFDF5] border border-[#A7F3D0] px-4 py-3 text-sm text-[#047857] flex items-center justify-between gap-4">
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer Minimalis -->
            <footer class="border-t border-[#E2E8F0] bg-white px-5 sm:px-8 lg:px-12 py-4">
                <div
                    class="max-w-[1280px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-[#64748B]">
                    <p>Sistem Informasi Redaksi & Portal Akademik SMAN 1 Pare</p>
                    <p>Tahun Akademik {{ now()->year }}/{{ now()->addYear()->year }}</p>
                </div>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
