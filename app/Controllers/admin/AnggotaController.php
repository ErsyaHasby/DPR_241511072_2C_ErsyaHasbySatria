<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{
    /**
     * Menampilkan daftar semua data anggota.
     */
    public function index()
    {
        $anggotaModel = new AnggotaModel();
        $data = [
            'title' => 'Daftar Anggota DPR',
            'anggota' => $anggotaModel->findAll(),
        ];

        return view('admin/anggota/index_view', $data);
    }

    /**
     * Menampilkan form untuk menambah data anggota baru.
     */
    public function create()
    {
        return view('admin/anggota/create_view');
    }

    /**
     * Menyimpan data anggota baru ke database.
     */
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
            return redirect()->back()->withInput()->with('errors', a_session('errors') ?? $this->validator->getErrors());
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

        return redirect()->to(site_url('admin/anggota'))->with('success', 'Data anggota berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data anggota.
     *
     * @param int $id
     */
    public function edit($id = null)
    {
        $anggotaModel = new AnggotaModel();
        $data = [
            'title' => 'Edit Data Anggota',
            'anggota' => $anggotaModel->find($id) // Mengambil satu data anggota berdasarkan ID
        ];

        if (empty($data['anggota'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan.');
        }

        return view('admin/anggota/edit_view', $data);
    }

    /**
     * Memperbarui data anggota di database.
     *
     * @param int $id
     */
    public function update($id = null)
    {
        $anggotaModel = new AnggotaModel();

        // Aturan validasi sama seperti saat store
        $rules = [
            'nama_depan' => 'required|alpha_space|min_length[2]',
            'nama_belakang' => 'required|alpha_space|min_length[2]',
            'jabatan' => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin,Cerai Hidup,Cerai Mati]',
            'jumlah_anak' => 'required|numeric|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', a_session('errors') ?? $this->validator->getErrors());
        }

        $data = [
            'nama_depan' => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'jabatan' => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_anak' => $this->request->getPost('jumlah_anak'),
        ];

        $anggotaModel->update($id, $data);

        return redirect()->to(site_url('admin/anggota'))->with('success', 'Data anggota berhasil diperbarui!');
    }
}