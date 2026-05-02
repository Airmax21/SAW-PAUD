<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Evaluation extends Entity
{
    protected $casts = [
        'value' => 'float',
    ];

    public function getLabel()
    {
        $val = (int) $this->attributes['value'];
        return match ($val) {
            4 => 'BSB (Sangat Baik)',
            3 => 'BSH (Sesuai Harapan)',
            2 => 'MB (Mulai Berkembang)',
            1 => 'BB (Belum Berkembang)',
            default => '-'
        };
    }
}
