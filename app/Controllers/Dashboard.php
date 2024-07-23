<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // $session = session();
        // if ($session->has('nim')) {
        //     return view('Layouts/dashboard');
        // } else {
        //     return redirect()->to('/auth/index'); // Jika pengguna belum masuk, arahkan ke halaman masuk
        // }

        $session = session();
    if ($session->has('nim')) {
        return view('Layouts/dashboard');
    } else {
        $nim = isset($_COOKIE['nim']) ? $_COOKIE['nim'] : '';
        $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';

        $data = [
            'nim' => $nim,
            'password' => $password
        ];
        return view('auth/login', $data); 
    }
    }
}
