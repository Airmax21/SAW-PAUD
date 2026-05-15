<?php

namespace App\Services\Evaluations;

use App\Models\EvaluationModel;

class CreateBulkEvaluationService
{
    protected $evaluationModel;

    public function __construct()
    {
        $this->evaluationModel = new EvaluationModel();
    }

    public function execute(array $data): bool
    {
        $db = \Config\Database::connect();
        $db->transStart();

        foreach ($data['scores'] as $studentId => $criterias) {
            foreach ($criterias as $criteriaId => $value) {
                // Jika nilai 0 (belum dipilih), kita bisa abaikan atau hapus data lama jika ada
                if ($value == 0) continue;

                $existing = $this->evaluationModel->where([
                    'student_id'  => $studentId,
                    'criteria_id' => $criteriaId,
                    'period'      => $data['period']
                ])->first();

                if ($existing) {
                    $this->evaluationModel->update($existing->id, ['value' => $value]);
                } else {
                    $this->evaluationModel->insert([
                        'student_id'  => $studentId,
                        'criteria_id' => $criteriaId,
                        'value'       => $value,
                        'period'      => $data['period']
                    ]);
                }
            }
        }

        $db->transComplete();
        return $db->transStatus();
    }
}
