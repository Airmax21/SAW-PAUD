<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
    <div>
        <h2 class="text-4xl font-bold text-gray-900">Manajemen Siswa</h2>
        <p class="text-gray-500 font-medium mt-1">Kelola data dan status penilaian anak-anak PAUD.</p>
    </div>
    <div class="flex items-center gap-4 w-full md:w-auto">
        <div class="relative w-full md:w-64">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input class="w-full pl-12 pr-4 py-3 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary focus:bg-white transition-all text-on-surface shadow-sm" placeholder="Cari nama siswa..." type="text" id="studentSearch" />
        </div>
        <!-- Desktop Add Button -->
        <a href="<?= base_url('student/create') ?>" class="hidden md:flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-full font-bold shadow-lg hover:scale-105 transition-all">
            <span class="material-symbols-outlined">add</span> Tambah Siswa
        </a>
        <!-- Mobile FAB -->
        <a href="<?= base_url('student/create') ?>" class="md:hidden flex-shrink-0 bg-primary text-white p-3 rounded-full font-bold shadow-lg hover:scale-105 transition-all">
            <span class="material-symbols-outlined text-2xl">add</span>
        </a>
    </div>
</div>

<!-- Stats Bento Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-10">
    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-surface-dim flex flex-col justify-between">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 text-blue-600">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">groups</span>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-bold mb-1">Total Siswa</p>
            <p class="text-3xl font-bold text-gray-900"><?= count($students) ?></p>
        </div>
    </div>
</div>

<!-- Student Data Grid - Note: overflow-hidden dihapus agar dropdown bisa keluar -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <!-- Header Filter Row -->
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between bg-gray-50/50 rounded-t-xl gap-4">
        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <span class="material-symbols-outlined text-blue-500">list_alt</span>
            Daftar Anak Didik
        </h3>

        <!-- Filter Kelas Dinamis -->
        <div class="flex flex-wrap gap-2">
            <!-- Tombol Semua -->
            <a href="<?= base_url('student') ?>"
                class="px-5 py-2 text-sm font-bold rounded-full transition-all <?= empty($selectedClass) ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-500 hover:bg-gray-100 border border-gray-200' ?>">
                Semua
            </a>

            <?php foreach ($classes as $class) : ?>
                <a href="<?= base_url('student?class_id=' . $class->id) ?>"
                    class="px-5 py-2 text-sm font-bold rounded-full transition-all <?= ($selectedClass == $class->id) ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-500 hover:bg-gray-100 border border-gray-200' ?>">
                    <?= $class->class_name ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- List Grid -->
    <div class="p-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <?php if (!empty($students)) : ?>
            <?php foreach ($students as $student) : ?>
                <!-- Tambahkan class 'student-card' untuk memudahkan seleksi JS -->
                <div class="student-card bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-4 hover:shadow-md transition-all hover:border-blue-200 relative group">

                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 font-bold text-xl border-4 border-white shadow-sm shrink-0">
                        <?= substr($student->full_name, 0, 1) ?>
                    </div>

                    <div class="flex-1 min-w-0">
                        <h4 class="text-lg font-bold text-gray-900 leading-tight truncate"><?= $student->full_name ?></h4>
                        <div class="flex items-center gap-2 mt-1 mb-2">
                            <span class="px-2 py-0.5 bg-blue-50 text-blue-700 text-xs font-bold rounded-full truncate">
                                <?= $student->class_name ?? 'Tanpa Kelas' ?>
                            </span>
                            <span class="text-xs text-gray-400 font-medium shrink-0">
                                <?= ($student->gender == 'L') ? 'Laki-laki' : 'Perempuan' ?>
                            </span>
                        </div>
                    </div>

                    <!-- Action Menu -->
                    <div class="relative inline-block text-left">
                        <button onclick="toggleMenu(event, <?= $student->id ?>)" class="menu-button w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-colors">
                            <span class="material-symbols-outlined pointer-events-none">more_vert</span>
                        </button>

                        <!-- Dropdown Menu - z-50 agar di depan -->
                        <div id="menu-<?= $student->id ?>" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 z-50">
                            <div class="py-1">
                                <a href="<?= base_url('student/edit/' . $student->id) ?>" class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                    <span class="material-symbols-outlined text-sm">edit</span> Edit Data
                                </a>
                                <a href="<?= base_url('student/delete/' . $student->id) ?>"
                                    class="flex items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <span class="material-symbols-outlined text-sm">delete</span> Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-span-full py-20 text-center">
                <p class="text-gray-400">Belum ada data siswa.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Fungsi toggle menu yang sudah ada (Cara 2 sebelumnya)
    function toggleMenu(event, id) {
        event.stopPropagation();
        const menu = document.getElementById('menu-' + id);
        const card = menu.closest('.student-card');
        const allMenus = document.querySelectorAll('[id^="menu-"]');
        const allCards = document.querySelectorAll('.student-card');

        allMenus.forEach(m => {
            if (m !== menu) m.classList.add('hidden');
        });
        allCards.forEach(c => {
            if (c !== card) c.style.zIndex = "auto";
        });

        const isHidden = menu.classList.toggle('hidden');
        if (!isHidden) {
            card.style.zIndex = "50";
        } else {
            card.style.zIndex = "auto";
        }
    }

    // --- LOGIKA SEARCH DIMULAI DISINI ---
    const searchInput = document.getElementById('studentSearch');

    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const cards = document.querySelectorAll('.student-card');
        let hasResults = false;

        cards.forEach(card => {
            // Ambil nama dari tag h4 di dalam kartu
            const name = card.querySelector('h4').textContent.toLowerCase();

            if (name.includes(filter)) {
                card.style.display = ""; // Tampilkan
                hasResults = true;
            } else {
                card.style.display = "none"; // Sembunyikan
            }
        });

        // Menampilkan pesan jika tidak ada hasil (opsional)
        const emptyState = document.getElementById('emptySearchState');
        if (!hasResults) {
            if (!emptyState) {
                const grid = document.querySelector('.grid.grid-cols-1');
                const msg = document.createElement('div');
                msg.id = 'emptySearchState';
                msg.className = 'col-span-full py-10 text-center text-gray-400';
                msg.innerHTML = `<span class="material-symbols-outlined text-4xl mb-2">search_off</span><p>Nama "${this.value}" tidak ditemukan.</p>`;
                grid.appendChild(msg);
            }
        } else if (emptyState) {
            emptyState.remove();
        }
    });
    // --- LOGIKA SEARCH SELESAI ---

    window.onclick = function(event) {
        if (!event.target.closest('[id^="menu-"]')) {
            document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
            document.querySelectorAll('.student-card').forEach(c => c.style.zIndex = "auto");
        }
    }
</script>
<?= $this->endSection() ?>