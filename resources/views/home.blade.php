<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="web_standard" name="shell-type" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
      rel="stylesheet"
    />
    <style>
      @layer base {
        html, body { margin: 0; padding: 0; }
        body { overscroll-behavior: none; }
        main > :first-child { margin-top: 0 !important; }
        main > :last-child { margin-bottom: 0 !important; }
      }
      ::-webkit-scrollbar { display: none; }
      .no-scroll { overflow: hidden; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "secondary-fixed": "#d3e4fe", surface: "#f7f9fb", background: "#f7f9fb",
              "primary-fixed-dim": "#bec6e0", primary: "#000000", "on-tertiary": "#ffffff",
              "on-primary": "#ffffff", "on-surface-variant": "#45464d", "tertiary-fixed-dim": "#ffb77d",
              "primary-fixed": "#dae2fd", "surface-container-high": "#e6e8ea", "on-secondary": "#ffffff",
              "surface-container": "#eceef0", "inverse-on-surface": "#eff1f3",
              "surface-container-highest": "#e0e3e5", "surface-dim": "#d8dadc",
              "on-error-container": "#93000a", tertiary: "#000000", "outline-variant": "#c6c6cd",
              "tertiary-fixed": "#ffdcc3", "on-secondary-fixed": "#0b1c30",
              "on-primary-container": "#7c839b", "secondary-container": "#d0e1fb",
              "surface-tint": "#565e74", "on-background": "#191c1e", "primary-container": "#131b2e",
              error: "#ba1a1a", "on-error": "#ffffff", "secondary-fixed-dim": "#b7c8e1",
              "inverse-surface": "#2d3133", "surface-container-lowest": "#ffffff",
              "surface-container-low": "#f2f4f6", "inverse-primary": "#bec6e0",
              "on-secondary-container": "#54647a", "surface-bright": "#f7f9fb",
              "error-container": "#ffdad6", secondary: "#505f76", "on-surface": "#191c1e",
              "on-primary-fixed-variant": "#3f465c", "on-tertiary-fixed-variant": "#6e3900",
              "on-primary-fixed": "#131b2e", "surface-variant": "#e0e3e5",
              "on-tertiary-container": "#c76c00", "on-tertiary-fixed": "#2f1500",
              outline: "#76777d", "on-secondary-fixed-variant": "#38485d",
              "tertiary-container": "#2f1500",
            },
            borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
            spacing: {
              "space-sm": "0.5rem", "space-xl": "2.5rem", "gutter-mobile": "1rem",
              "space-lg": "1.5rem", gutter: "1.5rem", "space-xs": "0.25rem",
              "margin-mobile": "1.25rem", "space-md": "1rem", margin: "3rem",
            },
            fontFamily: {
              "body-sm": ["Inter"], "label-sm": ["Inter"], "display-hero": ["Plus Jakarta Sans"],
              "headline-sm": ["Plus Jakarta Sans"], "headline-lg": ["Plus Jakarta Sans"],
              "code-inline": ["Inter"], "label-md": ["Inter"], "headline-md": ["Plus Jakarta Sans"],
              "body-lg": ["Inter"], "headline-lg-mobile": ["Plus Jakarta Sans"],
              "display-hero-mobile": ["Plus Jakarta Sans"], "body-md": ["Inter"],
              "title-md": ["Plus Jakarta Sans"],
            },
            fontSize: {
              "body-sm": ["13px", { lineHeight: "20px", fontWeight: "400" }],
              "label-sm": ["12px", { lineHeight: "16px", letterSpacing: "0.04em", fontWeight: "600" }],
              "display-hero": ["48px", { lineHeight: "56px", letterSpacing: "-0.03em", fontWeight: "700" }],
              "headline-sm": ["20px", { lineHeight: "28px", letterSpacing: "-0.01em", fontWeight: "600" }],
              "headline-lg": ["36px", { lineHeight: "44px", letterSpacing: "-0.025em", fontWeight: "600" }],
              "code-inline": ["13px", { lineHeight: "18px", fontWeight: "500" }],
              "label-md": ["14px", { lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "500" }],
              "headline-md": ["24px", { lineHeight: "32px", letterSpacing: "-0.015em", fontWeight: "600" }],
              "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
              "headline-lg-mobile": ["26px", { lineHeight: "34px", letterSpacing: "-0.02em", fontWeight: "600" }],
              "display-hero-mobile": ["32px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "700" }],
              "body-md": ["15px", { lineHeight: "24px", fontWeight: "400" }],
              "title-md": ["16px", { lineHeight: "24px", letterSpacing: "-0.005em", fontWeight: "600" }],
            },
          },
        },
      };
    </script>
  </head>
  <body class="bg-surface font-body-md text-body-md text-on-surface antialiased">
    <!-- ================= HEADER / NAVBAR RESPONSIF ================= -->
    <header
      class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]"
    >
      <div
        class="h-16 lg:h-20 max-w-7xl mx-auto px-gutter-mobile lg:px-gutter flex items-center justify-between gap-space-md"
      >
        <!-- Brand -->
        <div class="flex items-center gap-space-sm sm:gap-space-md shrink-0">
          <a href="#" class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-on-primary shadow-sm shrink-0">
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
          data-active-classes="bg-surface-container-high text-on-surface font-label-md rounded-full px-space-md py-space-xs"
        >
          <a class="nav-link font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface px-space-md py-space-xs rounded-full transition-colors" data-path="beranda" href="#">Beranda</a>
          <a class="nav-link font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface px-space-md py-space-xs rounded-full transition-colors" data-path="profil" href="#">Profil</a>
          <a class="nav-link font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface px-space-md py-space-xs rounded-full transition-colors" data-path="berita-artikel" href="#">Berita &amp; Artikel</a>
          <a class="nav-link font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface px-space-md py-space-xs rounded-full transition-colors" data-path="galeri" href="#">Galeri</a>
          <a class="nav-link font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface px-space-md py-space-xs rounded-full transition-colors" data-path="prestasi" href="#">Prestasi</a>
          <a class="nav-link font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface px-space-md py-space-xs rounded-full transition-colors" data-path="kontak" href="#">Kontak</a>
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
            data-path="portal-akademik" href="#"
          >
            <span class="material-symbols-outlined text-[18px]">lock_open</span>
            <span class="hidden lg:inline">Portal Akademik</span>
          </a>
          <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
          </div>
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
        <div class="flex items-center gap-space-sm bg-surface-container-low px-space-md py-2.5 rounded-lg text-on-surface-variant">
          <span class="material-symbols-outlined text-[20px]">search</span>
          <input type="text" placeholder="Cari informasi..." class="w-full bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none" />
        </div>

        <nav class="flex flex-col gap-space-xs mt-1" aria-label="Menu utama seluler">
          <a class="nav-link flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors" data-path="beranda" href="#">
            <span>Beranda</span><span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </a>
          <a class="nav-link flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors" data-path="profil" href="#">
            <span>Profil</span><span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </a>
          <a class="nav-link flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors" data-path="berita-artikel" href="#">
            <span>Berita &amp; Artikel</span><span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </a>
          <a class="nav-link flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors" data-path="galeri" href="#">
            <span>Galeri</span><span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </a>
          <a class="nav-link flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors" data-path="prestasi" href="#">
            <span>Prestasi</span><span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </a>
          <a class="nav-link flex items-center justify-between px-space-md py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors" data-path="kontak" href="#">
            <span>Kontak</span><span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </a>
        </nav>

        <div class="mt-auto pt-space-md flex flex-col gap-space-sm">
          <div class="flex items-center bg-surface-container-low p-0.5 rounded-full text-on-surface-variant font-label-sm text-label-sm w-max" role="group" aria-label="Pilih bahasa">
            <button type="button" class="lang-btn px-3 py-1 rounded-full bg-surface-container-lowest text-on-surface shadow-sm" data-lang="id">ID</button>
            <button type="button" class="lang-btn px-3 py-1 text-on-surface-variant" data-lang="en">EN</button>
          </div>
          <a href="#" data-path="portal-akademik" class="inline-flex items-center justify-center gap-space-xs bg-primary text-on-primary font-label-md text-label-md px-space-md py-3 rounded-lg hover:bg-surface-container-high hover:text-on-surface transition-all">
            <span class="material-symbols-outlined text-[18px]">lock_open</span>
            <span>Portal Akademik</span>
          </a>
        </div>
      </div>
    </aside>

    <main class="w-full pt-16 lg:pt-20 bg-surface min-h-[calc(100vh-64px)]">
      <div class="flex flex-col w-full">
        <!-- ============ TOP CONTEXT HEADER & FILTER ============ -->
        <section class="w-full bg-surface-container-low py-space-lg">
          <div class="max-w-7xl mx-auto px-gutter-mobile lg:px-gutter flex flex-col gap-space-md">
            <nav class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant" aria-label="Breadcrumb">
              <a class="hover:text-on-surface transition-colors" data-path="beranda" href="#">Beranda</a>
              <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
              <span class="text-on-surface">Warta &amp; Publikasi</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
              <div class="max-w-3xl flex flex-col gap-space-xs">
                <span class="font-label-sm text-label-sm text-secondary tracking-wider uppercase font-semibold">Kanal Informasi Terpadu</span>
                <h1 class="font-headline-lg-mobile lg:font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface tracking-tight">
                  Warta &amp; Kabar Sekolah SMAN 1 Pare
                </h1>
                <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                  Pusat rilis pers resmi, jurnalistik siswa, surat edaran akademik, serta arsip dokumentasi pencapaian insan civitas akademika SMAN 1 Pare.
                </p>
              </div>
              <div class="shrink-0 flex items-center gap-space-xs bg-surface-container-lowest px-space-md py-space-sm rounded-lg shadow-sm self-start md:self-auto">
                <span class="material-symbols-outlined text-[18px] text-secondary">calendar_today</span>
                <span class="font-label-md text-label-md text-on-surface">T.A. 2025/2026 (Semester Ganjil)</span>
              </div>
            </div>

            <div class="mt-space-sm p-space-sm bg-surface-container-lowest rounded-xl shadow-sm flex flex-col sm:flex-row items-stretch sm:items-center gap-space-sm">
              <div class="flex-1 w-full flex items-center gap-space-sm px-space-md py-2 bg-surface-container-low rounded-lg">
                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">search</span>
                <input class="w-full bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none" placeholder="Cari topik, nama kegiatan, atau pengumuman..." type="text" />
              </div>
              <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-space-sm w-full sm:w-auto">
                <div class="relative w-full sm:w-64">
                  <select class="w-full appearance-none bg-surface-container-low text-on-surface font-label-md text-label-md px-space-md py-2.5 rounded-lg pr-9 focus:outline-none cursor-pointer">
                    <option value="all">Semua Kategori Warta</option>
                    <option value="kegiatan">Kegiatan Sekolah</option>
                    <option value="prestasi">Prestasi Siswa</option>
                    <option value="pengumuman">Pengumuman Akademik</option>
                    <option value="ekskul">Ekstrakurikuler</option>
                  </select>
                  <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-[18px] text-on-surface-variant pointer-events-none">expand_more</span>
                </div>
                <button class="shrink-0 bg-primary text-on-primary font-label-md text-label-md px-space-lg py-2.5 rounded-lg hover:bg-surface-container-highest hover:text-on-surface transition-colors flex items-center justify-center gap-space-xs cursor-pointer">
                  <span class="material-symbols-outlined text-[18px]">filter_list</span>
                  <span>Terapkan</span>
                </button>
              </div>
            </div>
          </div>
        </section>

        <!-- ============ MAIN CONTAINER ============ -->
        <div class="max-w-7xl mx-auto px-gutter-mobile lg:px-gutter w-full py-space-lg lg:py-space-xl flex flex-col gap-space-lg lg:gap-space-xl">
          <!-- Featured Lead Story -->
          <section class="w-full">
            <div class="flex flex-wrap items-center justify-between gap-space-xs mb-space-md">
              <div class="flex items-center gap-space-sm">
                <span class="w-2.5 h-2.5 rounded-full bg-error animate-pulse"></span>
                <span class="font-label-sm text-label-sm text-on-surface tracking-wider uppercase font-semibold">Sorotan Utama Humas</span>
              </div>
              <span class="font-code-inline text-code-inline text-on-surface-variant">RILIS PERS RESMI #SMANSA-2025-10</span>
            </div>

            <article class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-12 group transition-shadow duration-200 hover:shadow-md">
              <div class="lg:col-span-7 relative min-h-[220px] sm:min-h-[320px] lg:min-h-[460px] bg-surface-container-high overflow-hidden">
                <div
                  class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                  role="img"
                  aria-label="Kontingen OSN 2025 SMAN 1 Pare"
                  style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCfL2M7XlTI4bGkxslr6IRG9sNjy-BcRKr0RqQwM8221a6xtmOvtX9CccWdncRa5gmOwW020pwfwfRPAclM_E7mF286cdb_PjRr86He5mwvhscIUUVCSrr8gOFMGGTL_k-wG89WqQK7wFvoM-9tr3PgR1TnVhBuutbFkfJDDejT5_oip1oGnVsYfcK0XYy1S__eFRJB17V0nhG9dlj4Edd2PH_9gWkc5m80zvl3aAU');"
                ></div>
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent lg:hidden"></div>
                <div class="absolute bottom-3 left-3 bg-surface-container-lowest/95 backdrop-blur-sm px-space-md py-1.5 rounded text-on-surface font-label-sm text-label-sm shadow-sm flex items-center gap-space-xs">
                  <span class="material-symbols-outlined text-[16px] text-secondary">photo_camera</span>
                  <span>Kontingen OSN 2025 SMAN 1 Pare</span>
                </div>
              </div>

              <div class="lg:col-span-5 p-space-lg lg:p-space-xl flex flex-col justify-between bg-surface-container-lowest">
                <div class="flex flex-col gap-space-md">
                  <div class="flex flex-wrap items-center gap-space-sm">
                    <span class="px-space-md py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">Prestasi Akademik</span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
                      <span class="material-symbols-outlined text-[16px]">schedule</span>14 Oktober 2025
                    </span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
                      <span class="material-symbols-outlined text-[16px]">timer</span>4 Menit Baca
                    </span>
                  </div>
                  <h2 class="font-headline-md text-headline-md text-on-surface tracking-tight leading-snug">
                    Tim Olimpiade Sains SMAN 1 Pare Raih 3 Medali Emas di Ajang OSN Nasional 2025
                  </h2>
                  <p class="font-body-md text-body-md text-on-surface-variant line-clamp-4">
                    Prestasi gemilang kembali ditorehkan delegasi sains SMA Negeri 1 Pare pada ajang Olimpiade Sains Nasional (OSN) tingkat nasional di Bandung. Tiga siswa sukses menyabet medali emas di bidang Fisika Terapan, Kebumian, dan Biologi Molekuler setelah melalui seleksi ketat selama 5 hari berturut-turut.
                  </p>
                </div>
                <div class="pt-space-lg mt-space-md flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
                  <div class="flex items-center gap-space-sm">
                    <div class="w-9 h-9 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface">
                      <span class="material-symbols-outlined text-[20px]">edit_note</span>
                    </div>
                    <div class="flex flex-col">
                      <span class="font-label-sm text-label-sm text-on-surface">Tim Jurnalistik SMANSA</span>
                      <span class="font-code-inline text-code-inline text-on-surface-variant">Humas &amp; Publikasi</span>
                    </div>
                  </div>
                  <div class="flex items-center gap-space-xs self-end sm:self-auto">
                    <button type="button" data-bookmark class="bookmark-btn p-2 text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low rounded-lg transition-colors cursor-pointer" title="Simpan Artikel" aria-label="Simpan artikel">
                      <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                    </button>
                    <a class="inline-flex items-center gap-space-xs bg-primary text-on-primary font-label-md text-label-md px-space-lg py-2.5 rounded-lg hover:bg-surface-container-highest hover:text-on-surface transition-colors cursor-pointer" href="#">
                      <span>Baca Selengkapnya</span>
                      <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                  </div>
                </div>
              </div>
            </article>
          </section>

          <!-- Pill Tabs & Sort Bar -->
          <section class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 -mx-1 px-1" role="tablist" aria-label="Filter kategori berita">
              <button type="button" data-tab class="tab-btn bg-surface-container-highest text-on-surface font-label-md text-label-md px-space-md py-2 rounded-full font-semibold cursor-pointer shrink-0 whitespace-nowrap" aria-selected="true">Semua (42)</button>
              <button type="button" data-tab class="tab-btn bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md px-space-md py-2 rounded-full transition-colors cursor-pointer shrink-0 whitespace-nowrap" aria-selected="false">Kegiatan Sekolah (15)</button>
              <button type="button" data-tab class="tab-btn bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md px-space-md py-2 rounded-full transition-colors cursor-pointer shrink-0 whitespace-nowrap" aria-selected="false">Prestasi (12)</button>
              <button type="button" data-tab class="tab-btn bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md px-space-md py-2 rounded-full transition-colors cursor-pointer shrink-0 whitespace-nowrap" aria-selected="false">Pengumuman (8)</button>
              <button type="button" data-tab class="tab-btn bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md px-space-md py-2 rounded-full transition-colors cursor-pointer shrink-0 whitespace-nowrap" aria-selected="false">Ekstrakurikuler (7)</button>
            </div>
            <div class="flex items-center gap-space-sm self-end sm:self-auto shrink-0">
              <span class="font-label-sm text-label-sm text-on-surface-variant">Urutkan:</span>
              <div class="relative">
                <select class="appearance-none bg-surface-container-lowest text-on-surface font-label-md text-label-md px-space-md py-1.5 rounded-lg pr-8 shadow-sm cursor-pointer focus:outline-none">
                  <option>Terbaru</option>
                  <option>Paling Banyak Dibaca</option>
                  <option>Arsip Semester</option>
                </select>
                <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-[16px] text-on-surface-variant pointer-events-none">expand_more</span>
              </div>
            </div>
          </section>

          <!-- Asymmetric Content Grid + Sidebar -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg lg:gap-space-xl items-start">
            <!-- Articles Column -->
            <div class="lg:col-span-8 flex flex-col gap-space-lg min-w-0">
              <!-- Card 1: Cultural Event -->
              <article class="article-card bg-surface-container-lowest rounded-xl p-space-md sm:p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-space-md sm:gap-space-lg" data-category="kegiatan">
                <div class="sm:w-56 h-48 sm:h-auto rounded-lg overflow-hidden shrink-0 bg-surface-container-high relative">
                  <div class="w-full h-full bg-cover bg-center hover:scale-105 transition-transform duration-300" role="img" aria-label="Peringatan Bulan Bahasa dan Gelar Budaya Nusantara"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB6vQ7ZG_dAwO3l4HqZSDdYe2uXPzVNkQgLDw0PyNKmxADyQqIivd_vPa1k1cYENchUSeYq7o5RFNkr6KM6_tR8IUHnpmPC5Xla-2MaTmROTCF0o4Ycv7CXBLCdArw_JaEjTeJtNRE7HSmzmpEQ44XlkSOhOXi509UIFJos6IYucpd56v0nsUR3xf6On9VDiFjpyiTn__G2BFj0ObAiY845KD2G_itlyNtO7H83_eM');"
                  ></div>
                  <span class="absolute top-2 left-2 bg-surface-container-lowest/90 px-2 py-0.5 rounded text-[11px] font-semibold uppercase text-on-surface tracking-wider">Kegiatan</span>
                </div>
                <div class="flex-1 flex flex-col justify-between min-w-0">
                  <div class="flex flex-col gap-space-xs">
                    <div class="flex flex-wrap items-center gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
                      <span>12 Okt 2025</span><span aria-hidden="true">•</span><span>Kesiswaan</span><span aria-hidden="true">•</span>
                      <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">visibility</span>1.2k</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface tracking-tight hover:text-secondary cursor-pointer">
                      Peringatan Bulan Bahasa dan Gelar Budaya Nusantara SMAN 1 Pare 2025
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                      Seluruh kelas X hingga XII menampilkan kekayaan seni sastra, orasi kebangsaan, dan karnaval busana adat daerah dalam rangka memperkokoh karakter kebhinekaan pelajar.
                    </p>
                  </div>
                  <div class="mt-space-md pt-space-sm flex flex-wrap items-center justify-between gap-space-xs">
                    <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
                      <span class="material-symbols-outlined text-[16px]">person</span><span>Oleh: Pembina OSIS</span>
                    </div>
                    <a class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-1" href="#">
                      <span>Selengkapnya</span><span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- Card 2: Academic Notice -->
              <article class="article-card bg-surface-container-lowest rounded-xl p-space-md sm:p-space-lg shadow-sm hover:shadow-md transition-shadow" data-category="pengumuman">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md pb-space-sm">
                  <div class="flex items-start gap-space-sm">
                    <span class="p-2 rounded-lg bg-tertiary-fixed text-on-tertiary-fixed shrink-0">
                      <span class="material-symbols-outlined text-[22px]">assignment</span>
                    </span>
                    <div>
                      <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-semibold">Pengumuman Akademik Resmi</span>
                      <h3 class="font-headline-sm text-headline-sm text-on-surface tracking-tight mt-0.5">
                        Jadwal Penilaian Tengah Semester (PTS) Ganjil T.A. 2025/2026
                      </h3>
                    </div>
                  </div>
                  <span class="self-start md:self-auto px-space-md py-1 bg-surface-container text-on-surface font-code-inline text-code-inline rounded-full shrink-0">
                    SE-KURIKULUM/041/2025
                  </span>
                </div>
                <p class="font-body-md text-body-md text-on-surface-variant mt-space-sm">
                  Diberitahukan kepada seluruh siswa kelas X, XI, dan XII bahwa pelaksanaan PTS Ganjil berbasis Computer-Based Test (CBT) akan berlangsung mulai 27 Oktober hingga 3 November 2025. Seluruh siswa diwajibkan memeriksa kelengkapan akun portal CBT masing-masing.
                </p>
                <div class="mt-space-md pt-space-sm flex flex-col sm:flex-row sm:flex-wrap items-start sm:items-center justify-between gap-space-sm">
                  <div class="flex flex-wrap items-center gap-space-md font-body-sm text-body-sm text-on-surface-variant">
                    <span>Rilis: 10 Okt 2025</span><span>Penanggung Jawab: Waka Kurikulum</span>
                  </div>
                  <div class="flex flex-wrap items-center gap-space-sm">
                    <a class="inline-flex items-center gap-space-xs bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md px-space-md py-1.5 rounded-lg transition-colors cursor-pointer" href="#">
                      <span class="material-symbols-outlined text-[16px]">download</span><span>Unduh Jadwal (PDF)</span>
                    </a>
                    <a class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-0.5" href="#">
                      <span>Rincian</span><span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- Card 3: Pramuka -->
              <article class="article-card bg-surface-container-lowest rounded-xl p-space-md sm:p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-space-md sm:gap-space-lg" data-category="ekskul">
                <div class="sm:w-56 h-48 sm:h-auto rounded-lg overflow-hidden shrink-0 bg-surface-container-high relative">
                  <div class="w-full h-full bg-cover bg-center hover:scale-105 transition-transform duration-300" role="img" aria-label="Laskar Pramuka Gugus Depan SMAN 1 Pare"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCAzIOYYMWAwmK2Cq1VPB0LSmaPQU-_E2Rzz9Y0yhzBrkt5XolHjhL7fDuMnTyAK6bvRF5nDMjHgsWmlSGVAlhMHLV4ZgWxaAHCrt5p_25cbT-jVg5W1cF7dNUI9evGQi4oP_AuRHJv6ypG9-fyIkl2Nsjiswz0yYDbV9sTF0FgjXCIMs-M3aVtUyuvXaixrm4r1ZmtVsx2Wh_9dUdpWOFTqZgAT4xV_rW5yvzUH3U');"
                  ></div>
                  <span class="absolute top-2 left-2 bg-surface-container-lowest/90 px-2 py-0.5 rounded text-[11px] font-semibold uppercase text-on-surface tracking-wider">Ekstrakurikuler</span>
                </div>
                <div class="flex-1 flex flex-col justify-between min-w-0">
                  <div class="flex flex-col gap-space-xs">
                    <div class="flex flex-wrap items-center gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
                      <span>08 Okt 2025</span><span aria-hidden="true">•</span><span>Gugus Depan 01-02</span><span aria-hidden="true">•</span>
                      <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">visibility</span>890</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface tracking-tight hover:text-secondary cursor-pointer">
                      Laskar Pramuka Gugus Depan SMAN 1 Pare Juara Umum Raimuna Cabang Kediri
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                      Kontingen Penegak SMAN 1 Pare mendominasi kategori navigasi darat, pionering cepat, dan karya inovasi kepramukaan dalam perkemahan Raimuna tingkat Kabupaten Kediri.
                    </p>
                  </div>
                  <div class="mt-space-md pt-space-sm flex flex-wrap items-center justify-between gap-space-xs">
                    <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
                      <span class="material-symbols-outlined text-[16px]">person</span><span>Oleh: Pradana Putra &amp; Putri</span>
                    </div>
                    <a class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-1" href="#">
                      <span>Selengkapnya</span><span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- Card 4: KIR -->
              <article class="article-card bg-surface-container-lowest rounded-xl p-space-md sm:p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-space-md sm:gap-space-lg" data-category="kegiatan">
                <div class="sm:w-56 h-48 sm:h-auto rounded-lg overflow-hidden shrink-0 bg-surface-container-high relative">
                  <div class="w-full h-full bg-cover bg-center hover:scale-105 transition-transform duration-300" role="img" aria-label="Siswa KIR Ciptakan Inovasi Filter Air Gambut"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAaJgmEZOQqoRd-UPjwml0cXeczr7HHDjXFv2YPIyENlSzStCQinMPDzkTAM82TYRB8rPSNgUDsST9Nl5eWNKqTEQyE8qo15SIOfUmsoM-K3Ya_JRpeo3G_oqcCH-JMmPW4JOBlm0SkgwIFBVAdLhpETnInYQnXkYyE9N-KQopWi3N3XKYcG4sdD9iIK19wsv2-cGTp8yGklfoI-iOdM9yrh-1CHX4rAG3SjrT51jw');"
                  ></div>
                  <span class="absolute top-2 left-2 bg-surface-container-lowest/90 px-2 py-0.5 rounded text-[11px] font-semibold uppercase text-on-surface tracking-wider">Riset Siswa</span>
                </div>
                <div class="flex-1 flex flex-col justify-between min-w-0">
                  <div class="flex flex-col gap-space-xs">
                    <div class="flex flex-wrap items-center gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
                      <span>04 Okt 2025</span><span aria-hidden="true">•</span><span>KIR SMANSA</span><span aria-hidden="true">•</span>
                      <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">visibility</span>1.5k</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface tracking-tight hover:text-secondary cursor-pointer">
                      Siswa KIR Ciptakan Inovasi Filter Air Gambut Berbahan Sabut Kelapa Teraktivasi
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                      Karya ilmiah terapan karya Muhammad Farhan dan tim berhasil lolos ke tahap pembinaan nasional LKTI Kemenristek setelah diuji mampu menjernihkan air dengan efisiensi 94%.
                    </p>
                  </div>
                  <div class="mt-space-md pt-space-sm flex flex-wrap items-center justify-between gap-space-xs">
                    <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
                      <span class="material-symbols-outlined text-[16px]">person</span><span>Oleh: Pembina Riset Ilmiah</span>
                    </div>
                    <a class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-1" href="#">
                      <span>Selengkapnya</span><span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- Card 5: Literasi Digital -->
              <article class="article-card bg-surface-container-lowest rounded-xl p-space-md sm:p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-space-md sm:gap-space-lg" data-category="kegiatan">
                <div class="sm:w-56 h-48 sm:h-auto rounded-lg overflow-hidden shrink-0 bg-surface-container-high relative">
                  <div class="w-full h-full bg-cover bg-center hover:scale-105 transition-transform duration-300" role="img" aria-label="Pelatihan Literasi Digital di Lab Komputer"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA1916Hlt8P6lHzgacDYdwBkmRZm2eapUkwIRAdVLRWWmt6UQXkRHtsoPcRo-V1jNn4BEaeKlypF7OWbHG-cP0mL_OLNNTLM5n3YcgspXEF0e2WgljPPRwkK7YVrATEeO9bNBM3vYOYjB_ltcG7_yUO155kt_kG8AyjEKYpKNcH9om9FNZIe0cvKJMAcSNEZ1FJl_AbCR9RqT_-8v1t517SZ0H4ViD_t09dCmgQGlE');"
                  ></div>
                  <span class="absolute top-2 left-2 bg-surface-container-lowest/90 px-2 py-0.5 rounded text-[11px] font-semibold uppercase text-on-surface tracking-wider">Kegiatan</span>
                </div>
                <div class="flex-1 flex flex-col justify-between min-w-0">
                  <div class="flex flex-col gap-space-xs">
                    <div class="flex flex-wrap items-center gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
                      <span>28 Sep 2025</span><span aria-hidden="true">•</span><span>Pusat Sumber Belajar</span><span aria-hidden="true">•</span>
                      <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">visibility</span>640</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface tracking-tight hover:text-secondary cursor-pointer">
                      Pelatihan Literasi Digital &amp; Pemanfaatan Fasilitas Lab Komputer Baru
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                      Sebanyak 36 guru dan perwakilan ketua kelas mengikuti bimbingan teknis integrasi repositori e-library serta etika keamanan siber lingkungan persekolahan.
                    </p>
                  </div>
                  <div class="mt-space-md pt-space-sm flex flex-wrap items-center justify-between gap-space-xs">
                    <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
                      <span class="material-symbols-outlined text-[16px]">person</span><span>Oleh: Tim IT Sekolah</span>
                    </div>
                    <a class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-1" href="#">
                      <span>Selengkapnya</span><span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- Card 6: Basket DBL -->
              <article class="article-card bg-surface-container-lowest rounded-xl p-space-md sm:p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-space-md sm:gap-space-lg" data-category="ekskul">
                <div class="sm:w-56 h-48 sm:h-auto rounded-lg overflow-hidden shrink-0 bg-surface-container-high relative">
                  <div class="w-full h-full bg-cover bg-center hover:scale-105 transition-transform duration-300" role="img" aria-label="Tim Basket Putra SMAN 1 Pare"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCLfDK27oaguU58WCOyKYIxqMWrML8XXdKos-sA4iN2XtaJoSLZ-xP-y_QHy7-SDc9Oj4MUuB_0UxvYqhuBZMhc-dA0LVbIqOq0J3XJpxSj_rjRT_2ZsqEo_Vl0VTAEOfvuBzFY0zTYj9YmTp4OgsefENxaJTjSBcBd1JW3pHxvvPugDoMSrP9hDYh7WQZhVYfRx0DxZUTSPE_oV2nFjjVJT9uNThRtU9XLCz4MlhY');"
                  ></div>
                  <span class="absolute top-2 left-2 bg-surface-container-lowest/90 px-2 py-0.5 rounded text-[11px] font-semibold uppercase text-on-surface tracking-wider">Ekstrakurikuler</span>
                </div>
                <div class="flex-1 flex flex-col justify-between min-w-0">
                  <div class="flex flex-col gap-space-xs">
                    <div class="flex flex-wrap items-center gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
                      <span>25 Sep 2025</span><span aria-hidden="true">•</span><span>Tim Basket SMANSA</span><span aria-hidden="true">•</span>
                      <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">visibility</span>2.1k</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface tracking-tight hover:text-secondary cursor-pointer">
                      Tim Basket Putra Melaju ke Babak Playoff DBL Seri Jawa Timur
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                      Dengan kemenangan dramatis 58-54 atas rival sekota, skuad Garuda SMAN 1 Pare memastikan tiket babak delapan besar DBL Jawa Timur musim 2025.
                    </p>
                  </div>
                  <div class="mt-space-md pt-space-sm flex flex-wrap items-center justify-between gap-space-xs">
                    <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
                      <span class="material-symbols-outlined text-[16px]">person</span><span>Oleh: Official Tim Basket</span>
                    </div>
                    <a class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-1" href="#">
                      <span>Selengkapnya</span><span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- Pagination -->
              <div class="flex flex-wrap items-center justify-between gap-space-sm p-space-md bg-surface-container-lowest rounded-xl shadow-sm mt-space-md">
                <button class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-lg bg-surface-container-low text-on-surface-variant hover:bg-surface-container hover:text-on-surface font-label-md text-label-md transition-colors cursor-pointer">
                  <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                  <span class="hidden sm:inline">Sebelumnya</span>
                </button>
                <div class="flex items-center gap-1 font-label-md text-label-md">
                  <button class="w-9 h-9 rounded-lg bg-primary text-on-primary font-semibold cursor-pointer">1</button>
                  <button class="w-9 h-9 rounded-lg text-on-surface hover:bg-surface-container-low cursor-pointer transition-colors">2</button>
                  <button class="w-9 h-9 rounded-lg text-on-surface hover:bg-surface-container-low cursor-pointer transition-colors">3</button>
                  <span class="px-1 text-outline">...</span>
                  <button class="w-9 h-9 rounded-lg text-on-surface hover:bg-surface-container-low cursor-pointer transition-colors">8</button>
                </div>
                <button class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-lg bg-surface-container-low text-on-surface-variant hover:bg-surface-container hover:text-on-surface font-label-md text-label-md transition-colors cursor-pointer">
                  <span class="hidden sm:inline">Berikutnya</span>
                  <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
              </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4 flex flex-col gap-space-lg">
              <!-- Pengumuman Penting -->
              <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex flex-col gap-space-md">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-space-xs">
                    <span class="material-symbols-outlined text-[20px] text-error">campaign</span>
                    <h2 class="font-title-md text-title-md text-on-surface">Pengumuman Penting</h2>
                  </div>
                  <span class="px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">Resmi</span>
                </div>
                <div class="flex flex-col gap-space-sm">
                  <a class="p-space-sm rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors flex flex-col gap-1" href="#">
                    <div class="flex items-center justify-between gap-space-xs">
                      <span class="px-2 py-0.5 rounded bg-error text-on-error font-label-sm text-[11px] font-semibold">Mendesak</span>
                      <span class="font-code-inline text-code-inline text-on-surface-variant">Batas: 20 Okt 2025</span>
                    </div>
                    <h3 class="font-label-md text-label-md text-on-surface font-semibold mt-1">Verifikasi Nilai Rapor PDSS untuk Seleksi SNBP 2026</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Siswa kelas XII jalur eligible wajib mencocokkan data rapor fisik dengan sistem database sekolah.</p>
                  </a>
                  <a class="p-space-sm rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors flex flex-col gap-1" href="#">
                    <div class="flex items-center justify-between gap-space-xs">
                      <span class="px-2 py-0.5 rounded bg-secondary-fixed text-on-secondary-fixed font-label-sm text-[11px] font-semibold">Resmi</span>
                      <span class="font-code-inline text-code-inline text-on-surface-variant">02 Okt 2025</span>
                    </div>
                    <h3 class="font-label-md text-label-md text-on-surface font-semibold mt-1">Surat Edaran Jam Masuk Kegiatan Belajar Mengajar</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Penyesuaian apel pagi dan literasi mandiri hari Selasa hingga Kamis mulai pukul 06.45 WIB.</p>
                  </a>
                  <a class="p-space-sm rounded-lg bg-surface-container-low hover:bg-surface-container transition-colors flex flex-col gap-1" href="#">
                    <div class="flex items-center justify-between gap-space-xs">
                      <span class="px-2 py-0.5 rounded bg-surface-container-high text-on-surface font-label-sm text-[11px] font-semibold">Informasi</span>
                      <span class="font-code-inline text-code-inline text-on-surface-variant">25 Sep 2025</span>
                    </div>
                    <h3 class="font-label-md text-label-md text-on-surface font-semibold mt-1">Sosialisasi Tata Tertib Kedisiplinan &amp; Atribut</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Petunjuk baku seragam nasional, batik khas Kediri, dan kartu tanda pelajar digital.</p>
                  </a>
                </div>
              </div>

              <!-- Unduhan Dokumen -->
              <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex flex-col gap-space-md">
                <div class="flex items-center gap-space-xs">
                  <span class="material-symbols-outlined text-[20px] text-secondary">folder_zip</span>
                  <h2 class="font-title-md text-title-md text-on-surface">Unduhan Dokumen Resmi</h2>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Akses berkas digital acuan kurikulum, kalender operasional, dan panduan belajar terverifikasi.</p>
                <div class="flex flex-col gap-space-sm">
                  <div class="flex items-center justify-between p-space-sm rounded-lg bg-surface-container-low gap-space-sm">
                    <div class="flex items-center gap-space-sm min-w-0">
                      <span class="material-symbols-outlined text-error text-[24px] shrink-0">picture_as_pdf</span>
                      <div class="flex flex-col min-w-0">
                        <span class="font-label-md text-label-md text-on-surface truncate">Kalender Akademik 2025/2026</span>
                        <span class="font-code-inline text-code-inline text-on-surface-variant">PDF • 1.2 MB</span>
                      </div>
                    </div>
                    <a class="p-2 text-on-surface hover:bg-surface-container-high rounded-md transition-colors shrink-0" href="#" title="Unduh Berkas" aria-label="Unduh Kalender Akademik">
                      <span class="material-symbols-outlined text-[20px]">download</span>
                    </a>
                  </div>
                  <div class="flex items-center justify-between p-space-sm rounded-lg bg-surface-container-low gap-space-sm">
                    <div class="flex items-center gap-space-sm min-w-0">
                      <span class="material-symbols-outlined text-error text-[24px] shrink-0">picture_as_pdf</span>
                      <div class="flex flex-col min-w-0">
                        <span class="font-label-md text-label-md text-on-surface truncate">Jadwal Ujian PTS Ganjil Lengkap</span>
                        <span class="font-code-inline text-code-inline text-on-surface-variant">PDF • 840 KB</span>
                      </div>
                    </div>
                    <a class="p-2 text-on-surface hover:bg-surface-container-high rounded-md transition-colors shrink-0" href="#" title="Unduh Berkas" aria-label="Unduh Jadwal PTS">
                      <span class="material-symbols-outlined text-[20px]">download</span>
                    </a>
                  </div>
                  <div class="flex items-center justify-between p-space-sm rounded-lg bg-surface-container-low gap-space-sm">
                    <div class="flex items-center gap-space-sm min-w-0">
                      <span class="material-symbols-outlined text-secondary text-[24px] shrink-0">description</span>
                      <div class="flex flex-col min-w-0">
                        <span class="font-label-md text-label-md text-on-surface truncate">Buku Panduan Tata Tertib Siswa</span>
                        <span class="font-code-inline text-code-inline text-on-surface-variant">DOCX • 3.4 MB</span>
                      </div>
                    </div>
                    <a class="p-2 text-on-surface hover:bg-surface-container-high rounded-md transition-colors shrink-0" href="#" title="Unduh Berkas" aria-label="Unduh Buku Panduan">
                      <span class="material-symbols-outlined text-[20px]">download</span>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Mading Digital -->
              <div class="bg-primary-container text-on-primary rounded-xl p-space-lg shadow-sm flex flex-col gap-space-md relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 w-32 h-32 rounded-full bg-secondary/20 pointer-events-none"></div>
                <div class="flex items-center justify-between">
                  <span class="font-label-sm text-label-sm tracking-wider uppercase text-secondary-fixed">Karya Literasi Siswa</span>
                  <span class="material-symbols-outlined text-[20px] text-secondary-fixed">auto_stories</span>
                </div>
                <div class="flex flex-col gap-space-xs">
                  <h2 class="font-headline-sm text-headline-sm text-on-primary">Mading Digital SMANSA Edisi 48</h2>
                  <p class="font-body-sm text-body-sm text-primary-fixed-dim">Menampilkan karya puisi pilihan, karikatur lingkungan, cerpen fiksi sains, dan wawancara inspiratif alumni peraih beasiswa ke Tokyo.</p>
                </div>
                <div class="pt-space-sm">
                  <a class="inline-flex items-center gap-space-xs bg-surface-container-lowest text-on-surface font-label-md text-label-md px-space-md py-2 rounded-lg hover:bg-surface-container-high transition-colors" href="#">
                    <span>Buka Majalah Flipbook</span>
                    <span class="material-symbols-outlined text-[16px]">menu_book</span>
                  </a>
                </div>
              </div>

              <!-- Kontak Humas -->
              <div class="bg-surface-container-low rounded-xl p-space-lg flex flex-col gap-space-sm">
                <span class="font-title-md text-title-md text-on-surface">Kontak Hubungan Masyarakat</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Untuk keperluan liputan media eksternal, konfirmasi prestasi, atau permintaan wawancara dinas:</p>
                <div class="flex flex-col gap-1 text-on-surface font-label-md text-label-md mt-1">
                  <span class="flex items-center gap-2 break-all">
                    <span class="material-symbols-outlined text-[18px] text-secondary shrink-0">mail</span>humas@sman1pare.sch.id
                  </span>
                  <span class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-secondary shrink-0">phone_iphone</span>(0354) 391132 ext. 104
                  </span>
                </div>
              </div>
            </aside>
          </div>

          <!-- Newsletter -->
          <section class="w-full bg-surface-container-low rounded-2xl p-space-lg lg:p-space-xl flex flex-col md:flex-row items-center justify-between gap-space-lg shadow-sm">
            <div class="max-w-xl flex flex-col gap-space-xs">
              <span class="font-label-sm text-label-sm text-secondary font-semibold uppercase tracking-wider">Warta Mingguan Sekolah</span>
              <h2 class="font-headline-md text-headline-md text-on-surface tracking-tight">Dapatkan Berita &amp; Pengumuman Resmi SMAN 1 Pare</h2>
              <p class="font-body-md text-body-md text-on-surface-variant">Daftarkan email orang tua, alumni, atau siswa untuk menerima rangkuman rilis prestasi dan surat edaran sekolah setiap Jumat sore langsung di kotak masuk.</p>
            </div>
            <div class="w-full md:w-auto flex flex-col gap-space-xs shrink-0">
              <form class="flex flex-col sm:flex-row items-stretch gap-space-xs" onsubmit="event.preventDefault(); alert('Terima kasih! Alamat email Anda telah terdaftar pada Warta Mingguan SMAN 1 Pare.');">
                <input class="w-full sm:w-80 px-space-md py-3 rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md shadow-sm focus:outline-none placeholder:text-outline" placeholder="Ketik alamat email aktif..." required type="email" aria-label="Alamat email" />
                <button class="w-full sm:w-auto bg-primary text-on-primary font-label-md text-label-md px-space-lg py-3 rounded-lg hover:bg-surface-container-highest hover:text-on-surface transition-colors cursor-pointer shrink-0 font-semibold" type="submit">
                  Langganan Sekarang
                </button>
              </form>
              <span class="font-label-sm text-[12px] text-on-surface-variant flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">lock</span>
                Bebas spam. Anda dapat berhenti berlangganan kapan saja.
              </span>
            </div>
          </section>
        </div>
      </div>
    </main>

    <footer class="w-full bg-surface-container-lowest">
      <div class="max-w-7xl mx-auto px-gutter-mobile lg:px-gutter py-space-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-xl mb-space-xl">
          <div class="flex flex-col gap-space-md">
            <div class="flex items-center gap-space-sm">
              <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-on-primary">
                <span class="material-symbols-outlined text-[20px]">school</span>
              </div>
              <span class="font-title-md text-title-md text-on-surface">SMAN 1 PARE</span>
            </div>
            <p class="font-body-sm text-body-sm text-on-surface-variant">Mewujudkan generasi unggul, berkarakter mulia, cerdas berwawasan lingkungan dan global.</p>
            <div>
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm">
                <span class="material-symbols-outlined text-[16px]">verified</span>Terakreditasi A Unggul
              </span>
            </div>
          </div>
          <div class="flex flex-col gap-space-sm">
            <span class="font-title-md text-title-md text-on-surface">Alamat &amp; Kontak</span>
            <div class="flex items-start gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
              <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5">location_on</span>
              <span>Jl. Pahlawan Kusuma Bangsa No. 41, Pare, Kediri, Jawa Timur 64211</span>
            </div>
            <div class="flex items-center gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
              <span class="material-symbols-outlined text-[20px] shrink-0">call</span><span>(0354) 391132</span>
            </div>
            <div class="flex items-center gap-space-sm text-on-surface-variant font-body-sm text-body-sm">
              <span class="material-symbols-outlined text-[20px] shrink-0">mail</span><span>info@sman1pare.sch.id</span>
            </div>
          </div>
          <div class="flex flex-col gap-space-sm">
            <span class="font-title-md text-title-md text-on-surface">Layanan Akademik</span>
            <ul class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant">
              <li><a class="hover:text-on-surface transition-colors" data-path="portal-akademik" href="#">Sistem Informasi Akademik (SIAKAD)</a></li>
              <li><a class="hover:text-on-surface transition-colors" data-path="portal-akademik" href="#">Perpustakaan Digital (E-Library)</a></li>
              <li><a class="hover:text-on-surface transition-colors" data-path="portal-akademik" href="#">E-Learning &amp; Penugasan</a></li>
              <li><a class="hover:text-on-surface transition-colors" data-path="portal-akademik" href="#">Pendaftaran Peserta Didik Baru (PPDB)</a></li>
            </ul>
          </div>
          <div class="flex flex-col gap-space-sm">
            <span class="font-title-md text-title-md text-on-surface">Kanal Institusi</span>
            <p class="font-body-sm text-body-sm text-on-surface-variant">Ikuti perkembangan publikasi dan informasi resmi SMAN 1 Pare melalui media komunikasi institusi.</p>
            <div class="flex items-center gap-space-sm">
              <a class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" href="#" aria-label="Website"><span class="material-symbols-outlined text-[18px]">language</span></a>
              <a class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" href="#" aria-label="Portal Publik"><span class="material-symbols-outlined text-[18px]">public</span></a>
              <a class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" href="#" aria-label="Email"><span class="material-symbols-outlined text-[18px]">mail</span></a>
              <a class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" href="#" aria-label="RSS Feed"><span class="material-symbols-outlined text-[18px]">rss_feed</span></a>
            </div>
          </div>
        </div>
        <div class="pt-space-lg flex flex-col sm:flex-row items-center justify-between gap-space-md text-on-surface-variant font-body-sm text-body-sm">
          <p>© 2025 SMA Negeri 1 Pare. Hak Cipta Dilindungi Undang-Undang.</p>
          <div class="flex flex-wrap items-center justify-center gap-space-md sm:gap-space-lg font-label-sm text-label-sm">
            <a class="hover:text-on-surface transition-colors" href="#">Kebijakan Privasi</a>
            <a class="hover:text-on-surface transition-colors" href="#">Syarat &amp; Ketentuan</a>
            <a class="hover:text-on-surface transition-colors" href="#">Peta Situs</a>
          </div>
        </div>
      </div>
    </footer>

    <script>
      (function () {
        'use strict';
        const body = document.body;
        const toggle = document.getElementById('menu-toggle');
        const drawer = document.getElementById('mobile-drawer');
        const overlay = document.getElementById('drawer-overlay');
        const closeBtn = document.getElementById('drawer-close');
        const icon = document.getElementById('menu-icon');

        function openDrawer() {
          drawer.classList.remove('translate-x-full');
          drawer.setAttribute('aria-hidden', 'false');
          overlay.classList.remove('hidden');
          requestAnimationFrame(() => overlay.classList.remove('opacity-0'));
          toggle.setAttribute('aria-expanded', 'true');
          icon.textContent = 'close';
          body.classList.add('no-scroll');
        }
        function closeDrawer() {
          drawer.classList.add('translate-x-full');
          drawer.setAttribute('aria-hidden', 'true');
          overlay.classList.add('opacity-0');
          setTimeout(() => overlay.classList.add('hidden'), 200);
          toggle.setAttribute('aria-expanded', 'false');
          icon.textContent = 'menu';
          body.classList.remove('no-scroll');
        }
        toggle.addEventListener('click', () => {
          drawer.classList.contains('translate-x-full') ? openDrawer() : closeDrawer();
        });
        closeBtn.addEventListener('click', closeDrawer);
        overlay.addEventListener('click', closeDrawer);

        document.addEventListener('keydown', (e) => {
          if (e.key === 'Escape' && !drawer.classList.contains('translate-x-full')) closeDrawer();
        });
        drawer.querySelectorAll('a[data-path]').forEach((link) => {
          link.addEventListener('click', closeDrawer);
        });

        // Tandai halaman aktif (contoh: berita-artikel)
        const currentPath = 'berita-artikel';
        document.querySelectorAll('.nav-link').forEach((el) => {
          if (el.dataset.path === currentPath) {
            el.classList.add('bg-surface-container-high', 'text-on-surface', 'font-semibold');
            el.classList.remove('text-on-surface-variant');
            el.setAttribute('aria-current', 'page');
          }
        });

        // Toggle bahasa
        document.querySelectorAll('.lang-btn').forEach((btn) => {
          btn.addEventListener('click', () => {
            document.querySelectorAll('.lang-btn').forEach((b) => {
              b.classList.remove('bg-surface-container-lowest', 'text-on-surface', 'shadow-sm');
              b.classList.add('text-on-surface-variant');
            });
            btn.classList.add('bg-surface-container-lowest', 'text-on-surface', 'shadow-sm');
            btn.classList.remove('text-on-surface-variant');
          });
        });

        // Bookmark toggle
        document.querySelectorAll('.bookmark-btn').forEach((btn) => {
          btn.addEventListener('click', () => {
            const span = btn.querySelector('.material-symbols-outlined');
            const saved = btn.getAttribute('aria-pressed') === 'true';
            btn.setAttribute('aria-pressed', String(!saved));
            span.textContent = saved ? 'bookmark_border' : 'bookmark';
            span.style.fontVariationSettings = saved ? '"FILL" 0' : '"FILL" 1';
          });
        });

        // Tab filter sederhana
        document.querySelectorAll('.tab-btn').forEach((tab) => {
          tab.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach((t) => {
              t.classList.remove('bg-surface-container-highest', 'font-semibold');
              t.classList.add('bg-surface-container-low', 'text-on-surface-variant');
              t.setAttribute('aria-selected', 'false');
            });
            tab.classList.add('bg-surface-container-highest', 'font-semibold');
            tab.classList.remove('bg-surface-container-low', 'text-on-surface-variant');
            tab.setAttribute('aria-selected', 'true');
          });
        });
      })();
    </script>
  </body>
</html>
