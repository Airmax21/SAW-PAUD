<?php

namespace App\Services\Criteria;

use App\Models\CriteriaModel;

class UpdateCriteriaService
{
    protected $criteriaModel;

    public function __construct()
    {
        $this->criteriaModel = new CriteriaModel();
    }

    public function execute(array $weights)
    {
        // 1. Validasi logika bisnis: Total bobot harus 100%
        if (array_sum($weights) != 100) {
            throw new \Exception('Gagal menyimpan! Total bobot kriteria harus tepat 100%. Saat ini: ' . array_sum($weights) . '%');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        foreach ($weights as $id => $weight) {
            $this->criteriaModel->update($id, ['weight' => $weight]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            throw new \Exception('Terjadi kesalahan saat memperbarui database.');
        }

        return true;
    }
}
