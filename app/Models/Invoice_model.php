<?php

namespace App\Models;

use CodeIgniter\Model;

class Invoice_model extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'semester', 'amount', 'due_date', 'status',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function user()
    {
        return $this->belongsTo('App\Models\Auth_model', 'user_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment_model', 'invoice_id', 'id');
    }
}
