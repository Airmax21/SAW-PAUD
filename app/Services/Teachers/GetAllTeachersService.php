<?php

namespace App\Services\Teachers;

use App\Models\TeacherModel;

class GetAllTeachersService
{
    protected $teachersModel;

    public function __construct()
    {
        $this->teachersModel = new TeacherModel();
    }

    public function execute()
    {
        return $this->teachersModel->orderBy('name', 'ASC')->findAll();
    }
}
