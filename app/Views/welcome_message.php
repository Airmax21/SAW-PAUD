<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
    <div>
        <h2 class="text-4xl font-headline font-bold text-on-background mb-2">Manajemen Siswa</h2>
        <p class="text-on-surface-variant font-medium text-lg">Kelola data dan status penilaian anak-anak PAUD.</p>
    </div>
    <div class="flex items-center gap-4 w-full md:w-auto">
        <div class="relative w-full md:w-64">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input class="w-full pl-12 pr-4 py-3 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary focus:bg-white transition-all text-on-surface shadow-sm" placeholder="Cari nama siswa..." type="text" />
        </div>
        <!-- Mobile FAB CTA -->
        <button class="md:hidden flex-shrink-0 bg-primary text-white p-3 rounded-full font-bold shadow-[0_4px_16px_rgba(224,64,160,0.2)] hover:scale-105 transition-all bouncy-spring">
            <span class="material-symbols-outlined text-2xl">add</span>
        </button>
    </div>
</div>
<!-- Stats Bento Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-10">
    <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-[0_8px_24px_rgba(124,82,170,0.08)] hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between">
        <div class="w-12 h-12 bg-primary-container rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">groups</span>
        </div>
        <div>
            <p class="text-on-surface-variant text-sm font-bold mb-1">Total Siswa</p>
            <p class="text-3xl font-headline font-bold text-on-background">42</p>
        </div>
    </div>
    <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-[0_8px_24px_rgba(124,82,170,0.08)] hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between">
        <div class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
        </div>
        <div>
            <p class="text-on-surface-variant text-sm font-bold mb-1">Selesai Dinilai</p>
            <p class="text-3xl font-headline font-bold text-on-background">28</p>
        </div>
    </div>
    <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-[0_8px_24px_rgba(124,82,170,0.08)] hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between">
        <div class="w-12 h-12 bg-tertiary-container rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-tertiary text-2xl" style="font-variation-settings: 'FILL' 1;">pending</span>
        </div>
        <div>
            <p class="text-on-surface-variant text-sm font-bold mb-1">Belum Dinilai</p>
            <p class="text-3xl font-headline font-bold text-on-background">14</p>
        </div>
    </div>
    <div class="bg-gradient-to-br from-primary to-secondary rounded-DEFAULT p-6 shadow-[0_8px_24px_rgba(224,64,160,0.2)] hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between text-white">
        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-white text-2xl" style="font-variation-settings: 'FILL' 1;">star</span>
        </div>
        <div>
            <p class="text-white/80 text-sm font-bold mb-1">Bulan Ini</p>
            <p class="text-3xl font-headline font-bold text-white">Agustus</p>
        </div>
    </div>
