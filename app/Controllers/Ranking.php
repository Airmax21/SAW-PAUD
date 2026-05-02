<?php

namespace App\Controllers;

use App\Services\SAW\CalculateSAWService;

class Ranking extends BaseController
{
    protected $calculateSAWService;

    public function __construct()
    {
        $this->calculateSAWService = new CalculateSAWService();
    }

    public function index()
    {
        $period = $this->request->getVar('period') ?? date('Y-m');
        $classId = $this->request->getVar('class_id');

        $data['rankings'] = $this->calculateSAWService->execute($period, $classId ? (int)$classId : null);
        return $this->response->setJSON($data);
    }
}
