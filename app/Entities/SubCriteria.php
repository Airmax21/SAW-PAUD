<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SubCriteria extends Entity
{
    /**
     * Define datatypes for properties
     * Sangat berguna agar id selalu terbaca sebagai integer
     */
    protected $casts = [
        'id'          => 'integer',
        'criteria_id' => 'integer',
    ];

    /**
     * Opsional: Logic tambahan jika kamu ingin memanipulasi tampilan nama
     * Misalnya: $subCriteria->upper_name akan mengembalikan nama huruf kapital semua
     */
    public function getUpperName()
    {
        return strtoupper($this->attributes['sub_name']);
    }
}
