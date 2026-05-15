<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
    <div>
        <h2 class="text-4xl font-bold text-gray-900">Manajemen Kelas</h2>
        <p class="text-gray-500 font-medium mt-1">Kelola kelompok belajar dan tahun akademik PAUD.</p>
    </div>
</div>

<?= $this->include('components/alert') ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- Form Tambah Kelas (Sidebar Form Style) -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-gray-200/50 border border-gray-100 sticky top-10">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">add_circle</span>
                Tambah Kelas
            </h3>
            <form action="<?= base_url('class/store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-black text-gray-700 uppercase tracking-widest mb-2 ml-1">Nama Kelas</label>
                        <input type="text" name="class_name"
                            class="w-full px-5 py-4 bg-gray-50 rounded-2xl border-2 border-transparent focus:border-primary focus:bg-white transition-all outline-none"
                            placeholder="Contoh: Kelompok A1" value="<?= old('class_name') ?>">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-700 uppercase tracking-widest mb-2 ml-1">Tahun Akademik</label>
                        <input type="text" name="academic_year"
                            class="w-full px-5 py-4 bg-gray-50 rounded-2xl border-2 border-transparent focus:border-primary focus:bg-white transition-all outline-none"
                            placeholder="Contoh: 2025/2026" value="<?= old('academic_year', date('Y') . '/' . (date('Y') + 1)) ?>">
                    </div>
                    <button type="submit" class="w-full py-4 bg-gray-900 text-white rounded-2xl font-bold shadow-lg hover:bg-primary transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span> Simpan Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Kelas (Grid Style) -->
    <div class="lg:col-span-2">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if (!empty($classes)) : ?>
                <?php foreach ($classes as $item) : ?>
                    <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all group relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="<?= base_url('class/delete/' . $item->id) ?>"
                                onclick="return confirm('Hapus kelas ini? Murid di dalamnya akan kehilangan relasi kelas.')"
                                class="w-10 h-10 bg-red-50 text-red-500 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </a>
                        </div>

                        <div class="w-14 h-14 bg-primary-container rounded-2xl flex items-center justify-center text-primary mb-4">
                            <span class="material-symbols-outlined text-3xl">school</span>
                        </div>

                        <h4 class="text-xl font-bold text-gray-900"><?= $item->class_name ?></h4>
                        <p class="text-gray-500 text-sm font-medium mt-1">Tahun: <?= $item->academic_year ?></p>

                        <div class="mt-6 flex items-center gap-2">
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">
                                PAUD Activity
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-span-full bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200 py-20 text-center">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-4">inventory_2</span>
                    <p class="text-gray-400 font-medium">Belum ada data kelas.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>