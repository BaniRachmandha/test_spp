<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment_model extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'invoice_id', 'amount', 'payment_date', 'method', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice_model', 'invoice_id', 'id');
    }

    public function midtransTransaction()
    {
        return $this->hasOne('App\Models\Midtrans_payment_model', 'payment_id', 'id');
    }

    public function manualPayment()
    {
        return $this->hasOne('App\Models\Manual_payment_model', 'payment_id', 'id');
    }
}