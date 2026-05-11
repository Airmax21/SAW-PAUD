<?php

namespace App\Services\Students;

use App\Models\StudentModel;

class GetAllStudentsService
{
    protected $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    public function execute(?int $classId = null)
    {
        if ($classId) {
            return $this->studentModel->where('class_id', $classId)->findAll();
        }
        return $this->studentModel->findAll();
    }
}
