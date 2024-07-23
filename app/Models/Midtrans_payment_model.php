<?
namespace App\Models;

use CodeIgniter\Model;

class Midtrans_payment_model extends Model
{
    protected $table = 'midtrans_transactions';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'payment_id', 'transaction_id', 'transaction_status', 'payment_type',
        'gross_amount', 'transaction_time', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
