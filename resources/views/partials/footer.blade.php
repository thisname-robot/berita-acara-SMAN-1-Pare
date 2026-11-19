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
        <p class="font-body-sm text-body-sm text-on-surface-variant">
          Mewujudkan generasi unggul, berkarakter mulia, cerdas berwawasan lingkungan dan global.
        </p>
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
          <li><a class="hover:text-on-surface transition-colors" href="{{ url('/portal-akademik/siakad') }}">Sistem Informasi Akademik (SIAKAD)</a></li>
          <li><a class="hover:text-on-surface transition-colors" href="{{ url('/portal-akademik/e-library') }}">Perpustakaan Digital (E-Library)</a></li>
          <li><a class="hover:text-on-surface transition-colors" href="{{ url('/portal-akademik/e-learning') }}">E-Learning &amp; Penugasan</a></li>
          <li><a class="hover:text-on-surface transition-colors" href="{{ url('/ppdb') }}">Pendaftaran Peserta Didik Baru (PPDB)</a></li>
        </ul>
      </div>

      <div class="flex flex-col gap-space-sm">
        <span class="font-title-md text-title-md text-on-surface">Kanal Institusi</span>
        <p class="font-body-sm text-body-sm text-on-surface-variant">
          Ikuti perkembangan publikasi dan informasi resmi SMAN 1 Pare melalui media komunikasi institusi.
        </p>
        <div class="flex items-center gap-space-sm">
          <a class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" href="#" aria-label="Website"><span class="material-symbols-outlined text-[18px]">language</span></a>
          <a class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" href="#" aria-label="Portal Publik"><span class="material-symbols-outlined text-[18px]">public</span></a>
          <a class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" href="mailto:info@sman1pare.sch.id" aria-label="Email"><span class="material-symbols-outlined text-[18px]">mail</span></a>
          <a class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" href="#" aria-label="RSS Feed"><span class="material-symbols-outlined text-[18px]">rss_feed</span></a>
        </div>
      </div>
    </div>

    <div class="pt-space-lg flex flex-col sm:flex-row items-center justify-between gap-space-md text-on-surface-variant font-body-sm text-body-sm">
      <p>© {{ date('Y') }} SMA Negeri 1 Pare. Hak Cipta Dilindungi Undang-Undang.</p>
      <div class="flex flex-wrap items-center justify-center gap-space-md sm:gap-space-lg font-label-sm text-label-sm">
        <a class="hover:text-on-surface transition-colors" href="{{ url('/kebijakan-privasi') }}">Kebijakan Privasi</a>
        <a class="hover:text-on-surface transition-colors" href="{{ url('/syarat-ketentuan') }}">Syarat &amp; Ketentuan</a>
        <a class="hover:text-on-surface transition-colors" href="{{ url('/peta-situs') }}">Peta Situs</a>
      </div>
    </div>
  </div>
</footer>
