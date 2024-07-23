<?php

namespace App\Models;

use CodeIgniter\Model;

class Mahasiswa_model extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nim', 'nim_id', 'id_semester', 'jenis_kelamin', 'no_handphone', 'alamat', 'prodi', 'agama', 'status', 'nama_wali'];
    
    public function list_mahasiswa()
    {
        return $this->db->table('mahasiswa')
                    ->join('semester', 'mahasiswa.id_semester = semester.id_semester')
                    ->join('users', 'mahasiswa.nim = users.nim')
                    ->orderBy('mahasiswa.nim', 'asc')
                    ->get();
    }

    public function getSemester()
    {
        return $this->db->table('semester')->orderBy('semester', 'ASC')->get();
    }

    public function getnama()
    {
        return $this->db->table('users')->orderBy('nama', 'ASC')->get();
    }

    public function add_user()
    {
        
    }

    public function list_semester()
    {
        return $this->db->table('semester')->orderBy('semester', 'ASC')->get();
    }


    public function tahun_ajar()
    {
        return $this->db->table('tahun_ajaran')->orderBy('tahun_ajaran')->get();
    }

    

}