<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Teacher extends Entity
{
    protected $casts = [
        'id' => 'integer',
    ];

    // Method untuk memverifikasi password saat login
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->attributes['password']);
    }
}