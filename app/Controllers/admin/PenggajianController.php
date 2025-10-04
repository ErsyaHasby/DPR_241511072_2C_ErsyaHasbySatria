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
        $keyword = $this->request->getGet('keyword');

        $data = [
            'title' => 'Data Penggajian Anggota DPR',
            'keyword' => $keyword,
        ];

        if ($keyword) {
            $data['penggajian'] = $penggajianModel->search($keyword);
        } else {
            $data['penggajian'] = $penggajianModel->getPenggajian();
        }

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

    public function edit($id_anggota = null)
    {
        $anggotaModel = new AnggotaModel();
        $komponenGajiModel = new KomponenGajiModel();
        $penggajianModel = new PenggajianModel();

        $anggota = $anggotaModel->find($id_anggota);
        if (empty($anggota)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan.');
        }

        // Ambil ID komponen yang sudah dimiliki anggota ini
        $current_komponen_ids = array_column(
            $penggajianModel->where('id_anggota', $id_anggota)->findAll(),
            'id_komponen_gaji'
        );

        $data = [
            'title' => 'Edit Penggajian: ' . $anggota['nama_depan'],
            'anggota' => $anggota,
            'semua_komponen_gaji' => $komponenGajiModel->findAll(),
            'current_komponen_ids' => $current_komponen_ids
        ];

        return view('admin/penggajian/edit_view', $data);
    }

    /**
     * Memperbarui data penggajian di database.
     */
    public function update($id_anggota = null)
    {
        $penggajianModel = new PenggajianModel();

        // 1. Hapus semua komponen gaji lama untuk anggota ini
        $penggajianModel->where('id_anggota', $id_anggota)->delete();

        // 2. Tambahkan kembali komponen yang baru dipilih
        $komponen_ids = $this->request->getPost('id_komponen_gaji');

        if (!empty($komponen_ids)) {
            foreach ($komponen_ids as $id_komponen) {
                $data = [
                    'id_anggota' => $id_anggota,
                    'id_komponen_gaji' => $id_komponen,
                ];
                $penggajianModel->save($data);
            }
        }

        return redirect()->to(site_url('admin/penggajian'))->with('success', 'Data penggajian berhasil diperbarui!');
    }
    public function detail($id_anggota = null)
    {
        $anggotaModel = new AnggotaModel();
        $penggajianModel = new PenggajianModel();

        $anggota = $anggotaModel->find($id_anggota);
        if (empty($anggota)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan.');
        }

        $detail_komponen = $penggajianModel->getDetailKomponen($id_anggota);

        // Kalkulasi Take Home Pay
        $take_home_pay = 0;
        foreach ($detail_komponen as $komponen) {
            if ($komponen['satuan'] == 'Bulan') {
                if ($komponen['nama_komponen'] == 'Tunjangan Istri/Suami' && $anggota['status_pernikahan'] != 'Kawin') {
                    continue; // Abaikan
                }
                if ($komponen['nama_komponen'] == 'Tunjangan Anak' && $anggota['jumlah_anak'] > 0) {
                    $take_home_pay += $komponen['nominal'] * min($anggota['jumlah_anak'], 2);
                } elseif ($komponen['nama_komponen'] == 'Tunjangan Anak' && $anggota['jumlah_anak'] == 0) {
                    continue; // Abaikan
                } else {
                    $take_home_pay += $komponen['nominal'];
                }
            }
        }

        $data = [
            'title' => 'Detail Penggajian Anggota',
            'anggota' => $anggota,
            'detail_komponen' => $detail_komponen,
            'take_home_pay' => $take_home_pay
        ];

        return view('admin/penggajian/detail_view', $data);
    }
}