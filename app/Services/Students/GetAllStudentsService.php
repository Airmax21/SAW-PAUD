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
        $builder = $this->studentModel
            ->select('students.*, classes.class_name')
            ->join('classes', 'classes.id = students.class_id', 'left');

        if ($classId) {
            $builder->where('students.class_id', $classId);
        }

        return $builder->orderBy('students.full_name', 'ASC')->findAll();
    }
}
