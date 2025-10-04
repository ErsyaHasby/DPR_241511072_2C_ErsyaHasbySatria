<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\PenggajianModel; // Tambahkan ini

class PublicController extends BaseController
{
    /**
     * Menampilkan dashboard untuk publik yang sudah login.
     */
    public function dashboard()
    {
        $data['title'] = 'Dashboard Publik';
        return view('public/dashboard_view', $data);
    }

    /**
     * Menampilkan daftar anggota DPR untuk publik.
     */
    public function anggota()
    {
        $anggotaModel = new AnggotaModel();
        $data = [
            'title' => 'Daftar Anggota DPR RI',
            'anggota' => $anggotaModel->findAll(),
        ];

        return view('public/anggota_view', $data);
    }

    /**
     * Menampilkan data penggajian untuk publik.
     */
    public function penggajian()
    {
        $penggajianModel = new PenggajianModel();
        $data = [
            'title' => 'Rekapitulasi Gaji Anggota DPR',
            'penggajian' => $penggajianModel->getPenggajian(), // Kita gunakan lagi method canggih ini
        ];

        return view('public/penggajian_view', $data);
    }
}