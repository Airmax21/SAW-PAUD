<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<main class="p-6 md:p-10 max-w-6xl mx-auto w-full flex-1">
    <!-- Page Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-4xl font-black text-on-background mb-2">Pengaturan Kriteria</h2>
            <p class="text-outline font-medium text-lg">Sesuaikan bobot prioritas untuk setiap aspek perkembangan anak.</p>
        </div>

        <?php
        $totalWeight = 0;
        foreach ($criterias as $c) $totalWeight += (float)$c->weight;
        ?>

        <div class="flex items-center gap-3 bg-secondary-container px-5 py-3 rounded-full shadow-[0_4px_16px_rgba(124,82,170,0.1)] transition-colors duration-500" id="weightContainer">
            <span class="font-bold text-secondary">Total Bobot:</span>
            <span id="totalWeightDisplay" class="text-xl font-black text-primary"><?= $totalWeight ?>%</span>
        </div>
    </div>

    <?= $this->include('components/alert') ?>

    <form action="<?= base_url('criteria/update') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <?php foreach ($criterias as $crit): ?>
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-[0_8px_24px_rgba(224,64,160,0.08)] border-2 border-primary-fixed hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-fixed rounded-bl-full -z-10 opacity-50 group-hover:scale-110 transition-transform"></div>

                    <!-- Action Delete Button -->
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity z-20">
                        <button type="button"
                            onclick="openDeleteModal('<?= base_url('criteria/delete/' . $crit->id) ?>', '<?= $crit->criteria_name ?>')"
                            class="w-10 h-10 bg-red-50 text-red-600 rounded-full flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </div>

                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-3">
                            <div class="bg-primary text-on-primary p-3 rounded-xl shadow-[0_4px_12px_rgba(224,64,160,0.3)]">
                                <span class="material-symbols-outlined text-3xl">
                                    <?= ($crit->code == 'C1') ? 'psychology' : 'sports_gymnastics' ?>
                                </span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-on-background"><?= $crit->criteria_name ?></h3>
                                <span class="bg-primary-fixed text-on-primary-fixed-variant text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider"><?= $crit->type ?></span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-black text-primary mb-1" id="label-<?= $crit->id ?>"><?= (float)$crit->weight ?>%</div>
                            <div class="text-sm font-medium text-outline"><?= $crit->code ?></div>
                        </div>
                    </div>

                    <!-- Slider -->
                    <div class="mb-8">
                        <input name="weights[<?= $crit->id ?>]" class="weight-slider w-full h-3 bg-surface-variant rounded-full appearance-none slider-thumb outline-none focus:ring-4 focus:ring-primary-fixed"
                            max="100" min="0" type="range" value="<?= (float)$crit->weight ?>" data-id="<?= $crit->id ?>" />
                    </div>

                    <!-- Sub Kriteria -->
                    <div class="bg-surface-container-low rounded-lg p-4">
                        <h4 class="font-bold text-secondary mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">subdirectory_arrow_right</span>
                            Sub-kriteria Penilaian
                        </h4>
                        <div class="space-y-3">
                            <?php if (!empty($crit->subs)): ?>
                                <?php foreach ($crit->subs as $sub): ?>
                                    <div class="flex justify-between items-center bg-surface-container-lowest p-3 rounded-lg border border-outline-variant shadow-sm hover:border-primary-fixed transition-colors">
                                        <span class="font-medium text-on-surface-variant"><?= $sub->sub_name ?></span>
                                        <span class="bg-secondary-container text-secondary font-bold px-3 py-1 rounded-full text-[10px]">SAW</span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-xs text-outline italic">Belum ada indikator penilaian.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Add New Criteria Card -->
            <button type="button" onclick="document.getElementById('modalAdd').classList.remove('hidden')" class="bg-surface-container-low rounded-xl p-6 border-2 border-dashed border-outline-variant hover:border-primary hover:bg-primary-fixed/20 transition-all duration-300 flex flex-col items-center justify-center min-h-[300px] group">
                <div class="bg-surface-container-lowest p-4 rounded-full shadow-sm mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-on-primary transition-all duration-300">
                    <span class="material-symbols-outlined text-4xl text-outline group-hover:text-on-primary">add</span>
                </div>
                <h3 class="text-xl font-bold text-secondary group-hover:text-primary">Tambah Kriteria Baru</h3>
                <p class="text-outline font-medium mt-2 text-center max-w-xs">Tambahkan aspek penilaian lainnya seperti Sosial-Emosional.</p>
            </button>
        </div>

        <!-- Save Action Bar -->
        <div class="mt-10 bg-surface-container-lowest p-6 rounded-xl shadow-[0_8px_30px_rgba(224,64,160,0.15)] border border-primary-fixed flex flex-col sm:flex-row justify-between items-center gap-4 sticky bottom-6 z-10 backdrop-blur-sm bg-white/90">
            <div class="flex items-center gap-3">
                <div class="bg-tertiary-container text-on-tertiary-container p-2 rounded-full">
                    <span class="material-symbols-outlined">info</span>
                </div>
                <p class="font-medium text-on-surface">Pastikan total bobot kriteria mencapai 100% sebelum menyimpan.</p>
            </div>
            <button type="submit" class="w-full sm:w-auto bg-primary text-on-primary font-bold text-lg px-8 py-4 rounded-full shadow-[0_4px_16px_rgba(224,64,160,0.4)] hover:scale-105 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span>
                Simpan Pengaturan
            </button>
        </div>
    </form>
</main>

<!-- Includes Components -->
<?= $this->include('components/modal_add_criteria') ?>
<?= $this->include('components/modal_delete_criteria') ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliders = document.querySelectorAll('.weight-slider');
        const totalDisplay = document.getElementById('totalWeightDisplay');
        const weightContainer = document.getElementById('weightContainer');

        function updateTotal() {
            let total = 0;
            sliders.forEach(s => total += parseFloat(s.value));
            totalDisplay.textContent = total + '%';

            if (total === 100) {
                weightContainer.classList.replace('bg-secondary-container', 'bg-primary-container');
                totalDisplay.classList.replace('text-primary', 'text-on-primary-container');
            } else {
                weightContainer.classList.replace('bg-primary-container', 'bg-secondary-container');
                totalDisplay.classList.replace('text-on-primary-container', 'text-primary');
            }
        }

        sliders.forEach(slider => {
            slider.addEventListener('input', function() {
                document.getElementById('label-' + this.dataset.id).textContent = this.value + '%';
                updateTotal();
            });
        });

        updateTotal();
    });
</script>

<?= $this->endSection() ?>