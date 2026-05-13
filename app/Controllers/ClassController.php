<?php

namespace App\Controllers;

use App\Services\Classes\CreateClassesService;
use App\Services\Classes\DeleteClassesService;
use App\Services\Classes\GetAllClassesService;

class ClassController extends BaseController
{
    protected $getAllClassesService;
    protected $createClassesService;
    protected $deleteClassesService;

    public function __construct()
    {
        $this->getAllClassesService = new GetAllClassesService();
        $this->createClassesService = new CreateClassesService();
        $this->deleteClassesService = new DeleteClassesService();
    }

    public function index()
    {
        $data = [
            'title'   => 'Manajemen Kelas',
            'classes' => $this->getAllClassesService->execute()
        ];
        return view('pages/class/index', $data);
    }

    public function store()
    {
        $rules = [
            'class_name'    => 'required|min_length[2]',
            'academic_year' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->createClassesService->execute($this->request->getPost());
        return redirect()->to('/class')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $this->deleteClassesService->execute($id);
        return redirect()->to('/class')->with('success', 'Kelas berhasil dihapus.');
    }
}
