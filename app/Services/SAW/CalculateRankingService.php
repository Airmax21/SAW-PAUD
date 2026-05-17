<?php

namespace App\Services\SAW;

use App\Models\EvaluationModel;
use App\Models\CriteriaModel;
use App\Models\StudentModel;

class CalculateRankingService
{
    protected $evaluationModel, $criteriaModel, $studentModel;

    public function __construct()
    {
        $this->evaluationModel = new EvaluationModel();
        $this->criteriaModel   = new CriteriaModel();
        $this->studentModel    = new StudentModel();
    }

    public function execute(string $period, ?int $classId = null): array
    {
        // 1. Ambil Kriteria & Bobot
        $criterias = $this->criteriaModel->findAll();
        if (empty($criterias)) return [];

        // 2. Ambil Siswa
        $studentQuery = $this->studentModel;
        if ($classId) $studentQuery = $studentQuery->where('class_id', $classId);
        $students = $studentQuery->findAll();

        // 3. Ambil Nilai Maksimum & Minimum per Kriteria untuk Normalisasi
        $maxMin = [];
        foreach ($criterias as $crit) {
            $values = $this->evaluationModel
                ->where('criteria_id', $crit->id)
                ->where('period', $period)
                ->findColumn('value');

            // Jika tidak ada nilai sama sekali di database untuk kriteria ini
            if (empty($values)) {
                $maxMin[$crit->id] = ['max' => 1, 'min' => 1];
                continue;
            }

            // Pastikan semua nilai adalah numerik
            $values = array_map('floatval', $values);

            $maxMin[$crit->id] = [
                'max' => max($values) > 0 ? max($values) : 1,
                'min' => min($values) > 0 ? min($values) : 1
            ];
        }

        // 4. Hitung Skor SAW
        $rankingResult = [];
        foreach ($students as $student) {
            $totalScore = 0;
            $matrix = [];

            foreach ($criterias as $crit) {
                $eval = $this->evaluationModel->where([
                    'student_id'  => $student->id,
                    'criteria_id' => $crit->id,
                    'period'      => $period
                ])->first();

                $value = $eval ? (float)$eval->value : 0;

                // Rumus Normalisasi R_ij
                if ($crit->type === 'benefit') {
                    $r = $value / $maxMin[$crit->id]['max'];
                } else {
                    $r = ($value == 0) ? 0 : ($maxMin[$crit->id]['min'] / $value);
                }

                // Hitung V_i (Normalisasi * Bobot)
                $v = $r * ($crit->weight / 100);
                $totalScore += $v;

                $matrix[$crit->id] = [
                    'raw' => $value,
                    'normalized' => $r
                ];
            }

            $rankingResult[] = (object) [
                'student_name' => $student->full_name,
                'matrix'       => $matrix,
                'total_score'  => $totalScore
            ];
        }

        // 5. Urutkan berdasarkan skor tertinggi
        usort($rankingResult, fn($a, $b) => $b->total_score <=> $a->total_score);

        return [
            'ranking'   => $rankingResult,
            'criterias' => $criterias,
            'period'    => $period
        ];
    }
}
