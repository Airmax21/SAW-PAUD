<?php

namespace App\Services\Criteria;

use App\Models\CriteriaModel;
use App\Models\SubCriteriaModel;

class GetCriteriaService
{
    protected $criteriaModel;
    protected $subCriteriaModel;

    public function __construct()
    {
        $this->criteriaModel = new CriteriaModel();
        $this->subCriteriaModel = new SubCriteriaModel();
    }

    /**
     * Mengambil kriteria dengan sub-kriterianya (Eager Loading manual)
     */
    public function execute(): array
    {
        // Ambil semua kriteria diurutkan berdasarkan kode (C1, C2, dst)
        $criterias = $this->criteriaModel->orderBy('code', 'ASC')->findAll();

        foreach ($criterias as $criteria) {
            // Tempelkan data sub-kriteria ke properti dinamis 'subs'
            $criteria->subs = $this->subCriteriaModel
                ->where('criteria_id', $criteria->id)
                ->findAll();
        }

        return $criterias;
    }
}
