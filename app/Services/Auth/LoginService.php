<?php

namespace App\Services\Auth;

use App\Models\TeacherModel;

class LoginService
{
    protected $teacherModel;
    protected $session;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
        $this->session      = \Config\Services::session();
    }

    public function execute(string $username, string $password): bool
    {
        // Cari guru berdasarkan username
        $teacher = $this->teacherModel->where('username', $username)->first();

        // Jika guru tidak ditemukan atau password salah
        if (!$teacher || !$teacher->verifyPassword($password)) {
            return false;
        }

        // Set data ke dalam session jika login berhasil
        $this->session->set([
            'is_logged_in' => true,
            'teacher_id'   => $teacher->id,
            'teacher_name' => $teacher->name,
            'username'     => $teacher->username,
        ]);

        return true;
    }
}
