<?php

namespace App\Controllers;
use App\Models\Auth_model;
use App\Controllers\BaseController;
use App\Models\Mahasiswa_model;
use App\Models\Tahun_ajaran_model;

class Mahasiswa_controller extends BaseController
{
    protected $Auth_model;
    protected $Tahun_ajaran_model;


    public function __construct()
    {
        $this->Auth_model = new Auth_model();
        $this->Tahun_ajaran_model = new Tahun_ajaran_model();
    }
  

    public function index()
    {
        $model = new Mahasiswa_model();
        $data = array(
            'mahasiswa' => $model->list_mahasiswa()->getResult()
        );
        echo view('Mahasiswa/List_mahasiswa', $data);
    }

    public function add_data()
    {
        $model = new Mahasiswa_model();
        $data = array(
            'semester' => $model->list_semester()->getResult(),
        );   
        return view('Mahasiswa/Add_mahasiswa', $data);
    }

    public function add()
{
    $request = service('request');
    $validation = \Config\Services::validation();

    $data = [
        'nim'           => $request->getPost('nim'),
        'nama'          => $request->getPost('nama'),
        'id_semester'   => $request->getPost('id_semester'),
        'jenis_kelamin' => $request->getPost('jenis_kelamin'),
        'no_handphone'  => $request->getPost('no_handphone'),
        'alamat'        => $request->getPost('alamat'),
        'prodi'         => $request->getPost('prodi'),
        'agama'         => $request->getPost('agama'),
        'status'        => $request->getPost('status') ?: 'Belum Wisuda',
        'nama_wali'     => $request->getPost('nama_wali'),
    ];

    $validation->setRules([
        'nim'           => 'required|numeric|is_unique[users.nim]',
        'nama'          => 'required',
        'id_semester'   => 'required|numeric',
        'jenis_kelamin' => 'required',
        'no_handphone'  => 'required|numeric',
        'alamat'        => 'required',
        'prodi'         => 'required',
        'agama'         => 'required',
        'status'        => 'required',
        'nama_wali'     => 'required',
    ]);

    // Check if NIM is unique
    $authModel = new Auth_model();
    if ($authModel->where('nim', $data['nim'])->first()) {
        return redirect()->back()->withInput()->with('errors', ['nim' => 'NIM sudah Digunakan']);
    }

    if (!$validation->run($data)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $default_password_mahasiswa = 'admin123';

    $authData = [
        'nim'      => $data['nim'],
        'password' => password_hash($default_password_mahasiswa, PASSWORD_DEFAULT), // Hash password
        'nama'     => $data['nama'],
    ];
    $authModel->insert($authData);

    $mahasiswaModel = new Mahasiswa_model();
    $mahasiswaData = [
        'nim'           => $data['nim'],
        'id_semester'   => $data['id_semester'],
        'jenis_kelamin' => $data['jenis_kelamin'],
        'no_handphone'  => $data['no_handphone'],
        'alamat'        => $data['alamat'],
        'prodi'         => $data['prodi'],
        'agama'         => $data['agama'],
        'status'        => $data['status'],
        'nama_wali'     => $data['nama_wali'],
    ];
    $mahasiswaModel->insert($mahasiswaData);

    return redirect()->to('/list_mahasiswa');
}

    public function tahun()
    {
        $model = new Mahasiswa_model();
        $tahun_ajar = array (
            'tahun_ajar' => $model->tahun_ajar()->getResult()
        );
        return view ('Mahasiswa/Tahun_ajar', $tahun_ajar);
    }

    public function add_tahun_page()
    {
        return view('Mahasiswa/Add_tahun');
    }

    public function add_tahun()
        {
            $data = array('tahun_ajaran' => $this->request->getPost('tahun_ajaran'));
            $this->Tahun_ajaran_model->add_tahun($data);
            return redirect()->to('/tahun_ajaran');
        }

    public function page_edit($id)
    {

        $data = array (
            'tahun_ajar' =>$this->Tahun_ajaran_model->edit_page_tahun($id),
        );
        return view ('Mahasiswa/Edit_tahun', $data);
    }

    public function delete($id)
    {
        $data = array(
            'id' => $id,
        );
        $this->Tahun_ajaran_model->delete_tahun($data);
        $model = new Mahasiswa_model();
        $tahun_ajar = array(
        'tahun_ajar' => $model->tahun_ajar()->getResult()
        );
        return view ('Mahasiswa/Tahun_ajar', $tahun_ajar);
    }

    public function edit($id)
    {
        $data = array(
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'status_tahun_ajar' => $this->request->getPost('status_tahunajar'),
        );
        $this->Tahun_ajaran_model->edit_post($id, $data); 
        return redirect()->to('/tahun_ajaran');
    }
    
}
