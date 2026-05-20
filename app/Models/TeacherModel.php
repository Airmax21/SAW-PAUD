<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Teacher;

class TeacherModel extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $returnType = Teacher::class;
    protected $allowedFields = ['username', 'name', 'password'];
    protected $useTimestamps = true;
}
