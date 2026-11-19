<script>
  (function () {
    'use strict';
    const body = document.body;
    const toggle = document.getElementById('menu-toggle');
    const drawer = document.getElementById('mobile-drawer');
    const overlay = document.getElementById('drawer-overlay');
    const closeBtn = document.getElementById('drawer-close');
    const icon = document.getElementById('menu-icon');

    if (toggle && drawer && overlay && closeBtn && icon) {
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
    }

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

    // Tab filter client-side (opsional bila tidak pakai reload halaman)
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

        const selectedCat = tab.dataset.category || 'all';
        document.querySelectorAll('.article-card').forEach((card) => {
          if (selectedCat === 'all' || card.dataset.category === selectedCat) {
            card.classList.remove('hidden');
          } else {
            card.classList.add('hidden');
          }
        });
      });
    });
  })();
</script>
