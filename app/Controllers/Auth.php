<?php

namespace App\Controllers;

use App\Models\Auth_model;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        // Memuat helper form
        helper(['form']);
        echo view('Login');
    }

    // public function login()
    // {
    //     $session = session();
    //     $model = new Auth_model();

    //     $nim = $this->request->getVar('nim');
    //     $password = $this->request->getVar('password');

    //     buat debugging
    //     $logger = service('logger');
    //     $logger->info("Password yang dikirim dari form: $password");

    //     $data = $model->where('nim', $nim)->first();

    //     if ($data) {
    //         $pass = $data['password'];
    //         $verify_pass = password_verify($password, $pass);
    //         if ($verify_pass) {
    //             $ses_data = [
    //                 'id'       => $data['id'],
    //                 'nim'      => $data['nim'],
    //                 'logged_in'=> TRUE
    //             ];
    //             $session->set($ses_data);
    //             return redirect()->to('/layouts/dashboard');
    //         } else {
    //             $session->setFlashdata('message', 'Password salah');
    //             return redirect()->to('/auth/index');
    //         }
    //     } else {
    //         $session->setFlashdata('message', 'NIM tidak ditemukan');
    //         return redirect()->to('/auth/index');
    //     }
    // }

    public function login()
{
    $session = session();
    $model = new Auth_model();

    $nim = $this->request->getVar('nim');
    $password = $this->request->getVar('password');

    $data = $model->where('nim', $nim)
                  ->orWhere('nama', $nim)
                  ->first();

    if ($data) {
        $pass = $data['password'];
        if ($password === $pass) {
            $ses_data = [
                'id'       => $data['id'],
                'nim'      => $data['nim'],
                'nama'     => $data['nama'],
                'foto'     => $data['foto'],
                'logged_in'=> TRUE
            ];
            $session->set($ses_data);
            return redirect()->to(base_url('Layouts/Dashboard'));
        } else {
            $session->setFlashdata('message', 'Password salah');
            return redirect()->to(base_url('/auth/index'));
        }
    } else {
        $session->setFlashdata('message', 'NIM tidak ditemukan');
        return redirect()->to(base_url('/auth/index'));
    }
}

    public function logout()
    {
        $session = session();
        $session->destroy();
        $session->setFlashdata('pesan', 'Anda Telah Logout');
        return redirect()->to(base_url('/auth/index'));
    }

    // public function dashboard()
    // {
    //     $user = new Auth_model();
    //     $data['users'] = $user->findAll();
    //     echo view ('Layouts/header', $data);
    // }

    public function add()
{
    $validasi = \Config\Services::validation();
    $validasi->setRules([
        'nama'=> [
            'label' => 'nama',
            'rules' => 'required|min_length[3]|alpha_space',
            'errors' => [
                'required' => '{field} Harus Diisi',
                'min_length' => '{field} Nama Harus Minimal 3 Karakter',
                'alpha_space' => '{field} Hanya Boleh Mengandung Huruf Dan Spasi'
            ]
        ],
        // other rules
    ]);

    $data = [
        'nama' => $this->request->getPost('nama'),
        'nim'  => $this->request->getPost('nim'),
        'password'=> password_hash($this->request->getpost('password'), PASSWORD_DEFAULT),
        'is_admin' => $this->request->getPost('is_admin'),
        'jenis_kelamin'=> $this->request->getPost('jenis_kelamin'),
        'semester' => $this->request->getPost('semester'),
        'alamat' =>$this->request->getPost('alamat'),
        'no_hp'=>$this->request->getPost('no_hp'),
        'tgl_lahir'=>$this->request->getPost('tgl_lahir'),
        'tempat_lahir'=>$this->request->getPost('tempat_lahir'),
    ];

    if (!$validasi->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validasi->getErrors());
    }

    $file = $this->request->getFile('foto');
    if($file->isValid() && !$file->hasMoved()){
        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $newName);
        $data['foto'] = $newName;
    }
    $User_model = new Auth_model();
    if ($User_model->insert($data)) {
        return redirect()->to('Layouts/Dashboard')->with('pesan', 'Data Berhasil Ditambahkan');
    } else {
        return redirect()->back()->withInput()->with('errors', 'Gagal Menambahkan Data');
    }
}




}
