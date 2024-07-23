<?php

namespace App\Models;

use CodeIgniter\Model;

class Spp_model extends Model
{
    protected $table = 'spp';
    protected $primarykey = 'id';
    protected $allowFields = ['semester', 'nominal', 'created_at', 'updated_at'];

    public function Mahasiswa_spp($sppId)
    {
        $authmodel = new \App\Models\Auth_model();
        return $authmodel->where('spp_id', $sppId)->findAll();
    }

    public function Mahasiswa_user()
    {
        $sppData = $this->findAll();
        $authmodel = new \App\Models\Auth_model();

        foreach ($sppData as $spp) {
            $spp['users'] = $authmodel->where('spp_id', $spp['id'])->findAll();
        }

        return $sppData;
    }

}