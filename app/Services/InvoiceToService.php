<?php

namespace App\Services;

use App\Repositories\InvoiceToRepository;
use Illuminate\Support\Facades\Validator;

class InvoiceToService
{
    protected $invoicetorepository;

    public function __construct(InvoiceToRepository $invoicetorepository)
    {
        $this->invoicetorepository = $invoicetorepository;
    }

    public function createInvoiceTo(array $data)
    {
        $validator = Validator::make($data, [

            'invoiceToName' => 'required|string',

        ]);


        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        return $this->invoicetorepository->create($data);
    }
}
