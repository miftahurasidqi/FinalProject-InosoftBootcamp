<?php

namespace App\Repositories;

use App\Models\ThirdPartyInstruction;
use App\Models\VendorInvoice;
use App\Services\FileService;

class VendorInvoiceRepository
{
    protected $vendorInvoice;

    public function __construct(VendorInvoice $vendorInvoice, FileService $fileService)
    {
        $this->vendorInvoice = $vendorInvoice;
        $this->fileService = $fileService;

    }

    public function addVendorInvoice($id, $invoiceData)
    {
        $invoiceData['third_party_instruction_id'] = $id;
        try {
            $instruction = ThirdPartyInstruction::find($id);
            $instruction->vendorInvoice()->create($invoiceData);
            $freshInstruction = $instruction->fresh();

            return [
                'success' => true,
                'id' => $freshInstruction['_id'],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }
    public function deleteVendorInvoice($id)
    {
        try {
            $invoice = VendorInvoice::find($id);
            if ($invoice) {
                $this->fileService->removeSingleFile($invoice->invoiceAttachment);
                $this->fileService->removeMultipleFile($invoice->suportingDocument);
                $invoice->delete();
                return [
                    'message' => 'Deleted successfully',
                    'status' => 200,
                    // 'invoice' => $invoice,
                ];
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }
    public function updateVendorInvoice($id, $updateData)
    {
        $deleteAttachmet = $updateData['deleteFile']['invoiceAttachment'];
        $deleteSuportDoc = $updateData['deleteFile']['suportingDocument'];
        try {
            $invoice = VendorInvoice::find($id);
            if (!$invoice) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            if (count($deleteAttachmet) != 0) {
                // $newInvoiceAttachment = $updateData['invoiceAttachment'];
                $invoice->invoiceAttachment = $updateData['invoiceAttachment'];
                $invoice->save();
            }

            $lastSuportDoc = $invoice->suportingDocument;
            $newSuportDoc = [];
            $result = $lastSuportDoc;
            if (count($deleteSuportDoc) != 0) {
                for ($i = 0; $i < count($lastSuportDoc); $i++) {
                    foreach ($deleteSuportDoc as $ar) {
                        if ($ar['name'] == $lastSuportDoc[$i]['name']) {
                            unset($result[$i]);
                        }
                    }
                }
            }
            $newSuportDoc = $result + $updateData['suportingDocument'];

            $invoice->update([
                'invoiceNumber' => $updateData['invoiceNumber'],
                // 'invoiceAttachment' => $updateData['invoiceAttachment'],
                'suportingDocument' => $newSuportDoc,

            ]);
            return [
                'message' => 'Upadate successfully',
                'status' => 200,
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }

}
