<?php

namespace App\Services\Classes;

use App\Models\ClassModel;

class DeleteClassesService
{
    protected $classModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
    }

    public function execute(int $id)
    {
        return $this->classModel->delete($id);
    }
}
