<?php

namespace App\Services\Students;

use App\Models\StudentModel;

class DeleteStudentsService
{
    protected $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    public function execute(int $id)
    {
        return $this->studentModel->delete($id);
    }
}
