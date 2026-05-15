<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Evaluation;

class EvaluationModel extends Model
{
    protected $table = 'evaluations';
    protected $returnType = Evaluation::class;
    protected $allowedFields = ['student_id', 'criteria_id', 'value', 'period'];
    protected $useTimestamps = true;
}
