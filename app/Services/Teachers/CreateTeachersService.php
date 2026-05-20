<?php

namespace App\Services\Teachers;

use App\Entities\Teacher;
use App\Models\TeacherModel;

class CreateTeachersService
{
    protected $teacherModel;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
    }

    public function execute(array $data)
    {   
        $teacher = new Teacher();
        $teacher->username = $data['username'];
        $teacher->name     = $data['name'];
        $teacher->password = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->teacherModel->insert($teacher);
    }
}
