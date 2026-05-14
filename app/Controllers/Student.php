<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Services\Students\CreateStudentsService;
use App\Services\Students\DeleteStudentsService;
use App\Services\Students\GetAllStudentsService;
use App\Services\Students\GetByIdStudentsService;
use App\Services\Students\UpdateStudentsService;

class Student extends BaseController
{
    protected $getAllStudentService;
    protected $getByIdStudentService;
    protected $createStudentService;
    protected $updateStudentService;
    protected $deleteStudentService;
    protected $classModel;

    public function __construct()
    {
        $this->getAllStudentService = new GetAllStudentsService();
        $this->getByIdStudentService = new GetByIdStudentsService();
        $this->createStudentService = new CreateStudentsService();
        $this->updateStudentService = new UpdateStudentsService();
        $this->deleteStudentService = new DeleteStudentsService();
        $this->classModel = new ClassModel();
    }

    public function index()
    {
        $selectedClass = $this->request->getVar('class_id');

        $data = [
            'title'         => 'Manajemen Siswa',
            'students'      => $this->getAllStudentService->execute($selectedClass ? (int)$selectedClass : null),
            'classes'       => $this->classModel->findAll(), // Tambahkan ini
            'selectedClass' => $selectedClass // Untuk menandai tombol mana yang aktif
        ];
        return view('pages/student/index', $data);
    }

    public function create()
    {
        return view('pages/student/form', [
            'title'   => 'Tambah Siswa Baru',
            'student' => new \App\Entities\Student(),
            'classes' => $this->classModel->findAll(),
            'action'  => base_url('student/store')
        ]);
    }

    public function store()
    {
        $rules = [
            'full_name' => 'required|min_length[3]',
            'gender'    => 'required|in_list[L,P]',
            'class_id'  => 'required|is_not_unique[classes.id]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->createStudentService->execute($this->request->getPost());

        return redirect()->to('/student')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $student = $this->getByIdStudentService->execute($id);
        if (!$student) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('pages/student/form', [
            'title'   => 'Edit Data Siswa',
            'student' => $student, // Kirim data yang ada
            'classes' => $this->classModel->findAll(),
            'action'  => base_url('student/update/' . $id)
        ]);
    }

    public function update($id)
    {
        $rules = [
            'full_name' => 'required|min_length[3]',
            'gender'    => 'required|in_list[L,P]',
            'class_id'  => 'required|is_not_unique[classes.id]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->updateStudentService->execute($id, $this->request->getPost());

        return redirect()->to('/student')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->deleteStudentService->execute($id);
        return redirect()->to('/student')->with('success', 'Data siswa berhasil dihapus.');
    }
}
