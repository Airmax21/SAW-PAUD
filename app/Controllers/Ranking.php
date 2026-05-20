<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Services\Export\ExportPDFService;
use App\Services\SAW\CalculateRankingService;

class Ranking extends BaseController
{
    protected $calculateRankingService, $classModel, $pdfService;

    public function __construct()
    {
        $this->calculateRankingService = new CalculateRankingService();
        $this->classModel = new ClassModel();
        $this->pdfService = new ExportPDFService();
    }

    public function index()
    {
        // Melakukan perhitungan SAW berdasarkan periode dan kelas
        $period  = $this->request->getGet('period') ?? date('Y-m');
        $classId = $this->request->getGet('class_id');
        $classId = ($classId !== null && $classId !== '') ? (int) $classId : null;

        $data = $this->calculateRankingService->execute($period, $classId);

        $data['classes'] = $this->classModel->findAll();
        $data['classId'] = $classId;
        $data['title']   = 'Ranking SAW';

        return view('pages/ranking/index', $data);
    }

    public function exportPdf()
    {
        $period  = $this->request->getGet('period') ?? date('Y-m');
        $classId = $this->request->getGet('class_id');
        $classId = ($classId !== null && $classId !== '') ? (int) $classId : null;

        // Ambil data kalkulasi SAW dari service yang sama
        $data = $this->calculateRankingService->execute($period, $classId);

        $class = $classId ? $this->classModel->find($classId) : null;
        $data['className'] = $class ? $class->class_name : 'Semua Kelas';
        $data['period'] = $period;

        // Render HTML view khusus PDF ke dalam string variabel
        $html = view('components/pdf_template', $data);

        // Panggil PdfService untuk generate
        $filename = 'Ranking-SAW-' . $data['className'] . '-' . $period . '.pdf';
        $this->pdfService->execute($html, $filename, 'A4', 'portrait');
    }
}
