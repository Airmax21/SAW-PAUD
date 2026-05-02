<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Criteria extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'weight' => 'float',
    ];

    public function getWeightPercentage()
    {
        return $this->attributes['weight'] . '%';
    }
}
