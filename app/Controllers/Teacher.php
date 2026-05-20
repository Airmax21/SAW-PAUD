<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Services\Teachers\CreateTeachersService;
use App\Services\Teachers\DeleteTeachersService;
use App\Services\Teachers\GetAllTeachersService;
use App\Services\Teachers\GetByIdTeachersService;
use App\Services\Teachers\UpdateTeachersService;

class Teacher extends BaseController
{
    protected $getAllTeacherService;
    protected $getByIdTeacherService;
    protected $createTeacherService;
    protected $updateTeacherService;
    protected $deleteTeacherService;
    protected $classModel;

    public function __construct()
    {
        $this->getAllTeacherService = new GetAllTeachersService();
        $this->getByIdTeacherService = new GetByIdTeachersService();
        $this->createTeacherService = new CreateTeachersService();
        $this->updateTeacherService = new UpdateTeachersService();
        $this->deleteTeacherService = new DeleteTeachersService();
        $this->classModel = new ClassModel();
    }
    public function index()
    {
        // Menampilkan manajemen user/guru
        $data = [
            'title'    => 'Manajemen Guru',
            'teachers' => $this->getAllTeacherService->execute()
        ];
        return view('pages/teacher/index', $data);
    }

    public function store()
    {
        // Menyimpan user/guru
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|is_unique[teachers.username]',
            'name'     => 'required|min_length[3]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->createTeacherService->execute($this->request->getPost());
        return redirect()->to('teacher')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function update(int $id)
    {
        // Update user/guru
        $rules = [
            'username' => "required|alpha_numeric_space|min_length[3]|is_unique[teachers.username,id,{$id}]",
            'name'     => 'required|min_length[3]',
            'password' => 'permit_empty|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->updateTeacherService->execute($id, $this->request->getPost());
        return redirect()->to('teacher')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        // Cegah user menghapus dirinya sendiri yang sedang login
        if (session()->get('teacher_id') == $id) {
            return redirect()->to('teacher')->with('errors', ['Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan.']);
        }

        $this->deleteTeacherService->execute($id);
        return redirect()->to('teacher')->with('success', 'Data guru berhasil dihapus dari sistem.');
    }
}
