<?php

namespace App\Services;

use App\Repositories\VendorInvoiceRepository;
use App\Services\FileService;
use Illuminate\Support\Facades\Validator;

class VendorInvoiceService
{
    protected $vendorInvoiceRepository;
    protected $fileService;

    public function __construct(VendorInvoiceRepository $vendorInvoiceRepository, FileService $fileService)
    {
        $this->vendorInvoiceRepository = $vendorInvoiceRepository;
        $this->fileService = $fileService;
    }

    public function createInvoice($id, $recData)
    {
        $validator = Validator::make($recData, [
            'invoiceNumber' => 'required|string',
            'file' => 'required|file|max:2048',
            'files.*' => 'file|max:2048',
        ]);
        // 'mimes:pdf,doc,docx|max:2048'
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $invoiceAttachment = $this->fileService->saveSingleFile($recData['file']);
        $suportingDocument = [];
        if ($recData['files']) {
            $suportingDocument = $this->fileService->saveMultipleFile($recData['files']);
        }

        $invoiceData = [
            'invoiceNumber' => $recData['invoiceNumber'],
            'invoiceAttachment' => $invoiceAttachment,
            'suportingDocument' => $suportingDocument,
        ];

        $result = $this->vendorInvoiceRepository->addVendorInvoice($id, $invoiceData);
        return response()->json($result);
    }
    public function deleteInvoice($id)
    {
        $result = $this->vendorInvoiceRepository->deleteVendorInvoice($id);
        return response()->json($result);
    }

    public function updateInvoice($id, $reqData)
    {
        $validator = Validator::make($reqData, [
            'invoiceNumber' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $recData['invoiceAttachment'] = [];
        if ($reqData['file']) {
            $reqData['invoiceAttachment'] = $this->fileService->saveSingleFile($reqData['file']);
            $this->fileService->removeSingleFile($reqData['deleteFile']['invoiceAttachment']);
        }

        $suportingDocument = [];
        if ($reqData['files']) {
            $suportingDocument = $this->fileService->saveMultipleFile($reqData['files']);
        }
        $deleteSuportDoc = $reqData['deleteFile']['suportingDocument'];
        if (count($deleteSuportDoc) != 0) {
            $this->fileService->removeMultipleFile($deleteSuportDoc);
        }

        $reqData['suportingDocument'] = $suportingDocument;
        unset($reqData['file']);
        unset($reqData['files']);

        $result = $this->vendorInvoiceRepository->updateVendorInvoice($id, $reqData);
        return response()->json($result);

    }

}
