<?php

namespace App\Services\Students;

use App\Models\StudentModel;

class UpdateStudentsService
{
    protected $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    public function execute(int $id, array $data)
    {
        return $this->studentModel->update($id, $data);
    }
}
