<?php
// app/Models/StudentModel.php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Student;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $returnType = Student::class;
    protected $allowedFields = ['full_name', 'gender', 'class_id'];
    protected $useTimestamps = true;

    public function gethWithClass()
    {
        return $this->select('students.*, classes.class_name')
            ->join('classes', 'classes.id = students.class_id', 'left')
            ->findAll();
    }
}
