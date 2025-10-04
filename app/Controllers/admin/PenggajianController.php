<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianModel;

class PenggajianController extends BaseController
{
    public function index()
    {
        $penggajianModel = new PenggajianModel();
        $data = [
            'title' => 'Data Penggajian Anggota DPR',
            'penggajian' => $penggajianModel->getPenggajian(),
        ];

        return view('admin/penggajian/index_view', $data);
    }
    public function create()
    {
        $anggotaModel = new AnggotaModel();
        $komponenGajiModel = new KomponenGajiModel();

        $data = [
            'title' => 'Form Tambah Data Penggajian',
            'anggota' => $anggotaModel->findAll(),
            'komponen_gaji' => $komponenGajiModel->findAll(),
        ];

        return view('admin/penggajian/create_view', $data);
    }

    /**
     * Menyimpan data penggajian baru ke database.
     */
    public function store()
    {
        $penggajianModel = new PenggajianModel();

        $id_anggota = $this->request->getPost('id_anggota');
        $komponen_ids = $this->request->getPost('id_komponen_gaji');

        // Validasi dasar
        if (empty($id_anggota) || empty($komponen_ids)) {
            return redirect()->back()->withInput()->with('error', 'Anggota dan minimal satu komponen gaji harus dipilih.');
        }

        $berhasilDitambahkan = 0;
        $sudahAda = 0;

        foreach ($komponen_ids as $id_komponen) {
            // Cek apakah komponen sudah ada untuk anggota ini
            if (!$penggajianModel->isExist($id_anggota, $id_komponen)) {
                $data = [
                    'id_anggota' => $id_anggota,
                    'id_komponen_gaji' => $id_komponen,
                ];
                $penggajianModel->save($data);
                $berhasilDitambahkan++;
            } else {
                $sudahAda++;
            }
        }

        $message = "Berhasil menambahkan {$berhasilDitambahkan} komponen gaji.";
        if ($sudahAda > 0) {
            $message .= " {$sudahAda} komponen lainnya sudah ada sebelumnya.";
        }

        // Redirect ke halaman daftar penggajian (yang akan kita buat nanti)
        return redirect()->to('admin/penggajian')->with('success', $message);
    }
}