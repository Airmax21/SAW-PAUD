<?php

namespace App\Services\Dashboard;

use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Models\EvaluationModel;

class DashboardService
{
    protected $studentModel;
    protected $classModel;
    protected $evaluationModel;

    public function __construct()
    {
        $this->studentModel    = new StudentModel();
        $this->classModel      = new ClassModel();
        $this->evaluationModel = new EvaluationModel();
    }

    public function execute(?int $classId = null): array
    {
        $currentPeriod = date('Y-m');

        // 1. Ambil data siswa berdasarkan filter kelas
        $studentQuery = $this->studentModel;
        if ($classId !== null) {
            $studentQuery = $studentQuery->where('class_id', $classId);
        }
        $students = $studentQuery->orderBy('full_name', 'ASC')->findAll();

        // 2. Ambil data master kelas untuk filter tab
        $classes = $this->classModel->findAll();

        // 3. Hitung Agregat Statistik Makro secara Realtime
        $totalStudents = count($this->studentModel->findAll());
        $evaluatedCount = 0;

        foreach ($students as $student) {
            // Cari nama kelas penunjang
            $classData = array_filter($classes, fn($c) => $c->id === $student->class_id);
            $classData = current($classData);
            $student->class_name = $classData ? $classData->class_name : '-';

            // Hitung status kelengkapan evaluasi bulan berjalan
            $evalCount = $this->evaluationModel->where([
                'student_id' => $student->id,
                'period'     => $currentPeriod
            ])->countAllResults();

            $student->is_evaluated = ($evalCount > 0);
            if ($student->is_evaluated) {
                $evaluatedCount++;
            }
        }

        return [
            'students'       => $students,
            'classes'        => $classes,
            'classId'        => $classId,
            'totalStudents'  => $totalStudents,
            'evaluatedCount' => $evaluatedCount,
            'pendingCount'   => max(0, $totalStudents - $evaluatedCount),
            'currentMonth'   => date('F')
        ];
    }
}
