<?php

namespace App\Http\Controllers;

use App\Services\VendorInvoiceService;
use Illuminate\Http\Request;

class VendorInvoiceController extends Controller
{
    protected $vendorInvoiceService;

    public function __construct(VendorInvoiceService $vendorInvoiceService)
    {
        $this->vendorInvoiceService = $vendorInvoiceService;
    }

    public function store(Request $request, $id)
    {
        $invoiceNumber = $request->input('invoiceNumber');
        $file = $request->file('invoiceAttachment');
        $files = $request->file('suportingDocument');
        $suportingDocument = [];

        $file->move(public_path('uploads'), time() . '_' . $file->getClientOriginalName());

        if ($files) {
            // Lakukan sesuatu dengan setiap file
            foreach ($files as $index => $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $suportingDocument[] = $fileName;
            }
        }
        $invoiceData = [
            'invoiceNumber' => $invoiceNumber,
            'invoiceAttachment' => $file,
            'suportingDocument' => $suportingDocument,
        ];
        return $this->vendorInvoiceService->createInvoice($id, $invoiceData);
    }

    public function deleteInvoice($id)
    {
        return $this->vendorInvoiceService->deleteInvoice($id);
    }
    public function updateInvoice(Request $request, $id, $invoiceData)
    {
        return $this->vendorInvoiceService->updateInvoice($id, $invoiceData);
    }
}
