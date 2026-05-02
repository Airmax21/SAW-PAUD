<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Criteria;

class CriteriaModel extends Model
{
    protected $table = 'criterias';
    protected $allowedFields = ['criteria_name', 'weight', 'type'];
    protected $useTimestamps = true;
    protected $returnType = Criteria::class;
}
