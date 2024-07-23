<?php
namespace App\Models;

use CodeIgniter\Model;

class Manual_payment_model extends Model
{
    protected $table = 'manual_payments';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'payment_id', 'bank_name', 'account_number', 'account_name', 'payment_proof',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
