@php
    $fallbackNavItems = [
        ['label' => 'Beranda', 'url' => url('/'), 'open_in_new_tab' => false, 'children' => []],
        ['label' => 'Profil', 'url' => url('/profil'), 'open_in_new_tab' => false, 'children' => []],
        ['label' => 'Berita & Artikel', 'url' => url('/berita-artikel'), 'open_in_new_tab' => false, 'children' => []],
        ['label' => 'Galeri', 'url' => url('/galeri'), 'open_in_new_tab' => false, 'children' => []],
        ['label' => 'Prestasi', 'url' => url('/prestasi'), 'open_in_new_tab' => false, 'children' => []],
        ['label' => 'Kontak', 'url' => url('/kontak'), 'open_in_new_tab' => false, 'children' => []],
    ];

    $resolvedMenus =
        isset($portalMenus) && $portalMenus->isNotEmpty()
            ? $portalMenus
                ->map(
                    fn($menu) => [
                        'label' => $menu->label,
                        'url' => $menu->url,
                        'open_in_new_tab' => (bool) $menu->open_in_new_tab,
                        'children' => $menu->activeChildren
                            ->map(
                                fn($child) => [
                                    'label' => $child->label,
                                    'url' => $child->url,
                                    'open_in_new_tab' => (bool) $child->open_in_new_tab,
                                ],
                            )
                            ->all(),
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
    <!-- Desktop Nav (xl+) -->
    <nav class="hidden xl:flex justify-center items-center gap-1 bg-surface-container-low p-1 rounded-full" id="desktop-nav"
        aria-label="Navigasi utama desktop">
        @foreach ($resolvedMenus as $menu)
            @php
                $hasChildren = !empty($menu['children']);
                $isCurrent = !$menu['open_in_new_tab'] && rtrim($menu['url'], '/') === rtrim($currentUrl, '/');
            @endphp

            @if ($hasChildren)
                <!-- Menu dengan Sub-Menu (Dropdown) -->
                <div class="relative nav-dropdown" x-data="{ open: false }" @mouseenter="open = true"
                    @mouseleave="open = false" @click.outside="open = false" @keydown.escape.window="open = false">
                    <button type="button" @click="open = !open" :aria-expanded="open" aria-haspopup="true"
                        class="nav-dropdown-trigger min-h-[40px] px-3.5 py-2 rounded-full text-sm font-medium text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors inline-flex items-center gap-1">
                        <span>{{ $menu['label'] }}</span>
                        <span class="material-symbols-outlined text-[16px] transition-transform duration-150"
                            :class="open ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                    </button>

                    <!-- Wrapper pt-2 menghilangkan celah hover agar menu tidak tertutup saat kursor turun -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="nav-dropdown-menu hidden absolute left-0 top-full pt-2 w-60 z-[70]"
                        :class="open ? '!block' : 'hidden'">
                        <div class="rounded-xl bg-white border border-outline-variant/40 shadow-xl py-1.5">
                            @foreach ($menu['children'] as $child)
                                <a href="{{ $child['url'] }}"
                                    @if ($child['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif
                                    class="px-4 py-2.5 text-sm text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low flex items-center justify-between gap-2 transition-colors">
                                    <span>{{ $child['label'] }}</span>
                                    @if ($child['open_in_new_tab'])
                                        <span class="material-symbols-outlined text-[15px] text-outline"
                                            aria-hidden="true">open_in_new</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <!-- Menu Tunggal -->
                <a href="{{ $menu['url'] }}"
                    @if ($menu['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif
                    @if ($isCurrent) aria-current="page" @endif
                    class="min-h-[40px] px-3.5 py-2 rounded-full text-sm font-medium transition-colors inline-flex items-center gap-1 {{ $isCurrent ? 'bg-surface-container-lowest text-on-surface font-semibold shadow-sm' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
                    <span>{{ $menu['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>
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
                    $hasChildren = !empty($menu['children']);
                    $isCurrent = !$menu['open_in_new_tab'] && rtrim($menu['url'], '/') === rtrim($currentUrl, '/');
                @endphp

                @if ($hasChildren)
                    <div class="rounded-lg overflow-hidden" x-data="{ subOpen: false }">
                        <button type="button" @click="subOpen = !subOpen" :aria-expanded="subOpen"
                            class="mobile-sub-trigger w-full min-h-[44px] flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors">
                            <span>{{ $menu['label'] }}</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-150"
                                :class="subOpen ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                        </button>
                        <div x-show="subOpen" class="mobile-sub-panel hidden pl-4 pr-2 py-1 space-y-1"
                            :class="subOpen ? '!block' : 'hidden'">
                            @foreach ($menu['children'] as $child)
                                <a href="{{ $child['url'] }}"
                                    @if ($child['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif
                                    class="min-h-[40px] flex items-center justify-between px-3 py-2 rounded-md text-sm text-on-surface-variant hover:text-on-surface hover:bg-surface-container">
                                    <span>{{ $child['label'] }}</span>
                                    @if ($child['open_in_new_tab'])
                                        <span class="material-symbols-outlined text-[15px]"
                                            aria-hidden="true">open_in_new</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a class="nav-link min-h-[44px] flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md transition-colors {{ $isCurrent ? 'bg-surface-container-high text-on-surface font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}"
                        href="{{ $menu['url'] }}"
                        @if ($menu['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif
                        @if ($isCurrent) aria-current="page" @endif>
                        <span>{{ $menu['label'] }}</span>
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                            {{ $menu['open_in_new_tab'] ? 'open_in_new' : 'chevron_right' }}
                        </span>
                    </a>
                @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fallback vanilla JS jika Alpine.js belum terpasang di layout publik
        if (typeof window.Alpine === 'undefined') {
            document.querySelectorAll('.nav-dropdown').forEach(function(dropdown) {
                const trigger = dropdown.querySelector('.nav-dropdown-trigger');
                const menu = dropdown.querySelector('.nav-dropdown-menu');
                if (!trigger || !menu) return;

                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isHidden = menu.classList.contains('hidden');
                    menu.classList.toggle('hidden', !isHidden);
                    trigger.setAttribute('aria-expanded', String(isHidden));
                });

                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target)) {
                        menu.classList.add('hidden');
                        trigger.setAttribute('aria-expanded', 'false');
                    }
                });
            });

            document.querySelectorAll('.mobile-sub-trigger').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const panel = btn.nextElementSibling;
                    if (!panel) return;
                    const isHidden = panel.classList.contains('hidden');
                    panel.classList.toggle('hidden', !isHidden);
                    btn.setAttribute('aria-expanded', String(isHidden));
                });
            });
        }
    });
</script>
