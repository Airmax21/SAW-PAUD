<?php

namespace App\Services\Teachers;

use App\Models\TeacherModel;

class UpdateTeachersService
{
    protected $teacherModel, $getByIdTeachersService;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
        $this->getByIdTeachersService = new GetByIdTeachersService();
    }

    public function execute(int $id, array $data)
    {
        $teacher = $this->getByIdTeachersService->execute($id);
        if (!$teacher) return false;

        $teacher->username = $data['username'];
        $teacher->name     = $data['name'];

        // Password hanya di-update jika form password diisi oleh admin/guru
        if (!empty($data['password'])) {
            $teacher->password = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        return $this->teacherModel->update($id, $teacher);
    }
}
