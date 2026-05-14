<?php

namespace App\Services\Criteria;

use App\Models\CriteriaModel;
use App\Models\SubCriteriaModel;

class CreateCriteriaService
{
    protected $criteriaModel;
    protected $subCriteriaModel;

    public function __construct()
    {
        $this->criteriaModel = new CriteriaModel();
        $this->subCriteriaModel = new SubCriteriaModel();
    }

    public function execute(array $data)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Simpan Kriteria Utama
        $criteriaId = $this->criteriaModel->insert([
            'code'          => strtoupper($data['code']),
            'criteria_name' => $data['criteria_name'],
            'weight'        => 0,
            'type'          => $data['type'],
        ]);

        // 2. Proses Sub-Kriteria (Pemisah Koma)
        if (!empty($data['sub_names'])) {
            // Cek apakah inputnya masih string (hasil input textarea/text)
            $inputSubs = $data['sub_names'];

            // Ubah string "A, B, C" menjadi array ["A", "B", "C"]
            $subsArray = is_string($inputSubs) ? explode(',', $inputSubs) : $inputSubs;

            foreach ($subsArray as $s) {
                $name = trim($s); // Bersihkan spasi liar
                if ($name !== "") {
                    $this->subCriteriaModel->insert([
                        'criteria_id' => $criteriaId,
                        'sub_name'    => $name
                    ]);
                }
            }
        }

        $db->transComplete();
        return $db->transStatus();
    }
}
