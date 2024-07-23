<?php

namespace App\Models;

use CodeIgniter\Model;

class Tahun_ajaran_model extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun_ajaran', 'status_tahun_ajar'];

    public function add_tahun($data)
    {
        $this->db->table('tahun_ajaran')->insert($data);
    }

    public function edit_page_tahun($id)
    {
        return $this->db->table($this->table)->where('id', $id)->get()->getResult(); // Menggunakan getResult() untuk mengembalikan array objek
    }

    public function delete_tahun($data)
    {
        $this->db->table('tahun_ajaran')->where('id', $data['id'])->delete($data);
    }

    public function edit_post($id, $data)
    {
        $this->db->table($this->table)
                 ->where('id', $id)
                 ->update($data);
    }

}