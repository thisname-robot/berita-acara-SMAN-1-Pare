@php
    $fallbackNavItems = [
        ['label' => 'Beranda', 'url' => url('/'), 'open_in_new_tab' => false],
        ['label' => 'Profil', 'url' => url('/profil'), 'open_in_new_tab' => false],
        ['label' => 'Berita & Artikel', 'url' => url('/berita-artikel'), 'open_in_new_tab' => false],
        ['label' => 'Galeri', 'url' => url('/galeri'), 'open_in_new_tab' => false],
        ['label' => 'Prestasi', 'url' => url('/prestasi'), 'open_in_new_tab' => false],
        ['label' => 'Kontak', 'url' => url('/kontak'), 'open_in_new_tab' => false],
    ];

    $resolvedMenus =
        isset($portalMenus) && $portalMenus->isNotEmpty()
            ? $portalMenus
                ->map(
                    fn($menu) => [
                        'label' => $menu->label,
                        'url' => $menu->url,
                        'open_in_new_tab' => (bool) $menu->open_in_new_tab,
                    ],
                )
                ->all()
            : $fallbackNavItems;

    $currentUrl = url()->current();
@endphp

<!-- ================= HEADER / NAVBAR RESPONSIF ================= -->
<header
    class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
    <div
        class="h-16 lg:h-20 max-w-7xl mx-auto px-gutter-mobile lg:px-gutter flex items-center justify-between gap-space-md">
        <!-- Brand -->
        <div class="flex items-center gap-space-sm sm:gap-space-md shrink-0">
            <a href="{{ url('/') }}"
                class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-on-primary shadow-sm shrink-0"
                aria-label="Beranda SMAN 1 Pare">
                <span class="material-symbols-outlined text-[24px]" aria-hidden="true">school</span>
            </a>
            <div class="flex flex-col">
                <a href="{{ url('/') }}"
                    class="font-title-md text-title-md tracking-tight text-on-surface leading-tight">
                    SMAN 1 PARE
                </a>
                <span class="hidden sm:block font-label-sm text-label-sm text-on-surface-variant">
                    Unggul, Berkarakter, Berwawasan Global
                </span>
            </div>
        </div>

        <!-- Desktop Nav (xl+) -->
        <nav class="hidden xl:flex items-center gap-1 bg-surface-container-low p-1 rounded-full" id="desktop-nav"
            aria-label="Navigasi utama desktop">
            @foreach ($resolvedMenus as $menu)
                @php
                    $isCurrent = !$menu['open_in_new_tab'] && rtrim($menu['url'], '/') === rtrim($currentUrl, '/');
                @endphp
                <a href="{{ $menu['url'] }}"
                    @if ($menu['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif
                    @if ($isCurrent) aria-current="page" @endif
                    class="min-h-[40px] px-3.5 py-2 rounded-full text-sm font-medium transition-colors inline-flex items-center gap-1 {{ $isCurrent ? 'bg-surface-container-lowest text-on-surface font-semibold shadow-sm' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                    <span>{{ $menu['label'] }}</span>
                    @if ($menu['open_in_new_tab'])
                        <span class="material-symbols-outlined text-[15px]" aria-hidden="true">open_in_new</span>
                    @endif
                </a>
            @endforeach
        </nav>

        <!-- Right actions -->
        <div class="flex items-center gap-space-sm sm:gap-space-md shrink-0">
            <a href="{{ url('/berita-artikel') }}"
                class="hidden lg:flex items-center gap-space-sm bg-surface-container-low hover:bg-surface-container px-space-md py-2 rounded-lg text-on-surface-variant transition-colors"
                aria-label="Cari informasi di halaman berita">
                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">search</span>
                <span class="font-body-sm text-body-sm">Cari informasi...</span>
            </a>

            <a class="hidden sm:inline-flex min-h-[40px] items-center gap-space-xs bg-primary text-on-primary font-label-md text-label-md px-space-md py-space-sm rounded-lg hover:bg-primary-container transition-colors"
                href="{{ url('/portal-akademik') }}">
                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">lock_open</span>
                <span class="hidden lg:inline">Portal Akademik</span>
            </a>

            <a href="{{ url('/login') }}"
                class="w-10 h-10 rounded-full bg-primary hover:bg-primary-container flex items-center justify-center shrink-0 text-on-primary transition-colors"
                title="Masuk Akun Pengguna" aria-label="Masuk ke akun pengguna">
                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">person</span>
            </a>

            <!-- Mobile menu toggle -->
            <button id="menu-toggle" type="button"
                class="xl:hidden min-w-[44px] min-h-[44px] flex items-center justify-center rounded-lg hover:bg-surface-container-low transition-colors"
                aria-controls="mobile-drawer" aria-expanded="false" aria-label="Buka menu navigasi">
                <span class="material-symbols-outlined text-on-surface" id="menu-icon" aria-hidden="true">menu</span>
            </button>
        </div>
    </div>
</header>

<!-- Overlay -->
<div id="drawer-overlay"
    class="fixed inset-0 bg-black/40 z-50 hidden opacity-0 transition-opacity duration-200 xl:hidden"
    aria-hidden="true"></div>

<!-- Mobile Drawer -->
<aside id="mobile-drawer"
    class="fixed top-0 right-0 z-[60] h-full w-[85vw] max-w-sm bg-surface-container-lowest shadow-2xl translate-x-full transition-transform duration-300 ease-out xl:hidden flex flex-col"
    aria-hidden="true" aria-label="Menu navigasi utama">
    <div class="flex items-center justify-between h-16 px-gutter-mobile border-b border-outline-variant/40">
        <div class="flex items-center gap-space-sm">
            <div class="w-9 h-9 rounded-lg bg-primary flex items-center justify-center text-on-primary">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">school</span>
            </div>
            <span class="font-title-md text-title-md text-on-surface">SMAN 1 PARE</span>
        </div>
        <button id="drawer-close" type="button"
            class="min-w-[44px] min-h-[44px] flex items-center justify-center rounded-lg hover:bg-surface-container-low"
            aria-label="Tutup menu">
            <span class="material-symbols-outlined" aria-hidden="true">close</span>
        </button>
    </div>

    <div class="p-gutter-mobile flex flex-col gap-space-sm overflow-y-auto flex-1">
        <form action="{{ url('/berita-artikel') }}" method="GET"
            class="flex items-center gap-space-sm bg-surface-container-low px-space-md py-2.5 rounded-lg text-on-surface-variant">
            <label for="mobile-search-input" class="sr-only">Cari informasi</label>
            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">search</span>
            <input id="mobile-search-input" type="text" name="q" value="{{ request('q') }}"
                placeholder="Cari informasi..."
                class="w-full bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none" />
        </form>

        <nav class="flex flex-col gap-space-xs mt-1" aria-label="Menu utama seluler">
            @foreach ($resolvedMenus as $menu)
                @php
                    $isCurrent = !$menu['open_in_new_tab'] && rtrim($menu['url'], '/') === rtrim($currentUrl, '/');
                @endphp
                <a class="nav-link min-h-[44px] flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md transition-colors {{ $isCurrent ? 'bg-surface-container-high text-on-surface font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}"
                    href="{{ $menu['url'] }}"
                    @if ($menu['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif
                    @if ($isCurrent) aria-current="page" @endif>
                    <span>{{ $menu['label'] }}</span>
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                        {{ $menu['open_in_new_tab'] ? 'open_in_new' : 'chevron_right' }}
                    </span>
                </a>
            @endforeach
        </nav>

        <div class="mt-auto pt-space-md flex flex-col gap-space-sm">
            <a href="{{ url('/portal-akademik') }}"
                class="min-h-[44px] inline-flex items-center justify-center gap-space-xs bg-primary text-on-primary font-label-md text-label-md px-space-md py-3 rounded-lg hover:bg-primary-container transition-colors">
                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">lock_open</span>
                <span>Portal Akademik</span>
            </a>
        </div>
    </div>
</aside>
