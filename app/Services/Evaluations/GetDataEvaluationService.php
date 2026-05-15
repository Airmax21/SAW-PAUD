<?php

namespace App\Services\Evaluations;

use App\Models\StudentModel;
use App\Models\CriteriaModel;
use App\Models\EvaluationModel;
use App\Models\ClassModel;

class GetDataEvaluationService
{
    protected $studentModel, $criteriaModel, $evaluationModel, $classModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->criteriaModel = new CriteriaModel();
        $this->evaluationModel = new EvaluationModel();
        $this->classModel = new ClassModel();
    }

    public function execute(string $period, ?int $classId = null): array
    {
        $classes = $this->classModel->findAll();

        // Logic: Jika classId ada, filter. Jika tidak ada, ambil semua.
        if (!empty($classId)) {
            $students = $this->studentModel->where('class_id', $classId)->findAll();
        } else {
            $students = $this->studentModel->findAll();
        }

        $criterias = $this->criteriaModel->orderBy('code', 'ASC')->findAll();

        foreach ($students as $student) {
            $tempScores = [];
            foreach ($criterias as $crit) {
                $eval = $this->evaluationModel->where([
                    'student_id'  => $student->id,
                    'criteria_id' => $crit->id,
                    'period'      => $period
                ])->first();

                $tempScores[$crit->id] = $eval ? (int)$eval->value : 0;
            }
            $student->scores = $tempScores;
        }

        return [
            'students'  => $students,
            'criterias' => $criterias,
            'classes'   => $classes,
            'period'    => $period,
            'classId'   => $classId
        ];
    }
}
