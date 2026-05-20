<?php

namespace App\Services\Teachers;

use App\Models\TeacherModel;

class GetByIdTeachersService
{
    protected $teacherModel;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
    }

    public function execute(int $id)
    {
        return $this->teacherModel->find($id);
    }
}
