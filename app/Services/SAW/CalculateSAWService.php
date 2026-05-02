<?php

namespace App\Services\SAW;

use App\Models\CriteriaModel;
use App\Models\EvaluationModel;
use App\Models\StudentModel;

class CalculateSAWService
{
    protected $studentModel, $criteriaModel, $evaluationModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->criteriaModel = new CriteriaModel();
        $this->evaluationModel = new EvaluationModel();
    }

    public function execute(string $period, ?int $classId = null): array
    {
        $studentQuery = $this->studentModel;
        if ($classId) {
            $studentQuery = $studentQuery->where('class_id', $classId);
        }
        $students = $studentQuery->findAll();

        $criterias = $this->criteriaModel->findAll();

        $rawEvaluations = $this->evaluationModel->where('period', $period)->findAll();

        if (empty($students) || empty($rawEvaluations)) {
            return [];
        }

        $groupedValues = [];
        foreach ($rawEvaluations as $ev) {
            $sId = is_object($ev) ? $ev->student_id : $ev['student_id'];
            $cId = is_object($ev) ? $ev->criteria_id : $ev['criteria_id'];
            $val = is_object($ev) ? $ev->value : $ev['value'];

            $groupedValues[$sId][$cId][] = $val;
        }

        $matrix = [];
        $maxValues = [];

        foreach ($students as $student) {
            $sId = is_object($student) ? $student->id : $student['id'];

            foreach ($criterias as $crit) {
                $cId = is_object($crit) ? $crit->id : $crit['id'];

                $values = $groupedValues[$sId][$cId] ?? [0];
                $count = count($values);
                $avgValue = $count > 0 ? array_sum($values) / $count : 0;

                $matrix[$sId][$cId] = $avgValue;

                if (!isset($maxValues[$cId]) || $avgValue > $maxValues[$cId]) {
                    $maxValues[$cId] = $avgValue;
                }
            }
        }

        $ranking = [];
        foreach ($students as $student) {
            $sId = is_object($student) ? $student->id : $student['id'];
            $totalScore = 0;

            foreach ($criterias as $crit) {
                $cId = is_object($crit) ? $crit->id : $crit['id'];
                $weight = is_object($crit) ? $crit->weight : $crit['weight'];

                $val = $matrix[$sId][$cId];
                $max = $maxValues[$cId] ?? 1;
                $max = ($max == 0) ? 1 : $max;

                $normalized = $val / $max;
                $totalScore += ($normalized * ($weight / 100));
            }

            $ranking[] = [
                'student' => $student,
                'score'   => round($totalScore, 4)
            ];
        }

        usort($ranking, fn($a, $b) => $b['score'] <=> $a['score']);
        return $ranking;
    }
}
