<?php

namespace App\Models;

use App\Entities\SubCriteria;
use CodeIgniter\Model;

class SubCriteriaModel extends Model
{
    protected $table = 'sub_criterias';
    protected $allowedFields = ['criteria_id', 'sub_name'];
    protected $returnType = SubCriteria::class;
}
