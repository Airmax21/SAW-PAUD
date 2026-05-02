<!DOCTYPE html>
<html lang="id">
<?= $this->include('layouts/head') ?>

<body class="bg-background text-on-background min-h-screen flex flex-col md:flex-row font-body">
    <?= $this->include('components/sidebar') ?>
    <main class="flex-1 p-6 md:p-10 lg:p-14 overflow-y-auto w-full relative">
        <?= $this->renderSection('content') ?>
    </main>
</body>

</html>