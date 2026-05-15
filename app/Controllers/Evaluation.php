<?php

namespace App\Controllers;

use App\Services\Evaluations\CreateBulkEvaluationService;
use App\Services\Evaluations\GetDataEvaluationService;

class Evaluation extends BaseController
{
    protected $getDataEvaluationService, $createBulkEvaluationService;

    public function __construct()
    {
        $this->getDataEvaluationService = new GetDataEvaluationService();
        $this->createBulkEvaluationService = new CreateBulkEvaluationService();
    }

    public function index()
    {
        $period = $this->request->getGet('period') ?? date('Y-m');

        // Ambil input dan paksa menjadi integer jika tidak kosong
        $classId = $this->request->getGet('class_id');
        $classId = ($classId !== null && $classId !== '') ? (int) $classId : null;

        // Sekarang dikirim sebagai ?int (integer atau null)
        $data = $this->getDataEvaluationService->execute($period, $classId);

        $data['title'] = 'Penilaian Siswa';
        return view('pages/evaluation/index', $data);
    }

    public function store()
    {
        $post = $this->request->getPost();
        if ($this->createBulkEvaluationService->execute($post)) {
            return redirect()->back()->with('success', 'Penilaian berhasil disimpan.');
        }
        return redirect()->back()->with('errors', ['Gagal menyimpan penilaian.']);
    }
}
