<?php
namespace App\Controllers;

use App\Models\Auth_model;
use App\Models\Invoice_model;
use App\Models\Payment_model;

class Payment_controller extends BaseController
{
    protected $Auth_model;
    protected $Invoice_model;
    protected $Payment_model;

    public function __construct()
    {
        $this->Auth_model = new Auth_model();
        $this->Invoice_model = new Invoice_model();
        $this->Payment_model = new Payment_model();
    }

    public function index()
    {
        $data['users'] = $this->Auth_model->findAll();
        return view('Pembayaran/Pembayaran', $data);
    }

    public function userPaymentsView($userId)
    {
        $data['user'] = $this->Auth_model->find($userId);
        $data['invoices'] = $this->Invoice_model->where('user_id', $userId)->findAll();
        return view('Pembayaran/Pembayaran_user_pembayaran', $data);
    }


    public function Payment_user($userId)
    {
        $data['user'] = $this->Auth_model->find($userId);
        $data['invoices'] = $this->Invoice_model->where('user_id', $userId)->findAll();
        return view('payment/user_payments', $data);
    }

    public function addPayment($invoiceId)
    {
        $data['invoice'] = $this->Invoice_model->find($invoiceId);
        return view('payment/add_payment', $data);
    }

    public function savePayment()
    {
        $paymentData = [
            'invoice_id' => $this->request->getPost('invoice_id'),
            'amount' => $this->request->getPost('amount'),
            'payment_date' => date('Y-m-d H:i:s'),
            'method' => 'manual', // atau 'midtrans' sesuai dengan metode pembayaran
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->Payment_model->save($paymentData);

        // Update invoice status and remaining amount
        $invoiceId = $this->request->getPost('invoice_id');
        $invoice = $this->Invoice_model->find($invoiceId);
        $newAmount = $invoice['amount'] - $this->request->getPost('amount');
        $status = $newAmount <= 0 ? 'paid' : 'partial';

        $this->Invoice_model->update($invoiceId, [
            'amount' => $newAmount,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/payment/userPayments/' . $invoice['user_id']);
    }

    // public function addInvoice()
    // {
    //     return view('Pembayaran/Tambah_pembayaran');
    // }

    public function selectUser()
    {
        $data['users'] = $this->Auth_model->findAll();
        return view('Pembayaran/Tambah_pembayaran', $data);
    }

    public function saveInvoice()
    {
        $invoiceData = [
            'user_id' => $this->request->getPost('user_id'),
            'semester' => $this->request->getPost('semester'),
            'amount' => $this->request->getPost('amount'),
            'due_date' => $this->request->getPost('due_date'),
            'status' => 'unpaid',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->Invoice_model->save($invoiceData);

        return redirect()->to('/payment');
    }


    
}
