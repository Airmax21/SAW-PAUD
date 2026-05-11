<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-2xl border border-green-200 flex items-center gap-3 animate-fade-in">
        <span class="material-symbols-outlined">check_circle</span>
        <p class="text-sm font-bold"><?= session()->getFlashdata('success') ?></p>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-2xl border border-red-100 flex items-center gap-3 animate-fade-in">
        <span class="material-symbols-outlined">error</span>
        <div class="text-sm">
            <p class="font-bold mb-1">Terjadi kesalahan input:</p>
            <ul class="list-disc list-inside text-xs opacity-80">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>