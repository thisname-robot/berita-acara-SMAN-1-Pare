@php
  $navItems = [
    ['label' => 'Beranda', 'path' => 'beranda', 'url' => url('/')],
    ['label' => 'Profil', 'path' => 'profil', 'url' => url('/profil')],
    ['label' => 'Berita & Artikel', 'path' => 'berita-artikel', 'url' => url('/berita-artikel')],
    ['label' => 'Galeri', 'path' => 'galeri', 'url' => url('/galeri')],
    ['label' => 'Prestasi', 'path' => 'prestasi', 'url' => url('/prestasi')],
    ['label' => 'Kontak', 'path' => 'kontak', 'url' => url('/kontak')],
  ];
  $activeMenu = $activeMenu ?? 'berita-artikel';
@endphp

<!-- ================= HEADER / NAVBAR RESPONSIF ================= -->
<header
  class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]"
>
  <div
    class="h-16 lg:h-20 max-w-7xl mx-auto px-gutter-mobile lg:px-gutter flex items-center justify-between gap-space-md"
  >
    <!-- Brand -->
    <div class="flex items-center gap-space-sm sm:gap-space-md shrink-0">
      <a href="{{ url('/') }}" class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-on-primary shadow-sm shrink-0">
        <span class="material-symbols-outlined text-[24px]">school</span>
      </a>
      <div class="flex flex-col">
        <span class="font-title-md text-title-md tracking-tight text-on-surface leading-tight">SMAN 1 PARE</span>
        <span class="hidden sm:block font-label-sm text-label-sm text-on-surface-variant">Unggul, Berkarakter, Berwawasan Global</span>
      </div>
    </div>

    <!-- Desktop Nav (xl+) -->
    <nav
      class="hidden xl:flex items-center gap-space-sm bg-surface-container-low p-space-xs rounded-full"
      id="desktop-nav"
      aria-label="Navigasi utama desktop"
    >
      @foreach ($navItems as $item)
        @php $isActive = $activeMenu === $item['path']; @endphp
        <a
          class="nav-link font-label-md text-label-md px-space-md py-space-xs rounded-full transition-colors {{ $isActive ? 'bg-surface-container-high text-on-surface font-semibold' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}"
          data-path="{{ $item['path'] }}"
          href="{{ $item['url'] }}"
          @if($isActive) aria-current="page" @endif
        >{{ $item['label'] }}</a>
      @endforeach
    </nav>

    <!-- Right actions -->
    <div class="flex items-center gap-space-sm sm:gap-space-md shrink-0">
      <div class="hidden lg:flex items-center gap-space-sm bg-surface-container-low px-space-md py-space-xs rounded-lg text-on-surface-variant">
        <span class="material-symbols-outlined text-[18px]">search</span>
        <span class="font-body-sm text-body-sm">Cari informasi...</span>
        <kbd class="bg-surface-container-lowest px-1.5 py-0.5 rounded font-code-inline text-code-inline text-outline shadow-sm">⌘K</kbd>
      </div>
      <div class="hidden sm:flex items-center bg-surface-container-low p-0.5 rounded-full text-on-surface-variant font-label-sm text-label-sm" role="group" aria-label="Pilih bahasa">
        <button type="button" class="lang-btn px-2 py-1 rounded-full bg-surface-container-lowest text-on-surface shadow-sm" data-lang="id">ID</button>
        <button type="button" class="lang-btn px-2 py-1 text-on-surface-variant" data-lang="en">EN</button>
      </div>
      <a
        class="hidden sm:inline-flex items-center gap-space-xs bg-primary text-on-primary font-label-md text-label-md px-space-md py-space-sm rounded-lg hover:bg-surface-container-high hover:text-on-surface transition-all"
        data-path="portal-akademik"
        href="{{ url('/portal-akademik') }}"
      >
        <span class="material-symbols-outlined text-[18px]">lock_open</span>
        <span class="hidden lg:inline">Portal Akademik</span>
      </a>
      <a href="{{ url('/login') }}" class="w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0" title="Akun Pengguna">
        <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
      </a>
      <!-- Mobile menu toggle -->
      <button
        id="menu-toggle"
        type="button"
        class="xl:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-surface-container-low transition-colors"
        aria-controls="mobile-drawer"
        aria-expanded="false"
        aria-label="Buka menu navigasi"
      >
        <span class="material-symbols-outlined text-on-surface" id="menu-icon">menu</span>
      </button>
    </div>
  </div>
</header>

<!-- Overlay -->
<div id="drawer-overlay" class="fixed inset-0 bg-black/40 z-50 hidden opacity-0 transition-opacity duration-200 xl:hidden"></div>

<!-- Mobile Drawer -->
<aside
  id="mobile-drawer"
  class="fixed top-0 right-0 z-[60] h-full w-[85vw] max-w-sm bg-surface-container-lowest shadow-2xl translate-x-full transition-transform duration-300 ease-out xl:hidden flex flex-col"
  aria-hidden="true"
  aria-label="Menu navigasi utama"
>
  <div class="flex items-center justify-between h-16 px-gutter-mobile border-b border-outline-variant/40">
    <div class="flex items-center gap-space-sm">
      <div class="w-9 h-9 rounded-lg bg-primary flex items-center justify-center text-on-primary">
        <span class="material-symbols-outlined text-[20px]">school</span>
      </div>
      <span class="font-title-md text-title-md text-on-surface">SMAN 1 PARE</span>
    </div>
    <button id="drawer-close" type="button" class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-surface-container-low" aria-label="Tutup menu">
      <span class="material-symbols-outlined">close</span>
    </button>
  </div>

  <div class="p-gutter-mobile flex flex-col gap-space-sm overflow-y-auto flex-1">
    <form action="{{ url('/berita-artikel') }}" method="GET" class="flex items-center gap-space-sm bg-surface-container-low px-space-md py-2.5 rounded-lg text-on-surface-variant">
      <span class="material-symbols-outlined text-[20px]">search</span>
      <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari informasi..." class="w-full bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none" />
    </form>

    <nav class="flex flex-col gap-space-xs mt-1" aria-label="Menu utama seluler">
      @foreach ($navItems as $item)
        @php $isActive = $activeMenu === $item['path']; @endphp
        <a
          class="nav-link flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md transition-colors {{ $isActive ? 'bg-surface-container-high text-on-surface font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}"
          data-path="{{ $item['path'] }}"
          href="{{ $item['url'] }}"
          @if($isActive) aria-current="page" @endif
        >
          <span>{{ $item['label'] }}</span>
          <span class="material-symbols-outlined text-[18px]">chevron_right</span>
        </a>
      @endforeach
    </nav>

    <div class="mt-auto pt-space-md flex flex-col gap-space-sm">
      <div class="flex items-center bg-surface-container-low p-0.5 rounded-full text-on-surface-variant font-label-sm text-label-sm w-max" role="group" aria-label="Pilih bahasa">
        <button type="button" class="lang-btn px-3 py-1 rounded-full bg-surface-container-lowest text-on-surface shadow-sm" data-lang="id">ID</button>
        <button type="button" class="lang-btn px-3 py-1 text-on-surface-variant" data-lang="en">EN</button>
      </div>
      <a href="{{ url('/portal-akademik') }}" data-path="portal-akademik" class="inline-flex items-center justify-center gap-space-xs bg-primary text-on-primary font-label-md text-label-md px-space-md py-3 rounded-lg hover:bg-surface-container-high hover:text-on-surface transition-all">
        <span class="material-symbols-outlined text-[18px]">lock_open</span>
        <span>Portal Akademik</span>
      </a>
    </div>
  </div>
</aside>
