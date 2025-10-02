<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AnggotaModel;

class AnggotaController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new AnggotaModel();
    }

    public function create()
    {
        $data['title'] = 'Tambah Anggota DPR';
        return view('anggota/create', $data);
    }

    public function store()
    {
        if (
            !$this->validate([
                'nama_depan' => 'required|alpha_space',
                'nama_belakang' => 'required|alpha_space',
                'gelar_depan' => 'permit_empty|alpha_space',
                'gelar_belakang' => 'permit_empty|alpha_space',
                'jabatan' => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
                'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin,Cerai Hidup,Cerai Mati]',
                'jumlah_anak' => 'permit_empty|integer|greater_than_equal_to[0]'
            ])
        ) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->insert($this->request->getPost());
        return redirect()->to('/anggota')->with('success', 'Anggota ditambahkan');
    }
}