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

        $recData = [
            'invoiceNumber' => $invoiceNumber,
            'file' => $file,
            'files' => $files,
        ];
        return $this->vendorInvoiceService->createInvoice($id, $recData);
    }

    public function deleteInvoice($id)
    {
        return $this->vendorInvoiceService->deleteInvoice($id);
    }
    // belum
    public function updateInvoice(Request $request, $id)
    {
        $data = json_decode($request->input('reqData'), true);
        $file = $request->file('invoiceAttachment');
        $files = $request->file('suportingDocument');

        $data['file'] = $file;
        $data['files'] = $files;
        // return response()->json($data);

        return $this->vendorInvoiceService->updateInvoice($id, $data);
    }
}
