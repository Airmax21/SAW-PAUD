<?php

namespace App\Services\Classes;

use App\Models\ClassModel;

class GetAllClassesService
{
    protected $classModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
    }

    public function execute()
    {
        return $this->classModel->findAll();
    }
}
