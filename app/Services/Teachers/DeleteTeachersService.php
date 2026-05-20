<?php

namespace App\Services\Teachers;

use App\Models\TeacherModel;

class DeleteTeachersService
{
    protected $teacherModel;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
    }

    public function execute(int $id)
    {
        return $this->teacherModel->delete($id);
    }
}
