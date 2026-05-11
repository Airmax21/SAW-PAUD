<?php

namespace App\Services\Students;

use App\Entities\Student;
use App\Models\StudentModel;

class CreateStudentsService
{
    protected $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    public function execute(array $data)
    {   
        $student = new Student($data);
        return $this->studentModel->save($student);
    }
}
