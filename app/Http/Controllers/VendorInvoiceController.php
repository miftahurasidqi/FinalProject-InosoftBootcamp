<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\VendorInvoiceService;
use Illuminate\Http\Request;

class VendorInvoiceController extends Controller
{
    protected $vendorInvoiceService;
    protected $fileService;

    public function __construct(VendorInvoiceService $vendorInvoiceService, FileService $fileService)
    {
        $this->vendorInvoiceService = $vendorInvoiceService;
        $this->fileService = $fileService;
    }

    public function store(Request $request, $id)
    {
        $invoiceNumber = $request->input('invoiceNumber');
        $file = $request->file('invoiceAttachment');
        $files = $request->file('suportingDocument');
        $suportingDocument = [];

        $invoiceAttachment = $this->fileService->handleSinggelFile($file);

        if ($files) {
            $suportingDocument = $this->fileService->handleMultipleFile($files);
        }
        $invoiceData = [
            'invoiceNumber' => $invoiceNumber,
            'invoiceAttachment' => $invoiceAttachment,
            'suportingDocument' => $suportingDocument,
        ];
        return $this->vendorInvoiceService->createInvoice($id, $invoiceData);
    }

    public function deleteInvoice($id)
    {
        return $this->vendorInvoiceService->deleteInvoice($id);

    }
    public function updateInvoice(Request $request, $id)
    {
        return $this->vendorInvoiceService->updateInvoice($id, $invoiceData);

    }
}
