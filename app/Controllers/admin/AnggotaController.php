<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{

    public function index()
    {
        $anggotaModel = new AnggotaModel();
        $data = [
            'title' => 'Daftar Anggota DPR',
            'anggota' => $anggotaModel->findAll(), // Mengambil semua data anggota
        ];

        return view('admin/anggota/index_view', $data);
    }
    public function create()
    {
        return view('admin/anggota/create_view');
    }

    public function store()
    {
        $anggotaModel = new AnggotaModel();

        // Aturan validasi
        $rules = [
            'nama_depan' => 'required|alpha_space|min_length[2]',
            'nama_belakang' => 'required|alpha_space|min_length[2]',
            'jabatan' => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin,Cerai Hidup,Cerai Mati]',
            'jumlah_anak' => 'required|numeric|greater_than_equal_to[0]'
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form dengan error dan input sebelumnya
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Jika validasi berhasil, simpan data ke database
        $data = [
            'nama_depan' => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'jabatan' => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_anak' => $this->request->getPost('jumlah_anak'),
        ];

        $anggotaModel->save($data);

        // Redirect ke halaman daftar anggota (untuk sekarang ke dashboard) dengan pesan sukses
        return redirect()->to(site_url('admin/anggota'))->with('success', 'Data anggota berhasil ditambahkan!');
    }
}