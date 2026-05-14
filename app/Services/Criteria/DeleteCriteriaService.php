<?php

namespace App\Services\Criteria;

use App\Models\CriteriaModel;
use App\Models\SubCriteriaModel;

class DeleteCriteriaService
{
    protected $criteriaModel;

    public function __construct()
    {
        $this->criteriaModel = new CriteriaModel();
    }

    public function execute(int $id)
    {
        return $this->criteriaModel->delete($id);
    }
}
