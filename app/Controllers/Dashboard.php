<?php

namespace App\Controllers;

use App\Services\Dashboard\DashboardService;

class Dashboard extends BaseController
{
    protected $dashboardService;

    public function __construct()
    {
        // Dependency dinisialisasi langsung melalui Service Layer
        $this->dashboardService = new DashboardService();
    }

    public function index()
    {
        // Tangkap parameter filter via GET request
        $classId = $this->request->getGet('class_id');
        $classId = ($classId !== null && $classId !== '') ? (int) $classId : null;

        // Eksekusi core logic di dalam service layer
        $data = $this->dashboardService->execute($classId);

        // Tambahkan metadata judul halaman untuk layouting utama
        $data['title'] = 'Beranda Utama';

        return view('pages/index', $data);
    }
}
