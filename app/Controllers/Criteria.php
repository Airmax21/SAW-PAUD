<?php

namespace App\Controllers;

use App\Models\CriteriaModel;
use App\Services\Criteria\CreateCriteriaService;
use App\Services\Criteria\DeleteCriteriaService;
use App\Services\Criteria\GetCriteriaService;
use App\Services\Criteria\UpdateCriteriaService;

class Criteria extends BaseController
{
    protected $getCriteriaService;
    protected $createCriteriaService;
    protected $updateCriteriaService;
    protected $deleteCriteriaService;
    protected $criteriaModel;

    public function __construct()
    {
        $this->getCriteriaService = new GetCriteriaService();
        $this->createCriteriaService = new CreateCriteriaService();
        $this->updateCriteriaService = new UpdateCriteriaService();
        $this->deleteCriteriaService = new DeleteCriteriaService();
        $this->criteriaModel = new CriteriaModel();
    }

    /**
     * Menampilkan halaman daftar kriteria dan sub-kriteria
     */
    public function index()
    {
        $data = [
            'title'     => 'Pengaturan Kriteria & Bobot SAW',
            'criterias' => $this->getCriteriaService->execute()
        ];

        return view('pages/criteria/index', $data);
    }

    public function store()
    {
        $rules = [
            'code'          => 'required|is_unique[criterias.code]|max_length[5]',
            'criteria_name' => 'required|min_length[3]',
            'type'          => 'required|in_list[benefit,cost]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($this->createCriteriaService->execute($this->request->getPost())) {
            return redirect()->to('/criteria')->with('success', 'Kriteria baru berhasil ditambahkan.');
        }
        
        return redirect()->back()->with('errors', ['Gagal menyimpan kriteria.']);
    }

    /**
     * Memperbarui bobot kriteria secara massal
     */
    public function update()
    {
        $weights = $this->request->getPost('weights');

        if (!$weights) {
            return redirect()->back()->with('errors', ['Tidak ada data bobot yang dikirim.']);
        }

        try {
            $this->updateCriteriaService->execute($weights);

            return redirect()->to('/criteria')->with('success', 'Bobot kriteria berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangkap pesan error dari Service (misal: total tidak 100%)
            return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
        }
    }

    public function delete($id)
    {
        if ($this->deleteCriteriaService->execute($id)) {
            return redirect()->to('/criteria')->with('success', 'Kriteria berhasil dihapus.');
        }
        return redirect()->back()->with('errors', ['Gagal menghapus kriteria.']);
    }
}