</div>
<!-- Student Data Bento/Table View -->
<div class="bg-surface-container-lowest rounded-lg shadow-[0_8px_30px_rgba(124,82,170,0.06)] overflow-hidden">
    <!-- Header Filter Row -->
    <div class="px-6 py-5 border-b border-surface-dim flex items-center justify-between bg-surface-container-low/50">
        <h3 class="text-xl font-headline font-bold text-on-background flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary">list_alt</span>
            Daftar Anak Didik
        </h3>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-primary-fixed text-on-primary-container text-sm font-bold rounded-full hover:bg-primary-container transition-colors">Semua</button>
            <button class="px-4 py-2 bg-surface text-on-surface-variant text-sm font-bold rounded-full hover:bg-surface-container-high transition-colors">TK-A</button>
            <button class="px-4 py-2 bg-surface text-on-surface-variant text-sm font-bold rounded-full hover:bg-surface-container-high transition-colors">TK-B</button>
        </div>
    </div>
    <!-- List/Grid -->
    <div class="p-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <!-- Student Card 1 -->
        <div class="bg-surface rounded-DEFAULT border border-surface-dim p-4 flex items-center gap-4 hover:shadow-[0_4px_16px_rgba(124,82,170,0.1)] transition-shadow hover:border-secondary-fixed">
            <img alt="Budi Santoso" class="w-16 h-16 rounded-full object-cover border-4 border-primary-fixed" data-alt="A portrait of a cheerful little boy, around 5 years old, looking at the camera with a big smile. He has short dark hair. The background is a soft, blurred pastel playground setting, consistent with a joyful pop light-mode aesthetic. High key lighting, vibrant but soft colors." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYJyxcMQNMZoVEhq8SrHmK-bcT42okI5p62Dx9iH0uogTxG-Zi0pYwEaociONgvTvh_GDIgCClzqE6a0Mvpic3Av5I2UmJazLX-Uxgq5w9QiPdE2CS5ME8DL7usKzaXWBVCyzHDOcBI8i1fnVOXfxUNNugBzxfzOQ55bJqfnf8rHjg89mgmzrzNMv-7qmG5caxhK0qd3no1TZppVQGL_CqvC3L6g62N8v293AGiYgfwopaK0KzipZHNsRrwue8mtUpCLKaqs-4wMVa" />
            <div class="flex-1">
                <h4 class="text-lg font-headline font-bold text-on-background leading-tight">Budi Santoso</h4>
                <div class="flex items-center gap-2 mt-1 mb-2">
                    <span class="px-2 py-0.5 bg-secondary-container text-on-secondary-container text-xs font-bold rounded-full">TK-A</span>
                    <span class="text-xs text-outline font-medium">Laki-laki</span>
                </div>
                <div class="flex items-center gap-1 text-sm text-tertiary">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <span class="font-bold">Sudah Dinilai</span>
                </div>
            </div>
            <button class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-outline hover:bg-primary hover:text-white transition-colors bouncy-spring">
                <span class="material-symbols-outlined">more_vert</span>
            </button>
        </div>
        <!-- Student Card 2 -->
        <div class="bg-surface rounded-DEFAULT border border-surface-dim p-4 flex items-center gap-4 hover:shadow-[0_4px_16px_rgba(124,82,170,0.1)] transition-shadow hover:border-secondary-fixed">
            <img alt="Siti Aminah" class="w-16 h-16 rounded-full object-cover border-4 border-secondary-fixed" data-alt="A portrait of a happy little girl, around 4 years old, laughing. She is wearing a light pink dress. The background is a bright, soft-focus classroom with colorful toys, matching a playful candy UI aesthetic. High quality, clear, bright lighting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCD6PMJrrE9_k9h8U7tyiQvwRhSRVSOnOrsTEIQYbAZuvSXT3fdcJ5_DS5bsEZ_5RqQufVd_-EKmOO0miKj63iwveWPizHwxrFu7eaOnjezJ4oU-DHPXX0fwQxHxt5qfQ9BbKWfWRFpdv8Lg0xHg8nCRDV18Sh5MTTYuPfAi9SAQ81z6TlE4ar8FHbyhWvWX7GhTCSjUmAJwttI07MP81rKL032Im_m6MrQ1Bj8H5vcXibgxnlFrqUMCIMnG_jIAH5rhZxrUDCJjeHb" />
            <div class="flex-1">
                <h4 class="text-lg font-headline font-bold text-on-background leading-tight">Siti Aminah</h4>
                <div class="flex items-center gap-2 mt-1 mb-2">
                    <span class="px-2 py-0.5 bg-secondary-container text-on-secondary-container text-xs font-bold rounded-full">TK-B</span>
                    <span class="text-xs text-outline font-medium">Perempuan</span>
                </div>
                <div class="flex items-center gap-1 text-sm text-error">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">pending</span>
                    <span class="font-bold">Belum Dinilai</span>
                </div>
            </div>
            <button class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-outline hover:bg-primary hover:text-white transition-colors bouncy-spring">
                <span class="material-symbols-outlined">more_vert</span>
            </button>
        </div>
        <!-- Student Card 3 -->
        <div class="bg-surface rounded-DEFAULT border border-surface-dim p-4 flex items-center gap-4 hover:shadow-[0_4px_16px_rgba(124,82,170,0.1)] transition-shadow hover:border-secondary-fixed">
            <img alt="Arif Rahman" class="w-16 h-16 rounded-full object-cover border-4 border-tertiary-fixed" data-alt="A portrait of a young boy, about 6 years old, holding a colorful drawing. He looks proud and happy. The setting is bright and cheerful, with soft pastel tones dominating the scene. The lighting is sunny and warm, evoking a joyful, energetic mood." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBAq8GTcsbrOqytwYRy5wrqZOWwdVMJlCc-eJr7qW73PGFUy3nQD7V4iYHGFQv8JL-_fdG5rZx__LC8q3mvXjrGkQ65VZigEbV64-voVKOxYpHKybUgfVzbmBEJODNW2HATnhb2Hx3YFmz15iXh6-PUfAT8DxKGvDcajfKskpgDvVODUTGSw6_LAl0i-IDR2VXdRRruRaxHeAiQfBlMnUcmNdknO6k_EQpqj5IMkRvTL0IJzs4KXX4khXtUsDugj0ztfLZ2KQMdkAim" />
            <div class="flex-1">
                <h4 class="text-lg font-headline font-bold text-on-background leading-tight">Arif Rahman</h4>
                <div class="flex items-center gap-2 mt-1 mb-2">
                    <span class="px-2 py-0.5 bg-secondary-container text-on-secondary-container text-xs font-bold rounded-full">TK-A</span>
                    <span class="text-xs text-outline font-medium">Laki-laki</span>
                </div>
                <div class="flex items-center gap-1 text-sm text-tertiary">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <span class="font-bold">Sudah Dinilai</span>
                </div>
            </div>
            <button class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-outline hover:bg-primary hover:text-white transition-colors bouncy-spring">
                <span class="material-symbols-outlined">more_vert</span>
            </button>
        </div>
    </div>
    <div class="p-4 border-t border-surface-dim bg-surface-container-low/30 text-center">
        <button class="text-primary font-bold hover:text-primary-container transition-colors inline-flex items-center gap-2">
            Lihat Lebih Banyak
            <span class="material-symbols-outlined">expand_more</span>
        </button>
    </div>
</div>
<?= $this->endSection() ?>