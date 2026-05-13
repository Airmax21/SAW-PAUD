<?php

namespace App\Services\Classes;

use App\Entities\StudentClass;
use App\Models\ClassModel;

class CreateClassesService
{
    protected $classModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
    }

    public function execute(array $data)
    {   
        $class = new StudentClass($data);
        return $this->classModel->save($class);
    }
}
