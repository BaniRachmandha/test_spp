<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth_model extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true ;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false ;
    protected $allowedFields    = ['nim', 'password', 'nama', 'foto', 'is_admin', 'created_at', 'date_time' , 'updated_at', 'spp_id'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
