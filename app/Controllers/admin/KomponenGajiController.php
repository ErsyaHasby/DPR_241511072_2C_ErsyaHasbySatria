<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KomponenGajiModel;

class KomponenGajiController extends BaseController
{
    public function index()
    {
        $komponenGajiModel = new KomponenGajiModel();
        $keyword = $this->request->getGet('keyword');

        $data = [
            'title' => 'Daftar Komponen Gaji & Tunjangan',
            'keyword' => $keyword,
        ];

        if ($keyword) {
            $data['komponen_gaji'] = $komponenGajiModel->search($keyword);
        } else {
            $data['komponen_gaji'] = $komponenGajiModel->findAll();
        }

        return view('admin/komponen_gaji/index_view', $data);
    }
    public function create()
    {
        return view('admin/komponen_gaji/create_view');
    }

    public function store()
    {
        $komponenGajiModel = new KomponenGajiModel();

        // Aturan validasi
        $rules = [
            'nama_komponen' => 'required|min_length[3]',
            'kategori' => 'required|in_list[Gaji Pokok,Tunjangan Melekat,Tunjangan Lain]',
            'jabatan' => 'required|in_list[Ketua,Wakil Ketua,Anggota,Semua]',
            'nominal' => 'required|numeric',
            'satuan' => 'required|in_list[Bulan,Hari,Periode]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Jika validasi berhasil, simpan data
        $data = [
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori' => $this->request->getPost('kategori'),
            'jabatan' => $this->request->getPost('jabatan'),
            'nominal' => $this->request->getPost('nominal'),
            'satuan' => $this->request->getPost('satuan'),
        ];

        $komponenGajiModel->save($data);

        // Redirect ke halaman daftar komponen (yang akan kita buat nanti)
        // Untuk sekarang, kita arahkan ke dashboard
        return redirect()->to(site_url('admin/komponen-gaji'))->with('success', 'Komponen gaji berhasil ditambahkan!');
    }
    public function edit($id = null)
    {
        $komponenGajiModel = new KomponenGajiModel();
        $data = [
            'title' => 'Edit Komponen Gaji',
            'komponen' => $komponenGajiModel->find($id)
        ];

        if (empty($data['komponen'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Komponen gaji tidak ditemukan.');
        }

        return view('admin/komponen_gaji/edit_view', $data);
    }

    /**
     * Memperbarui data komponen gaji di database.
     */
    public function update($id = null)
    {
        $komponenGajiModel = new KomponenGajiModel();

        // Aturan validasi
        $rules = [
            'nama_komponen' => 'required|min_length[3]',
            'kategori' => 'required|in_list[Gaji Pokok,Tunjangan Melekat,Tunjangan Lain]',
            'jabatan' => 'required|in_list[Ketua,Wakil Ketua,Anggota,Semua]',
            'nominal' => 'required|numeric',
            'satuan' => 'required|in_list[Bulan,Hari,Periode]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Jika validasi berhasil, update data
        $data = [
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori' => $this->request->getPost('kategori'),
            'jabatan' => $this->request->getPost('jabatan'),
            'nominal' => $this->request->getPost('nominal'),
            'satuan' => $this->request->getPost('satuan'),
        ];

        $komponenGajiModel->update($id, $data);

        return redirect()->to(site_url('admin/komponen-gaji'))->with('success', 'Komponen gaji berhasil diperbarui!');
    }
    public function delete($id = null)
    {
        $komponenGajiModel = new KomponenGajiModel();

        $data = $komponenGajiModel->find($id);
        if ($data) {
            $komponenGajiModel->delete($id);
            return redirect()->to(site_url('admin/komponen-gaji'))->with('success', 'Komponen gaji berhasil dihapus!');
        } else {
            return redirect()->to(site_url('admin/komponen-gaji'))->with('error', 'Komponen gaji tidak ditemukan.');
        }
    }
}