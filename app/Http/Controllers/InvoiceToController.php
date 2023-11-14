<?php

namespace App\Http\Controllers;

use App\Services\InvoiceToService;
use Illuminate\Http\Request;

class InvoiceToController extends Controller
{
    protected $invoicetoService;

    public function __construct(InvoiceToService $invoicetoService)
    {
        $this->invoicetoService = $invoicetoService;
    }

    public function store(Request $request)
    {
        return $this->invoicetoService->createInvoiceTo($request->all());
    }

    public function getInvoiceToList()
    {
        return $this->invoicetoService->getAll();
    }

    public function show($id)
    {
        return $this->invoicetoService->getOne($id);
    }

    public function delete($id)
    {
        return $this->invoicetoService->delete($id);
    }
}
