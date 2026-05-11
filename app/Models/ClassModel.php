<?php

namespace App\Models;

use App\Entities\StudentClass;
use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $returnType = StudentClass::class;
    protected $allowedFields = ['class_name', 'academic_year'];
}
